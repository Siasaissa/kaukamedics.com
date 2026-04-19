@include('layouts.head')
<body>
    @include('layouts.topbar')

    <!-- Navbar Start -->
    @include('layouts.navbar')

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-4">
            <h1 class="display-3 animated slideInDown">Contact</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#!">Home</a></li>
                    <li class="breadcrumb-item"><a href="#!">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Video Start -->
<div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-0">
            <div class="col-lg-11">
                <div class="h-100 py-5 d-flex align-items-center">
                    <button type="button" class="btn-play" data-bs-toggle="modal"
                        data-src="{{asset('img/video4.mp4')}}" data-bs-target="#videoModal">
                        <span></span>
                    </button>
                    <h3 class="ms-5 mb-0">Delivering trusted medical supplies that empower healthcare professionals to save lives every day.</h3>
                </div>
            </div>
            <div class="d-none d-lg-block col-lg-1">
                <div class="h-100 w-100 bg-secondary d-flex align-items-center justify-content-center">
                    <span class="text-white" style="transform: rotate(-90deg);">Scroll Down</span>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Video End -->


    <!-- Video Modal Start -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Company Overview Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ratio ratio-16x9">
                    <video id="video" class="w-100 rounded" controls autoplay muted>
                        <source src="{{ asset('img/video4.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Video Modal End -->


    <!-- Contact Start -->
    <div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                <p class="section-title bg-white text-start text-primary pe-3">Contact</p>
                <h1 class="display-6 mb-4 wow fadeIn" data-wow-delay="0.2s">
                    Have Questions? Get in Touch With Us
                </h1>
                <iframe
  class="w-100"
  src="https://www.google.com/maps?q=-6.80486,39.25936&z=16&output=embed"
  frameborder="0"
  style="height:425px; border:0;"
  allowfullscreen=""
  aria-hidden="false"
  tabindex="0"></iframe>

            </div>
            <div class="col-lg-7 wow fadeIn" data-wow-delay="0.3s">
                <h3>Send Us a Message</h3>
                <p class="mb-4">
                    Have inquiries about our medical products or need support? Fill out the form below and our team
                    will respond promptly to assist you.
                </p>
                <form action="{{ route('contact.send') }}" method="POST">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required>
                <label for="name">Your Name</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                <label for="email">Your Email</label>
            </div>
        </div>
        <div class="col-12">
            <div class="form-floating">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                <label for="subject">Subject</label>
            </div>
        </div>
        <div class="col-12">
            <div class="form-floating">
                <textarea class="form-control" name="message" placeholder="Leave a message here" id="message" style="height: 250px" required></textarea>
                <label for="message">Message</label>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary py-3 px-4" type="submit">Send Message</button>
        </div>
    </div>
</form>

            </div>
        </div>
    </div>
</div>

    <!-- Contact End -->





    <!-- Footer Start -->
   @include('layouts.footer')

    <!-- Back to Top -->
    <a href="#!" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
@include('layouts.links')
</body>

</html>