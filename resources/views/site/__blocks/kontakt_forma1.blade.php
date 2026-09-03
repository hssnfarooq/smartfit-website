<section class="appointment_form_section section_space_lg">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
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
          <div class="col-md-6">
            <div class="form-group mb-0">
              <label for="input_name">Your Name</label>
              <input type="text" name="name" class="form-control" id="input_name" placeholder="Enter Your Name" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-0">
              <label for="input_phone">Your Phone</label>
              <input type="tel" name="phone" class="form-control" id="input_phone" placeholder="Enter Your Phone">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-0">
              <label for="input_phone">E-mail</label>
              <input type="email" name="email" class="form-control" id="input_phone" placeholder="Enter Your Email" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-0">
              <label for="input_phone">Subject</label>
              <input type="text" name="subject" class="form-control" id="input_subject" placeholder="Subject of your enquiry">
            </div>
          </div>
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


