@twillBlockTitle('Home video BG Header with car registration search')
<div style="margin-top:20px"><a href="/assets/images/blocks/home-registacija-search-video.png" target="_blank">View design</a></div>

<x-twill::input
    name="title"
    label="Title"
/>
 
<x-twill::input
    name="description"
    label="Text"
/>
<x-twill::medias
    name="slika"
    label="Image"
    :max="1"
/>
<x-twill::files
    name="video"
    label="Video BG"
    :max="1"
/>