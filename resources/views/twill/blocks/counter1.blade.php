@twillBlockTitle('Counter v1')

<div style="margin-top:20px"><a href="/assets/images/blocks/counter1.png" target="_blank">View design</a></div>

@for ($i = 1; $i <= 4; $i++)
    <x-twill::input
        name="broj_{{$i}}"
        label="Count #{{$i}}"
    />
    <x-twill::input
        name="tekst_{{$i}}"
        label="Text for #{{$i}}"
    />
    <hr>
@endfor
