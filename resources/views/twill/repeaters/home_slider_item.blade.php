@twillRepeaterTitle('Home Slide Item')
@twillRepeaterMax('9') 
@twillRepeaterTrigger('Add item')

<x-twill::input
    name="title"
    label="Title"
/>
 
<x-twill::input
    name="description"
    label="Text"
/>

<x-twill::input
    name="url"
    label="URL"
/>

<x-twill::input
    name="btn"
    label="BTN Text"
/>
<x-twill::medias
    name="slika"
    label="Image"
    :max="1"
/>