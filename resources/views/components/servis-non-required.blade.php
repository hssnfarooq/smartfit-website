@php
$checked = '';
if (!request()->session()->exists('grupa_'.$this->grupa)) $checked = ' checked';
/*wire:click="$emit('', {{ $this->grupa }})"*/
@endphp
<div class="col-sm-12">
    <label>
        <input type="radio" name="product{{$this->grupa}}" class="card-input-element" wire:click="makniServis" {{$checked}}/>                
            <div class="card card-default card-input">
                <div class="card-body">                        
                    <h6 style="margin: 0; padding:0">Non required</h6>                            
                </div>
            </div>
    </label>
</div>