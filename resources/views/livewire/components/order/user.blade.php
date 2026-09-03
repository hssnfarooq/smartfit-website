@php
    $i = 995;
    $stil = empty($user_info) || $user_info['gdpr'] != 1 ? 'background: #ff000014; border: 1px solid red;' : 'background: #8cff0742;';
@endphp
<div>
    <div class="accordion" id="faq_accordion{{$i}}" style="margin-bottom: 30px">
        <div class="accordion-item" style="{{$stil}} ">
          <div class="accordion-header" id="headingOne{{$i}}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$i}}" aria-expanded="false" aria-controls="collapseOne{{$i}}">
                Your Contact Informations
            </button>
          </div>
          <div id="collapseOne{{$i}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faq_accordion{{$i}}">
            <div class="accordion-body pt-0">
              <div class="order_summary">
                @if (!empty($user_info))
                    <ul class="unordered_list_block">
                        <li>
                            <span>Title:</span>
                            <span>{{$user_info['title']}}</span>
                        </li>
                        <li>
                            <span>Name:</span>
                            <span>{{$user_info['name']}} {{$user_info['last_name']}}</span>
                        </li>
                        <li>
                          <span>Phone:</span>
                          <span>{{$user_info['telephone']}}</span>
                      </li>
                      <li>
                        <span>E-mail:</span>
                        <span>{{$user_info['email']}}</span>
                      </li>
                        <li></li>
                    </ul>
                    <a class="btn btn-primary w-100" href="javascript:;" data-bs-toggle="modal" data-bs-target="#userModal">
                        <span class="btn_text">Change</span>
                    </a>
                @else
                    <p class="mb-5">
                        You have to enter your contact informations.
                    </p>
                    <a class="btn btn-primary w-100" href="javascript:;" data-bs-toggle="modal" data-bs-target="#userModal">
                        <span class="btn_text">Enter Your Info</span>
                    </a>
                @endif
                            
              </div>
            </div>
          </div>
        </div>   
      </div>

      <livewire:modals.user />
</div>