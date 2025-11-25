<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GoogleSheetsService
{
    protected Client $client;
    protected Sheets $service;
    protected string $spreadsheetId;
    protected bool $cacheEnabled;
    protected int $cacheTtl;
    protected string $cachePrefix;

    public function __construct()
    {
        $this->initializeClient();
        $this->spreadsheetId = config('google-sheets.spreadsheet_id');
        $this->cacheEnabled = config('google-sheets.cache.enabled', true);
        $this->cacheTtl = config('google-sheets.cache.ttl', 300);
        $this->cachePrefix = config('google-sheets.cache.prefix', 'google_sheets_');
    }

    /**
     * Initialize Google API Client with Service Account credentials
     */
    protected function initializeClient(): void
    {
        $this->client = new Client();
        $this->client->setApplicationName('Berapit Procurement Dashboard');
        
        // Load service account credentials
        $credentialsPath = base_path(config('google-sheets.service_account_path'));
        
        if (!file_exists($credentialsPath)) {
            throw new \Exception("Google service account file not found at: {$credentialsPath}");
        }

        $this->client->setAuthConfig($credentialsPath);
        $this->client->addScope(Sheets::SPREADSHEETS_READONLY);

        // Skip SSL verification if enabled (development only)
        if (env('GOOGLE_API_SKIP_SSL_VERIFY', false)) {
            $httpClient = new \GuzzleHttp\Client(['verify' => false]);
            $this->client->setHttpClient($httpClient);
        }

        $this->service = new Sheets($this->client);
    }

    /**
     * Get data from a specific worksheet range
     *
     * @param string $worksheetName Name of the worksheet (e.g., 'PO', 'Vendor')
     * @param string $range Cell range (e.g., 'A1:Z1000')
     * @return array
     */
    public function getRange(string $worksheetName, string $range = 'A:Z'): array
    {
        $fullRange = "{$worksheetName}!{$range}";
        $cacheKey = $this->cachePrefix . md5($fullRange);

        if ($this->cacheEnabled && Cache::has($cacheKey)) {
            Log::info("Google Sheets: Cache hit for {$fullRange}");
            return Cache::get($cacheKey);
        }

        try {
            $response = $this->service->spreadsheets_values->get(
                $this->spreadsheetId,
                $fullRange
            );

            $values = $response->getValues() ?? [];
            
            if ($this->cacheEnabled) {
                Cache::put($cacheKey, $values, $this->cacheTtl);
                Log::info("Google Sheets: Cached {$fullRange} for {$this->cacheTtl} seconds");
            }

            return $values;
        } catch (\Exception $e) {
            Log::error("Google Sheets API Error: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get Purchase Order data with headers
     *
     * @return array ['headers' => [...], 'rows' => [...]]
     */
    public function getPurchaseOrders(): array
    {
        $worksheetName = config('google-sheets.worksheets.po', 'PO');
        $data = $this->getRange($worksheetName);

        if (empty($data)) {
            return ['headers' => [], 'rows' => []];
        }

        // Skip empty rows at the top to find actual headers
        $headers = [];
        while (!empty($data)) {
            $firstRow = array_shift($data);
            // Check if row has any non-empty values
            $nonEmptyValues = array_filter($firstRow, fn($value) => !empty(trim($value ?? '')));
            if (!empty($nonEmptyValues)) {
                $headers = $firstRow;
                break;
            }
        }

        return [
            'headers' => $headers,
            'rows' => $data,
        ];
    }

    /**
     * Get Vendor data with headers
     *
     * @return array ['headers' => [...], 'rows' => [...]]
     */
    public function getVendors(): array
    {
        $worksheetName = config('google-sheets.worksheets.vendor', 'Vendor');
        $data = $this->getRange($worksheetName);

        if (empty($data)) {
            return ['headers' => [], 'rows' => []];
        }

        // Skip empty rows at the top to find actual headers
        $headers = [];
        while (!empty($data)) {
            $firstRow = array_shift($data);
            // Check if row has any non-empty values
            $nonEmptyValues = array_filter($firstRow, fn($value) => !empty(trim($value ?? '')));
            if (!empty($nonEmptyValues)) {
                $headers = $firstRow;
                break;
            }
        }

        return [
            'headers' => $headers,
            'rows' => $data,
        ];
    }

    /**
     * Get Purchase Orders as associative array (header => value)
     *
     * @return array
     */
    public function getPurchaseOrdersAssoc(): array
    {
        $data = $this->getPurchaseOrders();
        return $this->mapHeadersToRows($data['headers'], $data['rows']);
    }

    /**
     * Get Vendors as associative array (header => value)
     *
     * @return array
     */
    public function getVendorsAssoc(): array
    {
        $data = $this->getVendors();
        return $this->mapHeadersToRows($data['headers'], $data['rows']);
    }

    /**
     * Map headers to row values for easier data access
     *
     * @param array $headers
     * @param array $rows
     * @return array
     */
    protected function mapHeadersToRows(array $headers, array $rows): array
    {
        return array_map(function ($row) use ($headers) {
            $mappedRow = [];
            foreach ($headers as $index => $header) {
                $mappedRow[$header] = $row[$index] ?? null;
            }
            return $mappedRow;
        }, $rows);
    }

    /**
     * Clear cache for all Google Sheets data
     */
    public function clearCache(): void
    {
        Cache::flush();
        Log::info("Google Sheets cache cleared");
    }

    /**
     * Test connection to Google Sheets API
     *
     * @return bool
     */
    public function testConnection(): bool
    {
        try {
            $this->service->spreadsheets->get($this->spreadsheetId);
            return true;
        } catch (\Exception $e) {
            Log::error("Google Sheets connection test failed: " . $e->getMessage());
            return false;
        }
    }
}
