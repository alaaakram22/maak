@include('user.partials.header')


<body class="contact-page">



    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Contact Us</h1>
                            <p class="mb-0">
                            <p>
                                If you have any questions, suggestions, or need assistance, feel free to contact us.
                                Our team is always ready to help you and will respond as soon as possible.
                            </p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Page Title -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row g-5">
                    <div class="col-lg-5">
                        <div class="contact-info-wrapper">
                            <div class="contact-info-item" data-aos="fade-up" data-aos-delay="100">
                                <div class="info-icon">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div class="info-content">
                                    <h3>Our Address</h3>
                                    <p>123 Nile Street, Downtown District, Cairo 11511, Egypt</p>
                                </div>
                            </div>

                            <div class="contact-info-item" data-aos="fade-up" data-aos-delay="200">
                                <div class="info-icon">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div class="info-content">
                                    <h3>Email Address</h3>
                                    <p>maak@gmail.com</p>
                                    <p>maakcomplaints@gmail.com</p>
                                </div>
                            </div>

                            <div class="contact-info-item" data-aos="fade-up" data-aos-delay="300">
                                <div class="info-icon">
                                    <i class="bi bi-headset"></i>
                                </div>
                                <div class="info-content">
                                    <h3>Hours of Operation</h3>
                                    <p>Sunday-Thur: 9 AM - 6 PM</p>
                                    <p>Saturday: 9 AM - 4 PM</p>
                                </div>
                                <div class="info-content">
                                    <h3>Our Services</h3>
                                    <p>Sunday-Thur: 9 AM - 6 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="contact-form-card" data-aos="fade-up" data-aos-delay="200">
                            <h2>Send us a Message or a Complaint</h2>
                            <p class="mb-4">Have questions or a complaint want to learn more? Reach out to us and our team will get
                                back to you
                                shortly.</p>

                            @if(session('success'))
                            <div class="alert alert-success rounded-3 mb-3">
                                {{ session('success') }}
                            </div>
                            @endif
                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Your Name" required="">
                                    </div>

                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Your Email" required="">
                                    </div>

                                    <div class="col-12">
                                        <input type="text" class="form-control" name="subject" id="subject"
                                            placeholder="Subject" required="">
                                    </div>

                                    <div class="col-12">
                                        <textarea class="form-control" name="message" id="message"
                                            placeholder="Your Message" rows="6" required=""></textarea>
                                    </div>

                                    

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-submit">Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid map-container" data-aos="fade-up" data-aos-delay="200">
                <div class="map-overlay"></div>
                <iframe src="https://www.google.com/maps?q=Tahrir%20Square%2C%20Cairo%2C%20Egypt&output=embed"
                    width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </section><!-- /Contact Section -->

    </main>


</body>

@include('user.partials.footer')