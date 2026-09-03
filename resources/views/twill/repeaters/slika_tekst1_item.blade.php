@twillRepeaterTitle('Item')
@twillRepeaterMax('2') 
@twillRepeaterTrigger('Add item')

<x-twill::input
    name="title"
    label="Title"
/>
 
<x-twill::input
    type="textarea"
    name="description"
    label="Text"
    :rows="4"
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