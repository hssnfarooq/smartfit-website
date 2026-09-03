@twillBlockTitle('Boxes with icon')
<div style="margin-top:20px"><a href="/assets/images/blocks/izdvojeni_clanci1.png" target="_blank">View design</a></div>

<x-twill::input
    name="title"
    label="Title"
/>

<x-twill::browser
    module-name="pages"
    name="pages"
    label="Pages"
    :max="99"
/>