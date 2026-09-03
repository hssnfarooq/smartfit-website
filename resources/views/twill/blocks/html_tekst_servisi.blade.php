@twillBlockTitle('Services Text And Booking Banner')
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
<x-twill::input
name="service_id"
label="Service ID"
type="number"
note="If you want to connect this text with product"
/>

<x-twill::wysiwyg
    name="description"
    :label="twillTrans('HTML Text')"
    :toolbar-options="$wysiwygOptions"
    :edit-source="true"
/>

