<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GoogleSheetsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    protected GoogleSheetsService $sheetsService;

    public function __construct(GoogleSheetsService $sheetsService)
    {
        $this->sheetsService = $sheetsService;
    }

    /**
     * Get all dashboard data (PO + Vendor)
     *
     * @return JsonResponse
     */
    public function getData(): JsonResponse
    {
        try {
            $purchaseOrders = $this->sheetsService->getPurchaseOrdersAssoc();
            $vendors = $this->sheetsService->getVendorsAssoc();

            return response()->json([
                'success' => true,
                'data' => [
                    'purchase_orders' => $purchaseOrders,
                    'vendors' => $vendors,
                    'timestamp' => now()->toIso8601String(),
                ],
                'meta' => [
                    'po_count' => count($purchaseOrders),
                    'vendor_count' => count($vendors),
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Dashboard data fetch failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => 'Failed to fetch dashboard data',
                'message' => config('app.debug') ? $e->getMessage() : 'An error occurred',
            ], 500);
        }
    }

    /**
     * Get Purchase Orders only
     *
     * @return JsonResponse
     */
    public function getPurchaseOrders(): JsonResponse
    {
        try {
            $data = $this->sheetsService->getPurchaseOrdersAssoc();

            return response()->json([
                'success' => true,
                'data' => $data,
                'count' => count($data),
            ]);
        } catch (\Exception $e) {
            Log::error('PO fetch failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => 'Failed to fetch purchase orders',
            ], 500);
        }
    }

    /**
     * Get Vendors only
     *
     * @return JsonResponse
     */
    public function getVendors(): JsonResponse
    {
        try {
            $data = $this->sheetsService->getVendorsAssoc();

            return response()->json([
                'success' => true,
                'data' => $data,
                'count' => count($data),
            ]);
        } catch (\Exception $e) {
            Log::error('Vendor fetch failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => 'Failed to fetch vendors',
            ], 500);
        }
    }

    /**
     * Clear Google Sheets cache
     *
     * @return JsonResponse
     */
    public function clearCache(): JsonResponse
    {
        try {
            $this->sheetsService->clearCache();

            return response()->json([
                'success' => true,
                'message' => 'Cache cleared successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to clear cache',
            ], 500);
        }
    }

    /**
     * Test Google Sheets API connection
     *
     * @return JsonResponse
     */
    public function testConnection(): JsonResponse
    {
        $isConnected = $this->sheetsService->testConnection();

        return response()->json([
            'success' => $isConnected,
            'message' => $isConnected 
                ? 'Successfully connected to Google Sheets API' 
                : 'Failed to connect to Google Sheets API',
        ], $isConnected ? 200 : 500);
    }
}
