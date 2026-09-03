<?php
return [
    'block_editor' => [     
        'use_twill_blocks' => [],  
        'files' => ['video'], 
        'crops' => [ 
            'slika' => [
                'Crop 16:9' => [
                    [
                        'name' => '16:9',
                        'ratio' => 16 / 9,
                    ],
                ],
                'Crop 4:3' => [
                    [
                        'name' => '4:3',
                        'ratio' => 4 / 3,
                    ],
                ],
                'Crop 1:1' => [
                    [
                        'name' => '1:1',
                        'ratio' => 1,
                    ],
                ],
                'flexible' => [
                    [
                        'name' => 'flexible',
                        'ratio' => 0,
                    ],
                ],
            ],
            'slika_head' => [
                'flexible' => [
                    [
                        'name' => 'flexible',
                        'ratio' => 0,
                    ],
                ],
            ],
        ],
    ],
    'settings' => [
        'crops' => [
            'default_social_image' => [
                'default' => [
                    [
                        'name' => 'default',
                        'ratio' => 1.91 / 1,
                        'minValues' => [
                            'width' => 1200,
                            'height' => 627,
                        ],
                    ],
                ],
            ],
        ],
    ]
];