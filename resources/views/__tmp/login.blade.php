<section class="page_banner" style="background-image: url('assets/images/shapes/tyre_print_3.svg');">
    <div class="container">
    <ul class="breadcrumb_nav unordered_list">
        <li><a href="index.html">Home</a></li>
        <li><a href="cart.html">Login/Register</a></li>
    </ul>
    <h1 class="page_title wow" data-splitting>Login or Register</h1>
    </div>
</section>

<section class="appointment_form_section section_space_lg">
    <div class="container">
      <div class="row">

        <div class="col-lg-6">
          <div class="section_heading">
            <div class="outline_text">Contact Us</div>
            <h3 class="heading_text wow" data-splitting>{!!html_entity_decode($block->input('title'))!!}</h3>
            <p class="heading_description mb-0">
              {!!html_entity_decode($block->input('description'))!!}
            </p>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="section_heading">
            <div class="outline_text">Contact Us</div>
            <h3 class="heading_text wow" data-splitting>{!!html_entity_decode($block->input('title'))!!}</h3>
            <p class="heading_description mb-0">
              {!!html_entity_decode($block->input('description'))!!}
            </p>
          </div>
        </div>


      </div>
      <form action="contactacts">
        <div class="form_wrap row">

          <!--<div class="col-md-6">
            <div class="form-group mb-0">
              <label for="input_date">Select Date</label>
              <input type="date" name="date" class="form-control" id="input_date">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-0">
              <label for="input_time">Select Time</label>
              <input type="time" name="time" class="form-control" id="input_time">
            </div>
          </div>-->
          <div class="col-12">
            <div class="form-group">
              <label for="input_textarea">Your Question/Message</label>
              <textarea name="message" class="form-control" id="input_textarea" placeholder="Your Question/Message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
              <span class="btn_text">Send Now</span>
            </button>
          </div>
        </div>
      </form>
    </div>
</section>
