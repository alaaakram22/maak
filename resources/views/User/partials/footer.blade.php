<footer id="footer" class="footer-16 footer position-relative">

    <div class="container">

        <div class="footer-main" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-start">

                <!-- Left Side -->
                <div class="col-lg-5">

                    <div class="brand-section">

                        <a href="{{ url('/') }}" class="logo d-flex align-items-center mb-4">
                            <span class="sitename">Maak Care</span>
                        </a>

                        <p class="brand-description">
                            Providing trusted caregiving services with compassion,
                            professionalism, and a commitment to improving quality of life.
                        </p>

                        <div class="contact-info mt-5">

                            <!-- Address -->
                            <div class="contact-item mb-3">
                                <i class="bi bi-geo-alt"></i>
                                <span>
                                    123 Nile Street, Downtown District, Cairo 11511, Egypt
                                </span>
                            </div>

                            <!-- Hotline -->
                            <div class="contact-item mb-3">
                                <i class="bi bi-telephone-fill text-danger"></i>

                                <div>
                                    <small class="text-muted d-block">
                                        Customer Support
                                    </small>

                                    <a href="tel:+02212345678"
                                        class="fw-bold text-decoration-none d-block">
                                        +02 2123 45678
                                    </a>

                                    <small class="text-muted d-block mt-2">
                                        Emergency Hotline
                                    </small>

                                    <a href="tel:+02198765432"
                                        class="fw-bold text-danger text-decoration-none d-block">
                                        +02 1987 65432
                                    </a>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="contact-item mb-4">
                                <i class="bi bi-envelope"></i>
                                <span>maak@gmail.com</span>
                            </div>

                            <!-- Social Media -->
                            <div class="social-links d-flex gap-3">

                                <a href="#!" class="twitter">
                                    <i class="bi bi-twitter-x"></i>
                                </a>

                                <a href="#!" class="facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>

                                <a href="#!" class="instagram">
                                    <i class="bi bi-instagram"></i>
                                </a>

                                <a href="#!" class="linkedin">
                                    <i class="bi bi-linkedin"></i>
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Right Side -->
                <div class="col-lg-7">

                    <div class="footer-nav-wrapper">

                        <div class="row">

                            <div class="col-6 col-lg-3">

                                <div class="nav-column">

                                    <h6>About Us</h6>

                                    <nav class="footer-nav">
                                        <a href="{{ url('/') }}">
                                            Home
                                        </a>

                                        <a href="{{ url('/about') }}">
                                            Our Story
                                        </a>

                                    </nav>

                                </div>

                            </div>

                            <div class="col-6 col-lg-3">

                                <div class="nav-column">

                                    <h6>Services</h6>

                                    <nav class="footer-nav">

                                        <a href="{{ url('medicalcaregivers') }}">
                                            Medical Caregivers
                                        </a>

                                        <a href="{{ url('caringcaregivers') }}">
                                            Personal Caregivers
                                        </a>

                                    </nav>

                                </div>

                            </div>

                            <div class="col-6 col-lg-3">

                                <div class="nav-column">

                                    <h6>Support</h6>

                                    <nav class="footer-nav">

                                        <a href="{{ url('contact') }}">
                                            Help Center
                                        </a>

                                

                                        <a href="{{ url('/contact') }}">
                                            Contact Us
                                        </a>

                                    </nav>

                                </div>

                            </div>

                        

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>

    <!-- Bottom Footer -->
    <div class="footer-bottom">

        <div class="container">

            <div class="bottom-content" data-aos="fade-up" data-aos-delay="300">

                <div class="row align-items-center">

                    <div class="col-lg-6">

                        <div class="copyright">
                            <p>
                                © {{ date('Y') }}
                                <span class="sitename">Maak Care</span>.
                                All rights reserved.
                            </p>
                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div class="legal-links">

                            <a href="#">
                                Privacy Policy
                            </a>

                            <a href="#">
                                Terms of Service
                            </a>

                            <a href="#">
                                Cookie Policy
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</footer>

<!-- Scroll Top -->
<a href="#!" id="scroll-top"
    class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
</a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS -->
<script src="{{ asset('user/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('user/assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('user/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('user/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('user/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('user/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('user/assets/js/main.js') }}"></script>

</body>
</html>