@twillBlockTitle('Home - Image | Text | With Logo')

<x-twill::medias
    name="slika"
    label="Image left"
    :max="1"
/>
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
<hr>
<x-twill::input
    name="gumb"
    label="Button Text"
/>
<x-twill::input
    name="url"
    label="URL"
/>
<hr>
<x-twill::input
    name="tekst_desno"
    label="Text Right"
/>