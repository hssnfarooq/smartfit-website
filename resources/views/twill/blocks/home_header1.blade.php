@twillBlockTitle('Home Header v1')

<div style="margin-top:20px">
<a href="/assets/images/blocks/home_header1.png" target="_blank">View design</a></div>

<x-twill::input
    name="title"
    label="Title"
/>
<x-twill::input
    name="description"
    label="Text"
/>
<x-twill::input
    name="btn_txt"
    label="Btn Text"
/>
<x-twill::input
    name="url"
    label="Btn URL"
/>
<x-twill::input
    name="bg_tekst"
    label="BG Text"
/>
<x-twill::medias
    name="slika"
    label="Image"
    :max="1"
/>