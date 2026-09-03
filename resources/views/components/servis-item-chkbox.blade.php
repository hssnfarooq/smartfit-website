<div>
  @php($price = $servis->prices->first())

  <div class="form-check form-switch" style="padding: 0 0 10px 50px; margin:10px 0 0 0; border-bottom:1px dotted #ccc;">
    <input class="form-check-input" type="checkbox" role="switch" id="chbox{{$servis->id}}" wire:click="{{$checked ? 'makniServis' : 'addToCart'}}"{{$checked ? ' checked' : ''}}>
    <label class="form-check-label" for="chbox{{$servis->id}}" style="width: fit-content">
        {{$servis->translateAttribute('name')}}
    </label>  
    @if (!empty($servis->translateAttribute('description')))
        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#exampleModal{{$servis->id}}" style="margin-left: 10px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
      </svg></a>
    @endif
    <strong style="float: right">
        @if (!$price || $price->price->value === 0)
          {{str_contains(strtolower($servis->translateAttribute('name')), ' free ') ? 'FREE' : 'Price on request'}}
        @else
          {{$price->priceIncTax()->formatted()}}
        @endif
    </strong>
    

</div>

@if (!empty($servis->translateAttribute('description')))
  <!-- Modal -->
  <div class="modal fade" id="exampleModal{{$servis->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$servis->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel{{$servis->id}}">{{$servis->translateAttribute('name')}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {!!html_entity_decode($servis->translateAttribute('description'))!!}
        </div>
      </div>
    </div>
  </div>
@endif
</div>
