@twillBlockTitle('Page Header')
<div style="margin-top:20px"><a href="/assets/images/blocks/page_head1.png" target="_blank">View design</a></div>
<x-twill::input
    name="title"
    label="Title"
/>
<x-twill::medias
    name="slika"
    label="Image Background"
    :max="1"
/>