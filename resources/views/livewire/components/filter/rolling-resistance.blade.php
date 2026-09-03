<select class="form-select mb-0" name="{{$name}}">
    <option value="" selected>all</option>
    @foreach ($dd as $json_item)
        @if (!empty($json_item->vrijednost))
            <option value="{{$json_item->vrijednost}}">{{$json_item->vrijednost}}</option>
        @endif        
    @endforeach
</select>