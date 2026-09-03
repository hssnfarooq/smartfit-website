@php
    $i = 998;
    $stil = empty($this->auto) ? 'background: #ff000014; border: 1px solid red;' : 'background: #8cff0742;';
@endphp
<div>
<div class="accordion" id="faq_accordion{{$i}}" style="margin-bottom: 30px">
    <div class="accordion-item" style="{{$stil}} ">
      <div class="accordion-header" id="headingOne{{$i}}">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$i}}" aria-expanded="false" aria-controls="collapseOne{{$i}}">
            Your Vehicle
        </button>
      </div>
      <div id="collapseOne{{$i}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faq_accordion{{$i}}">
        <div class="accordion-body pt-0">
          <div class="order_summary">
            @if (!empty($this->auto))
                <ul class="unordered_list_block">
                    <li>
                        <span>Registration:</span>
                        <span>{{$this->auto->registration}}</span>
                    </li>
                    <li>
                        <span>Vehicle brand:</span>
                        <span>{{$this->auto->make}}</span>
                    </li>
                    <li>
                        <span>Model:</span>
                        <span>{{$this->auto->model}}</span>
                    </li>
                    <li>
                        <span>Year of registration:</span>
                        <span>{{$this->auto->registrationDate}}</span>
                    </li>
                    <li>
                        <span>MOT due date:</span>
                        <span> 
                            @if (isset($this->auto->motTests))
                            {{$this->auto->motTests[0]->expiryDate}}
                          @else
                            {{$this->auto->motTestDueDate}}
                          @endif  
                        </span>
                    </li>
                    <li>
                        <span>Fuel type:</span>
                        <span>{{$this->auto->fuelType}}</span>
                    </li>
                    <li>
                        <span>Colour:</span>
                        <span>{{$this->auto->primaryColour}}</span>
                    </li>
                    <li></li>
                </ul>
                <a class="btn btn-primary w-100" href="javascript:;" data-bs-toggle="modal" data-bs-target="#autoModal">
                    <span class="btn_text">Change</span>
                </a>
            @else
                <p class="mb-0">
                    You have no vehicle selected.
                </p>
                <a class="btn btn-primary w-100" href="javascript:;" data-bs-toggle="modal" data-bs-target="#autoModal">
                    <span class="btn_text">Add vehicle</span>
                </a>
            @endif
                        
          </div>
        </div>
      </div>
    </div>   
</div>

<livewire:modals.auto />
</div>