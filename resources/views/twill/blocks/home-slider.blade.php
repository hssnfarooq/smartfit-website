@twillBlockTitle('Home Header')
<div style="margin-top:20px"><a href="/assets/images/blocks/home_slider.png" target="_blank">View design</a></div>

<x-twill::repeater type="home_slider_item"/>

<x-twill::browser
    module-name="saleActions"
    name="saleActions"
    label="Sale Actions"
    note="*optional"
    :max="2"
/>