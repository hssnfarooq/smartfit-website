<ul class="cart_btns_group unordered_list mb-4">
    <li>
        <div class="quantity_form">
            <button type="button" class="input_number_decrement" wire:click="qtyMinus">
            <i class="fa-regular fa-minus"></i>
            </button>
            <input class="input_number" type="text" type="number"
            id="quantity"
            min="1"
            value="1"
            wire:model="quantity">
            <button type="button" class="input_number_increment" wire:click="qtyPlus">
            <i class="fa-regular fa-plus"></i>
            </button>
        </div>
    </li>
    <li>
        <button type="submit" class="btn btn-primary" wire:click.prevent="addToCart">
            Buy Now
        </button>
        <!--<a class="btn btn-primary" href="#!">
            <span class="btn_text">Buy Now</span>
        </a>-->
    </li>
</ul>
@if ($errors->has('quantity'))
    <div class="p-2 mt-4 text-xs font-medium text-center text-red-700 rounded bg-red-50"
            role="alert">
        @foreach ($errors->get('quantity') as $error)
            {{ $error }}
        @endforeach
    </div>
@endif