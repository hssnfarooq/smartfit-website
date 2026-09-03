@twillBlockTitle('Picture Banner v2')
<div style="margin-top:20px"><a href="/assets/images/blocks/banner2.png" target="_blank">View design</a></div>
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
<x-twill::input
    name="url"
    label="URL"
/>
<x-twill::input
    name="btn_tekst"
    label="BTN Text"
/>
<x-twill::medias
    name="slika"
    label="Image Background"
    :max="1"
/>