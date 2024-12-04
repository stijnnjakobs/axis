<?php

namespace App\Extensions\Servers\DomainReseller;

use App\Classes\Extensions\Server;
use App\Helpers\ExtensionHelper;
use Illuminate\Support\Facades\Http;

class DomainReseller extends Server
{
    public function getMetadata()
    {
        return [
            'display_name' => 'Domain Reseller',
            'version' => '1.0.0',
            'author' => 'Paymenter',
            'website' => 'https://paymenter.org',
        ];
    }

    public function getConfig()
    {
        return [
            [
                'name' => 'api_host',
                'friendlyName' => 'API Host',
                'type' => 'text',
                'required' => true,
                'description' => 'The API host URL'
            ],
            [
                'name' => 'api_key',
                'friendlyName' => 'API Key',
                'type' => 'text',
                'required' => true,
                'description' => 'Your API key'
            ],
            [
                'name' => 'api_secret',
                'friendlyName' => 'API Secret',
                'type' => 'password',
                'required' => true,
                'description' => 'Your API secret'
            ]
        ];
    }

    public function getProductConfig($options)
    {
        return [
            [
                'name' => 'tld',
                'friendlyName' => 'TLD',
                'type' => 'dropdown',
                'required' => true,
                'options' => $this->getAvailableTLDs(),
                'description' => 'Select the TLD for this product'
            ],
            [
                'name' => 'period',
                'friendlyName' => 'Registration Period',
                'type' => 'dropdown',
                'required' => true,
                'options' => [
                    ['name' => '1 Year', 'value' => '1'],
                    ['name' => '2 Years', 'value' => '2'],
                    ['name' => '3 Years', 'value' => '3'],
                    ['name' => '5 Years', 'value' => '5'],
                    ['name' => '10 Years', 'value' => '10'],
                ]
            ]
        ];
    }

    private function getAvailableTLDs()
    {
        try {
            $response = $this->makeApiRequest('GET', 'tlds');
            $tlds = [];
            foreach ($response['tlds'] as $tld) {
                $tlds[] = [
                    'name' => $tld['name'],
                    'value' => $tld['name']
                ];
            }
            return $tlds;
        } catch (\Exception $e) {
            ExtensionHelper::error('DomainReseller', $e->getMessage());
            return [];
        }
    }

    public function createServer($user, $params, $order, $orderProduct, $configurableOptions)
    {
        try {
            $domain = $params['config']['domain'];
            $period = $params['config']['period'] ?? 1;

            $response = $this->makeApiRequest('POST', 'domains/register', [
                'domain' => $domain,
                'period' => $period,
                'nameservers' => [
                    'ns1.example.com',
                    'ns2.example.com'
                ],
                'registrant' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ]
            ]);

            if ($response['status'] === 'success') {
                ExtensionHelper::setOrderProductConfig([
                    'domain' => $domain,
                    'domain_id' => $response['domain_id'],
                    'expiry_date' => $response['expiry_date']
                ], $orderProduct->id);
                return true;
            }

            throw new \Exception($response['message'] ?? 'Unknown error occurred');
        } catch (\Exception $e) {
            ExtensionHelper::error('DomainReseller', $e->getMessage());
            return false;
        }
    }

    private function makeApiRequest($method, $endpoint, $data = [])
    {
        $apiHost = ExtensionHelper::getConfig('DomainReseller', 'api_host');
        $apiKey = ExtensionHelper::getConfig('DomainReseller', 'api_key');
        $apiSecret = ExtensionHelper::getConfig('DomainReseller', 'api_secret');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'X-API-Secret' => $apiSecret,
        ])->$method(rtrim($apiHost, '/') . '/api/' . $endpoint, $data);

        if ($response->failed()) {
            throw new \Exception($response->body());
        }

        return $response->json();
    }
}