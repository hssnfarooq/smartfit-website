@twillBlockTitle('Add to cart SERVICE')
<div style="margin-top:20px"><a href="/assets/images/blocks/banner1.png" target="_blank">View design</a></div>
@php
    $dd_proizvodi = Lunar\Models\Product::where('product_type_id', '<>', 1)->where('status', 'published')->get();
    foreach($dd_proizvodi as $proizvod)
        $tmp[] = ['value' => $proizvod->id, 'label' => $proizvod->translateAttribute('name')];

@endphp
<x-twill::input
    name="title"
    label="Title"
/>
<x-twill::input
    type="textarea"
    name="description"
    label="Text"
    :rows="3"
/>
<x-twill::select
    name="prod_id"
    label="Select Service"
    :options="$tmp"
/>
<x-twill::medias
    name="slika"
    label="Image Background"
    :max="1"
/>