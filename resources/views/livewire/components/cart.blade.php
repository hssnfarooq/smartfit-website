@php
    //json_encode($this->cart)

    //var_dump($this->cart);
    //die();
@endphp

<div class="accordion" id="cart_accordion">
    <div class="accordion-item">
      <div class="accordion-header" id="cart_headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#cart_collapseOne" aria-expanded="true" aria-controls="cart_collapseOne" style="font-size:24px">
            Your booking cart ({{count($lines)}} items)
        </button>
      </div>
      <div id="cart_collapseOne" class="accordion-collapse collapse show" aria-labelledby="cart_headingOne" data-bs-parent="#cart_accordion">
        <div class="accordion-body pt-0 harmonika_bodi">
            @if ($this->cart)
                <div class="cart_table">
                    <ul class="table_head unordered_list">
                    <li>Product type</li>
                    <li>Subtotal</li>
                    <li>QTY</li>
                    <li>Total</li>
                    <li>Remove</li>
                    </ul>
                    @foreach ($lines as $index => $line)
                    <ul class="unordered_list">                        
                        <li>
                            <div class="cart_product_item">
                            <!--<div class="item_image">
                                    <img src="assets/images/products/product_img_1.png" alt="ProMotors - Product Image">
                                </div>-->
                                <div class="item_content">
                                    <h3 class="item_title">
                                        {{ $line['description'] }}
                                    </h3>
                                    <!--<a class="item_brand" href="#!">ASDER</a>-->
                                </div>
                            </div>
                        </li> 
                        <li>
                            <span class="title_text">Subtotal</span>
                            <span class="price_text">{{ $line['unit_price'] }}</span>
                        </li>
                        <li>{{$line['quantity']}}
                            <!--<span class="title_text">QTY</span>
                            <div class="quantity_form">
                            <button type="button" class="input_number_decrement" wire:model="quantity">
                                <i class="fa-regular fa-minus"></i>
                            </button>
                            <input class="input_number" type="text" value="1" id="quantity">
                            <button type="button" class="input_number_increment" wire:model="quantity">
                                <i class="fa-regular fa-plus"></i>
                            </button>
                            </div>-->
                        </li>
                        <li>
                            <span class="title_text">Total</span>
                            <span class="price_text">{{ $line['total'] }}</span>
                        </li>
                        <li>
                            <span class="title_text">Remove</span>
                            <button type="button" class="remove_btn" wire:click="removeLine('{{ $line['id'] }}', '{{ $line['product_id'] }}')">
                                 <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </li>
                    </ul>
                    @endforeach
                </div>
            @else
                Your cart is empty
            @endif

        </div>
      </div>
    </div>
  </div>