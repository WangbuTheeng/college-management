<?php

use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Cache\MemoryCache;
use PhpOffice\PhpSpreadsheet\Calculation\Calculation;

return [
    'exports' => [
        'chunk_size'             => 1000,
        'pre_calculate_formulas' => false,
        'strict_null_comparison' => false,
        'csv'                    => [
            'delimiter'              => ',',
            'enclosure'              => '"',
            'line_ending'            => "\n",
            'use_bom'                => false,
            'include_separator_line' => false,
            'excel_compatibility'    => false,
            'output_encoding'        => '',
            'test_auto_detect'       => true,
        ],
        'properties'             => [
            'creator'        => '',
            'lastModifiedBy' => '',
            'title'          => '',
            'description'    => '',
            'subject'        => '',
            'keywords'       => '',
            'category'       => '',
            'manager'        => '',
            'company'        => '',
        ],
    ],

    'imports'                       => [
        'read_only'          => true,
        'ignore_empty'       => false,
        'heading_row'        => [
            'formatter' => 'slug',
        ],
        'csv'                => [
            'delimiter'        => null,
            'enclosure'        => '"',
            'escape_character' => '\\',
            'contiguous'       => false,
            'input_encoding'   => 'UTF-8',
        ],
        'properties'         => [
            'creator'        => '',
            'lastModifiedBy' => '',
            'title'          => '',
            'description'    => '',
            'subject'        => '',
            'keywords'       => '',
            'category'       => '',
            'manager'        => '',
            'company'        => '',
        ],
        'sheets'             => [], // Add sheet names to only import those
        'ignore_sheets'      => [], // Add sheet names to ignore those sheets
    ],

    'extension_detector'            => [
        'xlsx'     => Excel::XLSX,
        'xlsm'     => Excel::XLSX,
        'xltx'     => Excel::XLSX,
        'xltm'     => Excel::XLSX,
        'xls'      => Excel::XLS,
        'xlt'      => Excel::XLS,
        'ods'      => Excel::ODS,
        'ots'      => Excel::ODS,
        'slk'      => Excel::SLK,
        'xml'      => Excel::XML,
        'gnumeric' => Excel::GNUMERIC,
        'htm'      => Excel::HTML,
        'html'     => Excel::HTML,
        'csv'      => Excel::CSV,
        'tsv'      => Excel::TSV,
        'pdf'      => Excel::DOMPDF, // Requires laravel-dompdf
    ],

    'value_binder'                  => [
        'default' => Maatwebsite\Excel\DefaultValueBinder::class,
    ],

    'cache'                         => [
        'driver'         => MemoryCache::class, // Supported: MemoryCache, IlluminateCache (Laravel Cache)
        'batch_size'     => 1000,
        'memory_limit'   => '128M', // Set to false to disable the memory limit
        'illuminate'     => [
            'store'  => null, // When using IlluminateCache, use specific cache store (e.g. `redis`, `memcached`)
            'prefix' => 'laravel-excel',
        ],
    ],

    'transactions'                  => [
        'handler' => 'db', // Supported: `db` (Database Transactions), `null` (No Transactions)
        'db'      => [
            'connection' => null, // When using `db`, specify connection. Null is default connection.
        ],
    ],

    'temporary_files'               => [
        'local_path'          => storage_path('framework/cache/laravel-excel'), // Local path to store temporary files
        'remote_disk'         => null, // When using remote disk for temporary files, specify the disk name
        'remote_prefix'       => null, // Optional prefix for remote temporary files
        'force_resync_remote' => false, // Resync remote temporary file even if it already exists
        'permissions'         => 0755,
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Settings
    |--------------------------------------------------------------------------
    |
    | You can define active worksheet and calculation engine
    |
    */
    'phpspreadsheet'                => [
        'chunk_size'        => 1000, // Amount of rows to process in one chunk when using `FromQuery`
        'calculation_engine' => Calculation::CALCULATION_ENGINE_UNDEFINED, // Choose from PHPSpreadsheet's options
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Macro Stubs
    |--------------------------------------------------------------------------
    |
    | Here you can define custom macros that will be loaded when the package is booted.
    |
    */
    'macros'                        => [],

    /*
    |--------------------------------------------------------------------------
    | Custom Mock Stubs
    |--------------------------------------------------------------------------
    |
    | Here you can define custom mock stubs that will be loaded when the package is booted.
    |
    */
    'mock_stubs'                    => [],
];
