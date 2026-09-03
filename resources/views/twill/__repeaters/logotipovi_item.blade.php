@twillRepeaterTitle('Logo Item') 
@twillRepeaterTrigger('Add Logo')

<x-twill::input
    name="title"
    label="Title"
/>

<x-twill::input
    name="url"
    label="URL"
/>

<x-twill::medias
    name="slika"
    label="Image"
    :max="1"
/>