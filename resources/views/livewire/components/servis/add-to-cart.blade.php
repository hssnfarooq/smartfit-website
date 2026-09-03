@if ($this->ispis == 'radio')

    <div class="col-sm-6">
        <!--checked: {{$this->checked}}  => obrisan_proizvod: {{$this->obrisan_proizvod}} => servis->id: {{$this->servis->id}} => grupa_session: {{request()->session()->get('grupa_'.$this->grupa)}} => grupa: {{$this->grupa}}-->
        <x-servis-item-radio :servis="$this->servis" :grupa="$this->grupa" :checked="$this->checked" />
    </div>

@else
    <x-servis-item-chkbox :servis="$this->servis" :checked="$this->checked" />
@endif