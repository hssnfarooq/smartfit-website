@twillRepeaterTitle('Listing item')
@twillRepeaterTrigger('Add item')

<x-twill::input
    name="title"
    label="Title"
/>
 
<x-twill::input
    type="textarea"
    name="description"
    label="Text"
    :rows="3"
/>

<x-twill::input
    type="textarea"
    name="ikona"
    label="Icon SVG"
    :rows="2"
/>