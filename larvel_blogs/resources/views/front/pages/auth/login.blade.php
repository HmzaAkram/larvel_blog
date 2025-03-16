@extends('front.layout.app')

@section('title', 'Login')
@section('content')
      <!-- contact section start -->
      <div class="contact_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                     <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active" style="text-indent: 0; border: none; color: #000; font-size: 18px; text-align: center;">1</li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"style="text-indent: 0; border: none; color: #000; font-size: 18px; text-align: center;">2</li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"style="text-indent: 0; border: none; color: #000; font-size: 18px; text-align: center;">3</li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"style="text-indent: 0; border: none; color: #000; font-size: 18px; text-align: center;">4</li>
                     </ol>
                     <div class="carousel-inner">
                        <div class="carousel-item active">
                           <div class="contact_img"></div>
                        </div>
                        <div class="carousel-item">
                           <div class="contact_img"></div>
                        </div>
                        <div class="carousel-item">
                           <div class="contact_img"></div>
                        </div>
                        <div class="carousel-item">
                           <div class="contact_img"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="mail_section">
                  <form action="{{  route('admin.login_handler')  }}" method="POST">
                  <x-form-alerts></x-form-alerts>
</form>
                     <!-- <h1 class="contact_taital">Login</h1>
                     <input type="" class="email_text" placeholder="Name" name="Name">
                     <input type="" class="email_text" placeholder="Phone" name="Phone">
                     <input type="" class="email_text" placeholder="Email" name="Email">
                     <textarea class="massage_text" placeholder="Message" rows="5" id="comment" name="Message"></textarea>
                     <div class="send_bt"><a href="#">send</a></div> -->
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- contact section end -->
      @endsection