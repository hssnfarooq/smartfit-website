@twillRepeaterTitle('Box with icon item')
@twillRepeaterTrigger('Add item')

@php
$selectIkonu = [
    [
        'value' => '',
        'label' => 'NONE'
    ],
    [
        'value' => 'car2',
        'label' => 'Car v2'
    ],
    [
        'value' => 'fleet',
        'label' => 'Fleet'
    ],
    [
        'value' => 'diagnostics',
        'label' => 'Diagnostics'
    ],
    [
        'value' => 'wheel-adjustment',
        'label' => 'Wheel Adjustment'
    ],
    [
        'value' => '24-7',
        'label' => '24/7'
    ],
    [
        'value' => 'oil',
        'label' => 'Oil'
    ],
    [
        'value' => 'brakes',
        'label' => 'Brakes'
    ],
    [
        'value' => 'tyre',
        'label' => 'Tyre'
    ],
    [
        'value' => 'steering',
        'label' => 'Steering'
    ],
    [
        'value' => 'tools',
        'label' => 'Tools'
    ],
    [
        'value' => 'piston',
        'label' => 'Piston'
    ],
    [
        'value' => 'wheel',
        'label' => 'Wheel'
    ],
    [
        'value' => 'bottle',
        'label' => 'Bottle'
    ],
    [
        'value' => 'battery',
        'label' => 'Battery'
    ],
    [
        'value' => 'drive_train',
        'label' => 'Drive train'
    ],
    [
        'value' => 'van',
        'label' => 'Van'
    ],
    [
        'value' => 'car',
        'label' => 'Car'
    ],
    [
        'value' => 'gears',
        'label' => 'Gears'
    ],
    [
        'value' => 'magnifying_glass',
        'label' => 'Magnifying glass'
    ]
];
@endphp
<x-twill::select
    name="ikona"
    label="Icon"
    placeholder="Select icon"
    default="0"
    :options="$selectIkonu"
/>

<p>OR</p>

<x-twill::medias
    name="slika"
    label="Image"
    :max="1"
/>
<hr>
<x-twill::input
    name="title"
    label="Title"
/>
 
<x-twill::input
    type="textarea"
    name="description"
    label="Text"
    :rows="4"
/>

<x-twill::input
    name="url"
    label="URL"
/>

<x-twill::input
    name="btn"
    label="BTN Text"
/>