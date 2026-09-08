<div class="row g-3">
  <div class="col-md-6">
    <div><strong>Registration:</strong><br><span>{{$auto->registration}}</span></div>
    <div><strong>Model:</strong><br><span>{{$auto->model}}</span></div>
    
      <div><strong>MOT due date:</strong><br><span>
        @if (isset($auto->motTests))
          {{\App\Support\VehicleDate::format($auto->motTests[0]->expiryDate)}}
        @else
          {{\App\Support\VehicleDate::format($auto->motTestDueDate)}}
        @endif  
      </span></div>  
    <div><strong>Colour:</strong><br><span>{{$auto->primaryColour}}</span></div>
  </div>
  <div class="col-md-6">
    <div><strong>Vehicle brand:</strong><br><span>{{$auto->make}}</span></div>
    <div><strong>Year of registration:</strong><br><span>{{\App\Support\VehicleDate::format($auto->registrationDate)}}</span></div>
    <div><strong>Fuel type:</strong><br><span>{{$auto->fuelType}}</span></div>
  </div>
</div>
