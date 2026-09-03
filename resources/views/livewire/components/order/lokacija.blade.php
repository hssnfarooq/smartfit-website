@php
    $i = 996;
    $stil = empty($this->lokacija) ? 'background: #ff000014; border: 1px solid red;' : 'background: #8cff0742;';
@endphp
<div>
<div class="accordion" id="faq_accordion{{$i}}" style="margin-bottom: 30px">
  <div class="accordion-item" style="{{$stil}} ">
      <div class="accordion-header" id="headingOne{{$i}}">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$i}}" aria-expanded="false" aria-controls="collapseOne{{$i}}">
            Service Centre
        </button>
      </div>
      <div id="collapseOne{{$i}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faq_accordion{{$i}}">
        <div class="accordion-body pt-0">
          <div class="order_summary">
            @if (!empty($this->lokacija))
                <ul class="unordered_list_block">
                    <li>
                        <span>{{$this->lokacija->title}}</span>
                    </li>
                    <li>
                        <span>{{$this->lokacija->address}}</span>
                    </li>
                    <li>
                      <span>Phone:</span>
                      <span>{{$this->lokacija->phone}}</span>
                  </li>
                  <li>
                    <span>E-mail:</span>
                    <span>{{$this->lokacija->email}}</span>
                </li>
                    <li></li>
                </ul>
                <a class="btn btn-primary w-100" href="javascript:;" data-bs-toggle="modal" data-bs-target="#lokacijaModal">
                    <span class="btn_text">Change</span>
                </a>
            @else
                <p class="mb-5">
                    You have no preferred service location selected.
                </p>
                <a class="btn btn-primary w-100" href="javascript:;" data-bs-toggle="modal" data-bs-target="#lokacijaModal">
                    <span class="btn_text">Add</span>
                </a>
            @endif
                        
          </div>
        </div>
      </div>
    </div>   
  </div>

  <livewire:modals.lokacija />
</div>