@twillBlockTitle('Services Packages v2')
<div style="margin-top:20px"><a href="/assets/images/blocks/paketi_ispis2.png" target="_blank">View design</a></div>

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

<x-twill::browser
    module-name="servicesPackages"
    name="servicesPackages"
    label="Packages"
    :max="2"
/>