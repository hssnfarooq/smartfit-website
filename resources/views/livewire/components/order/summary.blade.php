@php
    $i = 999;
@endphp
<div>
    <div class="accordion" id="faq_accordion{{$i}}" style="margin-bottom: 30px">
        <div class="accordion-item">
          <div class="accordion-header" id="headingOne{{$i}}">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$i}}" aria-expanded="true" aria-controls="collapseOne{{$i}}">
                Order Summary
            </button>
          </div>
          <div id="collapseOne{{$i}}" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faq_accordion{{$i}}">
            <div class="accordion-body pt-0">
              <div class="order_summary">
                <h3 class="area_title"></h3>
                <ul class="unordered_list_block">
                  <li>
                    <span>Subtotal</span>
                    <span>{{$this->subtotal}}</span>
                  </li>
                  <li>
                    <span>VAT</span>
                    <span>{{$this->tax}}</span>
                  </li>
                  <li>
                    <span>Estimated total</span>
                    <span>{{$this->total}}</span>
                  </li>
                </ul>

                @if ($this->error)
                  <div class="alert alert-danger" role="alert" style="margin-top:50px">
                    {!!html_entity_decode($this->error)!!}
                  </div>
                @endif

                @if ($this->total != '£0.00')
                  <button type="button" class="btn btn-primary w-100 mt-5"{{$this->disabled}} wire:click="paymentPage">Go to payment</button>
                @else
                  <button type="button" class="btn btn-primary w-100 mt-5"{{$this->disabled}} wire:click="zavrsiBesplatnuNarudzbu">Finish order</button> 
                @endif
                
                <p class="mb-0">
                  *Taxes and fees are subject to change which may result in a change in your total price.
                </p>
              </div>
            </div>
          </div>
        </div>   
    </div>
</div>