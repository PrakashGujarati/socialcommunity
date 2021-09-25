@extends('frontend.main')
@section('content')
<!-- contact -->
<section class="w3l-contacts-12" id="">
    <div class="contact-top">
     
        <!-- map -->
        <div class="map map mt-md-0 mt-5">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d29539.412479510163!2d70.804594!3d22.261826!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x76a7e6fb937b358!2sKhant%20Rajput%20Samaj!5e0!3m2!1sen!2sin!4v1632304978862!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <!-- //map -->
    </div>
</section>
<!-- //contact -->
<div class="container-fluide pt-5 pb-5">
      <div class="row pt-3"> 
        <div class="col-md-2"></div>
        <div class="col-md-4">
          <h2 class="text-align-left">Rajkot Samaj</h2>
          <p class="mt-3"><span class="fa fa-map-marker location"></span>  &nbsp; &nbsp; &nbsp;6/7, Naherunagar, Dhebar Road South, Ahir chowk,<br> &nbsp; &nbsp; &nbsp; &nbsp; Bolbala 80 Feet Rd, Atika Industrial Area, Rajkot, Gujarat<br>&nbsp; &nbsp; &nbsp; &nbsp; 360002</p>
          <p class="mt-4"><span class="fa fa-phone location"></span> &nbsp; &nbsp; &nbsp;+9196015 26565</p>
        </div>
        <div class="col-md-4">

          <h2 class="text-align-left">Junagadh Samaj</h2>
          <p class="mt-3"><span class="fa fa-map-marker location"></span>  &nbsp; &nbsp; &nbsp;Girnar Taleti. Bhavnath, Junagadh</p>
          <p class="mt-4"><span class="fa fa-phone location"></span> &nbsp; &nbsp; &nbsp;+919727573157</p>
        </div>
      </div>
      <div class="row pt-5">
        <div class="col-md-2"></div>
          <div class="col-md-4" >
              <h2 class="text-align-left">Get Social</h2>
              <div class="social_icon">
                  <a href="#facebook" class="facebook-links"><span class="fa fa-facebook"></span></a>
                  <a href="#twitter" class="youtube-links"><span class="fa fa-youtube-play"></span></a>
                  <a href="#instagram" class="instagram-links"><span class="fa fa-instagram"></span></a>
            </div> 
            <p class="pt-5">Contact Info</p>   
            <div class="contact-info mt-5 ml-3"> 
            <a href="#"><span class="fa fa-envelope"></span>&nbsp; &nbsp;khantrajputsamaj@gmail.com</a>  
            </div>
          </div>          
          <div class="col-md-4">
            <h2>Give Your Suggestion.</h2>
            <form action="" method="">
  <div class="form-group mt-4">
    <label for="formGroupExampleInput">Name(required)</label>
    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Email(required) </label>
    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">Mobile(required) </label>
    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">Address(required) </label>
    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">Subject</label>
    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Your Message</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="button" class="btn btn-send btn-lg">Send</button>
</form>
          </div>
      </div>
      
      
</div>
@endsection
  



