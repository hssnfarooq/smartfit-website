@twillBlockTitle('Home Header Video BG')

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

<x-twill::files
    name="video"
    label="Video BG"
    :max="1"
/>