@twillBlockTitle('Contact Form')

<div style="margin-top:20px"><a href="/assets/images/blocks/kontakt_forma1.png" target="_blank">View design</a></div>

<x-twill::input
    name="title"
    label="Title"
/>
<x-twill::input
    type="textarea"
    name="description"
    label="Short Text"
    :rows="2"
/>