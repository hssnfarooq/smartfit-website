@twillBlockTitle('Picture Banner v3')

<x-twill::input
    name="title"
    type="textarea"
    label="White text"
    :rows="2"
/>
<x-twill::input
    type="textarea"
    name="description"
    label="Green text"
    :rows="2"
/>
<x-twill::input
    name="url"
    label="URL"
/>
<x-twill::input
    name="btn_tekst"
    label="BTN Text"
/>
<x-twill::medias
    name="slika"
    label="Image Background"
    :max="1"
/>