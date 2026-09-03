@twillBlockTitle('Contacts')

<div style="margin-top:20px"><a href="/assets/images/blocks/kontakti1.png" target="_blank">View design</a></div>

<x-twill::input
    name="title"
    label="Title"
/>
<x-twill::input
    type="textarea"
    name="gmap_iframe"
    label="Google Map iframe"
    :rows="2"
/>
@php
$wysiwygOptions = [
    ['header' => [2, 3, 4, 5, 6, false]],
    'bold',
    'italic',
    'underline',
    'strike',
    'blockquote',
    'code-block',
    'ordered',
    'bullet',
    'hr',
    'code',
    'link',
    'clean',
    'table',
    'align',
];
@endphp
@for ($i = 1; $i <= 3; $i++)
    <x-twill::wysiwyg
    name="description_{{$i}}"
    label="Box {{$i}}"
    :toolbar-options="$wysiwygOptions"
    :edit-source="true"
    />
    <hr>
@endfor
