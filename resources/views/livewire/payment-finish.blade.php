@if (!empty($this->redirekt)) 
@push('scripts')
  <script>document.location = '{{$this->redirekt}}';</script>
@endpush
@endif
<section class="page_banner" style="background-image: url('assets/images/shapes/tyre_print_3.svg');">
    <div class="container">
      <ul class="breadcrumb_nav unordered_list">
        <li><a href="/">Home</a></li><li>Booking Payment</li>
      </ul>
      <h1 class="page_title wow" data-splitting>Booking Payment</h1>
    </div>
  </section>
  
  
  
  
  <section class="details_section section_space_lg pb-10">
    <div class="container ">
      <div class="row ">
  
        <div class="col-md-6">
            <button class="btn btn-primary" type="button" disabled>
            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
            <span role="status">Processing...</span>
            </button>
        </div>
  
        <div class="col-md-4">
          
        </div>
  
      </div>
    </div>
  </section>