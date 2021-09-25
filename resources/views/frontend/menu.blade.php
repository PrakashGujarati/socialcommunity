<nav class="navbar navbar-expand-lg navbar-light  py-lg-2 py-2">
    <div class="container">
     <img src="assets/images/latest_logo.png" style="height:70px ; width:70px">
      <!-- if logo is image enable this   
    <a class="navbar-brand" href="#index.html">
        <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
    </a> -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon fa fa-bars"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto mt-2">
          <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('history')}}">History</a>
          </li>
           <li class="nav-item dropdown">
            <a class="nav-link " href="#" data-bs-toggle="dropdown">Members</a>
              <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{route('commite')}}">Committe</a></li>
                  <li><a class="dropdown-item" href="{{route('employee')}}"> Over Employees </a></li>                  
              </ul>
          </li>          
          <li class="nav-item">
            <a class="nav-link" href="#">Gallery</a>
          </li>
          <!-- <li class="nav-item dropdown">
            <a class="nav-link" href="contact.html"  data-bs-toggle="dropdown">Events</a>
            <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Past Events</a></li>
                                   
              </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">Blog</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="#">Books</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('contct')}}">Contact Us</a>
          </li>
        </ul>
        <form action="#" class="form-inline position-relative my-2 my-lg-0">
          <!-- <input class="form-control search" type="search" placeholder="Search here..." aria-label="Search" required=""> -->
          <button class="btn btn-search position-absolute" type="submit"><span class="fa fa-search" aria-hidden="true"></span></button>
        </form>
      </div>
    </div>
  </nav>