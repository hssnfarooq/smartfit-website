<?php

return [


    'disable_variants' => true,

    'require_brand' => true,

    'sku' => [
        'required' => true,
        'unique' => true,
    ],

    'gtin' => [
        'required' => false,
        'unique' => false,
    ],

    'mpn' => [
        'required' => false,
        'unique' => false,
    ],

    'ean' => [
        'required' => false,
        'unique' => false,
    ],

];
