<div>
  @php
    $isBrakeOption = (int) ($grupa ?? 0) === 5;
    $isComplimentaryCheck = (int) ($grupa ?? 0) === 9;
  @endphp

    <div class="form-check form-switch booking-service-option">
      <input class="form-check-input booking-service-toggle" type="checkbox" role="switch" id="chbox{{$servisId}}" wire:click="{{$checked ? 'makniServis' : 'addToCart'}}"{{$checked ? ' checked' : ''}}>
      <label class="form-check-label" for="chbox{{$servisId}}" style="width: fit-content">
          {{$servisName}}
      </label>
      @if (!empty($servisDescription))
        <button type="button" class="btn btn-link p-0 ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal{{$servisId}}" aria-label="More information about {{$servisName}}">
          <i class="fa-solid fa-circle-exclamation" aria-hidden="true"></i>
        </button>
      @endif
      <strong class="float-end">
        @if ($isBrakeOption || !$priceLabel)
          Price on request
        @elseif ($isComplimentaryCheck)
          {{$priceLabel}}
        @elseif ($priceValue === 0)
          {{str_contains(strtolower($servisName), ' free ') ? 'FREE' : 'Price on request'}}
        @else
          {{$priceLabel}}
        @endif
      </strong>
    </div>

@if (!empty($servisDescription))
  <!-- Modal -->
  <div class="modal fade" id="exampleModal{{$servisId}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$servisId}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel{{$servisId}}">{{$servisName}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {!!html_entity_decode($servisDescription)!!}
        </div>
      </div>
    </div>
  </div>
@endif
</div>
