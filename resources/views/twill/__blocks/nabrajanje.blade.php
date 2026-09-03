@twillBlockTitle('Text listing')
<div style="margin-top:20px"><a href="/assets/images/blocks/nabrajanje.png" target="_blank">View design</a></div>

<x-twill::input
    name="title"
    label="Title on the page"
/>
<x-twill::input
    type="textarea"
    name="description"
    label="Text"
    :rows="4"
/>
<hr>
<x-twill::repeater type="nabrajanje_item"/>