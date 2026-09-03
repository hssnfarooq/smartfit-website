@php
    $i = 997;
    $stil = empty($this->termin) ? 'background: #ff000014; border: 1px solid red;' : 'background: #8cff0742;';
@endphp
<div>
<div class="accordion" id="faq_accordion{{$i}}" style="margin-bottom: 30px">
    <div class="accordion-item" style="{{$stil}} ">
      <div class="accordion-header" id="headingOne{{$i}}">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$i}}" aria-expanded="false" aria-controls="collapseOne{{$i}}">
            Your preferred appointments
        </button>
      </div>
      <div id="collapseOne{{$i}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faq_accordion{{$i}}">
        <div class="accordion-body pt-0">
          <div class="order_summary">
            @if (!empty($this->termin))
                <ul class="unordered_list_block">
                    <li>
                        <span>Date one:</span>
                        <span>{{$this->termin[0][1].' on '.date('d.m.Y', strtotime($this->termin[0][0]))}}</span>
                    </li>
                    <li>
                        <span>Date two:</span>
                        <span>{{$this->termin[1][1].' on '.date('d.m.Y', strtotime($this->termin[1][0]))}}</span>
                    </li>
                    <li></li>
                </ul>
                <a class="btn btn-primary w-100" href="javascript:;" data-bs-toggle="modal" data-bs-target="#terminModal">
                    <span class="btn_text">Change</span>
                </a>
            @else
                <p class="mb-5">
                    You have no preferred appointments selected.
                </p>
                <a class="btn btn-primary w-100" href="javascript:;" data-bs-toggle="modal" data-bs-target="#terminModal">
                    <span class="btn_text">Add</span>
                </a>
            @endif
                        
          </div>
        </div>
      </div>
    </div>   
  </div>

  <livewire:modals.termin />
</div>