<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->
<!doctype html>
<html lang="en">
  <head>
    @include('frontend.head')  
    @yield('page_head')
  </head>
  <body>



<section class="w3l-top-menu-1">
    
    @include('frontend.topbar')
  
	
</section>

<section class="w3l-bootstrap-header">

    @include('frontend.menu')
  
</section>

@yield('content')

<section class="w3l-footer-29-main">
  <div class="footer-29">
      <div class="container">

          @include('frontend.footer')
         
         
      </div>
  </div>
  
  <button onclick="topFunction()" id="movetop" title="Go to top">
    <span class="fa fa-angle-up"></span>
  </button>
@include('frontend.script')
@yield('page_script')
</body>

</html>
