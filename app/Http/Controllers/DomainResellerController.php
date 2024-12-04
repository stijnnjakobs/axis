<?php

namespace App\Http\Controllers;

use App\Extensions\Servers\DomainReseller\DomainReseller;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class DomainResellerController extends Controller
{
    private $api;

    public function __construct()
    {
        $this->api = new DomainReseller();
    }

    public function checkDomain(Request $request)
    {
        try {
            $response = $this->api->makeApiRequest('GET', 'domains/check', [
                'domain' => $request->input('domain')
            ]);

            return response()->json([
                'status' => 'success',
                'available' => $response['available']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function manageDNS(Request $request, $id)
    {
        $orderProduct = OrderProduct::findOrFail($id);

        try {
            $response = $this->api->makeApiRequest('GET', 'domains/' . $orderProduct->config['domain_id'] . '/dns');

            return response()->json([
                'status' => 'success',
                'records' => $response['records']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}