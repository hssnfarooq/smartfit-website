@twillBlockTitle('Boxes with icon')
<div style="margin-top:20px"><a href="/assets/images/blocks/ispis_s_ikonama.png" target="_blank">View design</a></div>
@php
$selectRed = [
    [
        'value' => '2',
        'label' => '2'
    ],
    [
        'value' => '3',
        'label' => '3'
    ],
    [
        'value' => '4',
        'label' => '4'
    ]
];

@endphp
<x-twill::input
    name="title"
    label="Title on the page"
/>
<x-twill::input
    name="btn"
    label="Text on the button"
/>

<x-twill::input
    name="url"
    label="Button URL"
/>
<x-twill::select
    name="po_redu"
    label="Boxes per row"
    placeholder="Select how many in row"
    default="3"
    :options="$selectRed"
/>
<x-twill::repeater type="ispis_s_ikonama_item"/>