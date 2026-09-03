@twillRepeaterTitle('Box with icon item')
@twillRepeaterTrigger('Add item')

@php
$selectIkonu = [
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
    default="2"
    :options="$selectIkonu"
/>

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