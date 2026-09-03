@twillBlockTitle('Services Packages v1')
<div style="margin-top:20px"><a href="/assets/images/blocks/paketi_ispis.png" target="_blank">View design</a></div>

<x-twill::input
    name="title"
    label="Title"
/>

<x-twill::input
    name="subtitle"
    label="Bg Title"
/>

<x-twill::browser
    module-name="servicesPackages"
    name="servicesPackages"
    label="Packages"
    :max="3"
/>