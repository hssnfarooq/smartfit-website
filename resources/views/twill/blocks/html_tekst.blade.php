@twillBlockTitle('HTML Text')
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
 
<x-twill::wysiwyg
    name="description"
    :label="twillTrans('HTML Text')"
    :toolbar-options="$wysiwygOptions"
    :edit-source="true"
/>