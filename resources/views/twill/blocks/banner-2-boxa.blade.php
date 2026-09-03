@twillBlockTitle('NEW 2 boxeses Banner')

<h2>BOX 1</h2>
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
<x-twill::medias
    name="slika"
    label="Image"
    :max="1"
/>
<x-twill::input
    name="url1"
    label="URL"
/>
<x-twill::input
    name="btn_tekst1"
    label="BTN Text"
/>
<hr>
<h2>BOX 2</h2>
<x-twill::wysiwyg
    name="description2"
    :label="twillTrans('HTML Text')"
    :toolbar-options="$wysiwygOptions"
    :edit-source="true"
/>
<x-twill::input
    name="url"
    label="URL"
/>
<x-twill::input
    name="btn_tekst"
    label="BTN Text"
/>