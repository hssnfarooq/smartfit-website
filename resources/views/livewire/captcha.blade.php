<div style="width: 300px; margin: 50px 0 30px 0;">
    <div style=" border: 1px solid #ccc; width:min-content; float: left">
        <img src="{{ captcha_src() }}" alt="captcha">        
        <input type="text" name="captcha" style="width:250px; padding:7px; border: darkgrey;" placeholder="{{$this->plholder}}" required>
    </div>    
    <a href="javascript:;" style="float: right; padding: 10px" wire:click.prevent="$refresh">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
        </svg>
    </a>
    <div style="clear: both"></div>
    @error('captcha') 
        <div style="color: red">{{ $message }}</div> 
    @enderror 
</div>