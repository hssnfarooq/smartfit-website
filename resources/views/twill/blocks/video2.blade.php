@twillBlockTitle('Video Banner')
<div style="margin-top:20px"><a href="/assets/images/blocks/video2.png" target="_blank">View design</a></div>
<x-twill::input
    name="title"
    label="Title"
/>
<x-twill::input
    name="video_url"
    label="Youtube URL"
/>
<x-twill::medias
    name="slika"
    label="Image Background"
    :max="1"
/>