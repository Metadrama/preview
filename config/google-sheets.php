<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Google Sheets API Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Google Sheets API integration using Service Account.
    | The service account JSON file should be stored in the path specified
    | in the GOOGLE_SERVICE_ACCOUNT_JSON_PATH environment variable.
    |
    */

    'service_account_path' => env('GOOGLE_SERVICE_ACCOUNT_JSON_PATH', 'storage/app/google-service-account.json'),
    
    'spreadsheet_id' => env('GOOGLE_SHEETS_SPREADSHEET_ID'),

    /*
    |--------------------------------------------------------------------------
    | Worksheet Names
    |--------------------------------------------------------------------------
    |
    | Define the worksheet/tab names used in your Google Sheets document.
    | These correspond to the tabs in the Berapit Procurement Master file.
    |
    */

    'worksheets' => [
        'po' => 'PO',           // Purchase Orders worksheet
        'vendor' => 'Vendor',   // Vendor data worksheet
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Settings
    |--------------------------------------------------------------------------
    |
    | Configure caching for Google Sheets API responses to reduce API calls
    | and improve performance. Cache TTL is in seconds.
    |
    */

    'cache' => [
        'enabled' => env('GOOGLE_SHEETS_CACHE_ENABLED', true),
        'ttl' => env('GOOGLE_SHEETS_CACHE_TTL', 300), // 5 minutes default
        'prefix' => 'google_sheets_',
    ],
];
