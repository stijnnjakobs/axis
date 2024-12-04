<?php

namespace App\Http\Controllers;

use App\Extensions\Servers\ResellerClub\ResellerClub;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class ResellerClubController extends Controller
{
    private $api;

    public function __construct()
    {
        $this->api = new ResellerClub();
    }

    public function checkDomain(Request $request)
    {
        try {
            $response = $this->api->makeApiRequest('GET', 'domains/available.json', [
                'domain-name' => $request->input('domain'),
                'tlds' => [$request->input('tld')]
            ]);

            return response()->json([
                'status' => 'success',
                'available' => $response[$request->input('domain')]['status'] === 'available'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function getDNSRecords($id)
    {
        $orderProduct = OrderProduct::findOrFail($id);
        
        try {
            $response = $this->api->makeApiRequest('GET', 'dns/manage/default-records.json', [
                'domain-name' => $orderProduct->config['domain']
            ]);
            
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