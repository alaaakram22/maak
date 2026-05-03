@include('user.partials.header')


  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="hero-content">
              <div class="trust-badges mb-4" data-aos="fade-right" data-aos-delay="200">
                <div class="badge-item">
                  <i class="bi bi-shield-check"></i>
                  <span>Accredited</span>
                </div>
                <div class="badge-item">
                  <i class="bi bi-clock"></i>
                  <span>24/7 Emergency</span>
                </div>
                <div class="badge-item">
                  <i class="bi bi-star-fill"></i>
                  <span>4.9/5 Rating</span>
                </div>
              </div>

              <h1 data-aos="fade-right" data-aos-delay="300">
                Excellence in <span class="highlight">Homecare</span> With Compassionate Care
              </h1>

              <p class="hero-description" data-aos="fade-right" data-aos-delay="400">
                allows families to search for caregivers, view verified profiles,
                 compare skills and experiences, and book suitable companions either for scheduled visits or urgent needs.
              </p>

              

              <div class="hero-actions" data-aos="fade-right" data-aos-delay="600">
                <a href="{{ url('services') }}" class="btn btn-primary">Book Appointment</a>
              </div>

              <div class="emergency-contact" data-aos="fade-right" data-aos-delay="700">
                <div class="emergency-icon">
                  <i class="bi bi-telephone-fill"></i>
                </div>
                <div class="emergency-info">
                  <small>Emergency Hotline</small>
                  <strong>+02212345678</strong>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="hero-visual" data-aos="fade-left" data-aos-delay="400">
              <div class="main-image">
                <img src="{{asset('user/assets')}}/img/health/help-5.jpg" alt="Modern Healthcare Facility" class="img-fluid">
                
                
              </div>
              <div class="background-elements">
                <div class="element element-1"></div>
                <div class="element element-2"></div>
                <div class="element element-3"></div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Hero Section -->

    <!-- Home About Section -->
    <section id="home-about" class="home-about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right" data-aos-delay="200">
            <div class="about-content">
              <h2 class="section-heading">Compassionate Care, Advanced Help</h2>
              <p class="lead-text">For over two decades, we've been excited for providing exceptional homecare that
                combines cutting-edge medical technology with the personal touch our patients deserve.</p>

              <p>Our multidisciplinary team of specialists works collaboratively to ensure every patient receives
                comprehensive care tailored to their unique needs. From helpful services to intensive medical care, we
                maintain the highest standards of medical excellence while fostering an environment of trust and
                healing.</p>

              <!-- <div class="stats-grid">
                <div class="stat-item">
                  <div class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="15000"
                    data-purecounter-duration="1"></div>
                  <div class="stat-label">Patients Served</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="25"
                    data-purecounter-duration="1"></div>
                  <div class="stat-label">Years of Excellence</div>
                </div>
                <div class="stat-item">
                  <div class="stat-number purecounter" data-purecounter-start="0" data-purecounter-end="50"
                    data-purecounter-duration="1"></div>
                  <div class="stat-label">Medical Specialists</div>
                </div>
              </div> -->

              <div class="cta-section">
                <a href="{{ url('about') }}" class="btn-primary">Learn More About Us</a>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
            <div class="about-visual">
              <div class="main-image">
                <img src="{{asset('user/assets')}}/img/health/help-1.jpg" alt="Modern medical facility" class="img-fluid">
              </div>
              <div class="floating-card">
                <div class="card-content">
                  <div class="icon">
                    <i class="bi bi-heart-pulse"></i>
                  </div>
                  <div class="card-text">
                    <h4>24/7 Emergency Care</h4>
                    <p>Always here when you need us most</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Home About Section -->


  </main>

 

 @include('user.partials.footer')