<?php

namespace App\Extensions\Servers\ResellerClub;

use App\Classes\Extensions\Server;
use App\Helpers\ExtensionHelper;
use Illuminate\Support\Facades\Http;

class ResellerClub extends Server
{
    private $apiEndpoint = 'https://httpapi.com/api';
    private $testApiEndpoint = 'https://test.httpapi.com/api';

    public function getMetadata()
    {
        return [
            'display_name' => 'ResellerClub',
            'version' => '1.0.0',
            'author' => 'Paymenter',
            'website' => 'https://paymenter.org',
        ];
    }

    public function getConfig()
    {
        return [
            [
                'name' => 'reseller_id',
                'friendlyName' => 'Reseller ID',
                'type' => 'text',
                'required' => true,
                'description' => 'Your ResellerClub Reseller ID'
            ],
            [
                'name' => 'api_key',
                'friendlyName' => 'API Key',
                'type' => 'password',
                'required' => true,
                'description' => 'Your ResellerClub API Key'
            ],
            [
                'name' => 'test_mode',
                'friendlyName' => 'Test Mode',
                'type' => 'boolean',
                'required' => false,
                'description' => 'Enable test mode'
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

    private function getApiEndpoint()
    {
        return ExtensionHelper::getConfig('ResellerClub', 'test_mode') ? 
            $this->testApiEndpoint : 
            $this->apiEndpoint;
    }

    private function makeApiRequest($method, $endpoint, $params = [])
    {
        $resellerId = ExtensionHelper::getConfig('ResellerClub', 'reseller_id');
        $apiKey = ExtensionHelper::getConfig('ResellerClub', 'api_key');

        $baseParams = [
            'auth-userid' => $resellerId,
            'api-key' => $apiKey,
        ];

        $params = array_merge($baseParams, $params);
        $url = $this->getApiEndpoint() . '/' . $endpoint;

        try {
            $response = Http::asForm()->$method($url, $params);
            
            if ($response->failed()) {
                throw new \Exception($response->body());
            }

            return $response->json();
        } catch (\Exception $e) {
            ExtensionHelper::error('ResellerClub', $e->getMessage());
            throw $e;
        }
    }

    private function getAvailableTLDs()
    {
        try {
            $response = $this->makeApiRequest('GET', 'domains/available-tlds.json');
            
            $tlds = [];
            foreach ($response as $tld) {
                $tlds[] = [
                    'name' => $tld['tld'],
                    'value' => $tld['tld']
                ];
            }
            return $tlds;
        } catch (\Exception $e) {
            return [];
        }
    }

    public function createServer($user, $params, $order, $orderProduct, $configurableOptions)
    {
        try {
            // First, check if customer exists
            $customer = $this->getOrCreateCustomer($user);

            // Register the domain
            $domainResponse = $this->makeApiRequest('POST', 'domains/register.json', [
                'domain-name' => $params['config']['domain'],
                'years' => $params['config']['period'] ?? 1,
                'ns' => [
                    'ns1.example.com',
                    'ns2.example.com'
                ],
                'customer-id' => $customer['customerid'],
                'reg-contact-id' => $customer['contact_id'],
                'admin-contact-id' => $customer['contact_id'],
                'tech-contact-id' => $customer['contact_id'],
                'billing-contact-id' => $customer['contact_id'],
                'invoice-option' => 'NoInvoice', // Or handle invoicing as needed
                'protect-privacy' => false // Add privacy protection if needed
            ]);

            if (isset($domainResponse['entityid'])) {
                ExtensionHelper::setOrderProductConfig([
                    'domain' => $params['config']['domain'],
                    'domain_id' => $domainResponse['entityid'],
                    'customer_id' => $customer['customerid'],
                    'expiry_date' => $domainResponse['endtime']
                ], $orderProduct->id);
                return true;
            }

            throw new \Exception($domainResponse['message'] ?? 'Unknown error occurred');
        } catch (\Exception $e) {
            ExtensionHelper::error('ResellerClub', $e->getMessage());
            return false;
        }
    }

    private function getOrCreateCustomer($user)
    {
        try {
            // Try to find existing customer
            $searchResponse = $this->makeApiRequest('GET', 'customers/search.json', [
                'username' => $user->email
            ]);

            if (!empty($searchResponse['recsonpage'])) {
                $customerId = $searchResponse['customers'][0]['customerid'];
                $contactId = $this->getCustomerContact($customerId);
                return [
                    'customerid' => $customerId,
                    'contact_id' => $contactId
                ];
            }

            // Create new customer
            $customerResponse = $this->makeApiRequest('POST', 'customers/signup.json', [
                'username' => $user->email,
                'passwd' => str_random(12),
                'name' => $user->name,
                'company' => $user->company ?? 'N/A',
                'address-line-1' => $user->address ?? 'N/A',
                'city' => $user->city ?? 'N/A',
                'state' => $user->state ?? 'N/A',
                'country' => $user->country ?? 'US',
                'zipcode' => $user->zipcode ?? '00000',
                'phone-cc' => '1', // Add proper phone country code handling
                'phone' => $user->phone ?? '1234567890',
                'lang-pref' => 'en'
            ]);

            // Create contact for the customer
            $contactResponse = $this->makeApiRequest('POST', 'contacts/add.json', [
                'customer-id' => $customerResponse['customerid'],
                'email' => $user->email,
                'name' => $user->name,
                'company' => $user->company ?? 'N/A',
                'address-line-1' => $user->address ?? 'N/A',
                'city' => $user->city ?? 'N/A',
                'state' => $user->state ?? 'N/A',
                'country' => $user->country ?? 'US',
                'zipcode' => $user->zipcode ?? '00000',
                'phone-cc' => '1',
                'phone' => $user->phone ?? '1234567890',
                'type' => 'Contact'
            ]);

            return [
                'customerid' => $customerResponse['customerid'],
                'contact_id' => $contactResponse['entityid']
            ];
        } catch (\Exception $e) {
            throw new \Exception('Failed to create customer: ' . $e->getMessage());
        }
    }

    private function getCustomerContact($customerId)
    {
        $response = $this->makeApiRequest('GET', 'contacts/search.json', [
            'customer-id' => $customerId,
            'type' => 'Contact'
        ]);

        if (!empty($response['recsonpage'])) {
            return $response['contacts'][0]['contactid'];
        }

        throw new \Exception('No contact found for customer');
    }
} 