@include('user.partials.header')
<body class="about-page">
<main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-10">
              <h1 class="heading-title">About Us</h1>
              <p class="mb-0">
                The idea  is to create a digital platform that facilitates the process of finding reliable caregivers and companions for adults and elderly people who need assistance or emotional support.
The platform allows families to search for caregivers, view verified profiles, compare skills and experiences, and book suitable companions either for scheduled visits or urgent needs. 

              </p>
            </div>
          </div>
        </div>
      </div>
      
    </div><!-- End Page Title -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <div class="about-content">
              <h2>Compassionate Care for Every Family</h2>
              <p class="lead">For over two decades, we have been dedicated to providing exceptional healthcare services
                to our community. Our commitment goes beyond medical treatment—we believe in building lasting
                relationships with our patients and their families.</p>

              <!-- End Stats Grid -->
            </div><!-- End About Content -->
          </div>

          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
            <div class="image-wrapper">
              <img src="{{asset('user/assets')}}/img/health/help-4.jpg" class="img-fluid main-image" alt="Healthcare facility">
            </div><!-- End Image Wrapper -->
          </div>
        </div>

        <div class="values-section" data-aos="fade-up" data-aos-delay="300">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h3>Our Core Values</h3>
              <p class="section-description">These principles guide everything we do in our commitment to exceptional
                homecare</p>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
              <div class="value-item">
                <div class="value-icon">
                  <i class="bi bi-heart-pulse"></i>
                </div>
                <h4>Compassion</h4>
                <p>Providing care with empathy and understanding for every patient's unique needs and circumstances.</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
              <div class="value-item">
                <div class="value-icon">
                  <i class="bi bi-shield-check"></i>
                </div>
                <h4>Excellence</h4>
                <p>Maintaining the highest standards of care through continuous learning and innovation.</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
              <div class="value-item">
                <div class="value-icon">
                  <i class="bi bi-people"></i>
                </div>
                <h4>Integrity</h4>
                <p>Building trust through honest communication and ethical practices in all our interactions.</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
              <div class="value-item">
                <div class="value-icon">
                  <i class="bi bi-lightbulb"></i>
                </div>
                <h4>Innovation</h4>
                <p>Embracing cutting-edge technology and treatments to improve patient outcomes.</p>
              </div>
            </div>
          </div><!-- End Values Row -->
        </div><!-- End Values Section -->

        
      </div>

    </section><!-- /About Section -->

  </main>
</body>
  @include('user.partials.footer')