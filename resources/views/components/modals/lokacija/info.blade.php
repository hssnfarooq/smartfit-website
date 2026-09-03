<div class="row g-3">
    <div class="col-12">
      <div><strong>{{$data->title}}</strong></div>
      <div><strong>Address:</strong><br><span>{{$data->address}}</span></div>
      <div><strong>Phone No.:</strong><br><span>{{$data->phone}}</span></div>
      <div><strong>E-mail:</strong><br><span>{{$data->email}}</span></div>
      {!!html_entity_decode($data->g_map)!!}
    </div>
  </div>