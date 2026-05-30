@include('user.partials.header')




<main class="main">

    <a href="tel:123" class="emergency-call-box">
        <i class="bi bi-telephone-fill"></i>
        Emergency 123
    </a>

    @php
        $hospitals = [
            [
                'name' => 'As-Salam International Hospital',
                'phone' => '19885',
                'phone_link' => '19885',
                'location' => 'Nile Corniche, Athar an Nabi, Maadi, Cairo',
                'type' => 'General Hospital',
                'icon' => 'bi-hospital',
            ],
            [
                'name' => 'Saudi German Hospital Cairo',
                'phone' => '01211667788',
                'phone_link' => '01211667788',
                'location' => '47 Joseph Tito Street, Taha Hussein Axis, New Nozha, Cairo',
                'type' => 'General Hospital',
                'icon' => 'bi-heart-pulse',
            ],
            [
                'name' => 'Air Force Specialized Hospital',
                'phone' => '19448',
                'phone_link' => '19448',
                'location' => 'El-Tesseen Street, Fifth Settlement, New Cairo',
                'type' => 'Specialized Hospital',
                'icon' => 'bi-shield-plus',
            ],
            [
                'name' => 'Ain Shams Specialized Hospital',
                'phone' => '024039012',
                'phone_link' => '024039012',
                'location' => 'El-Khalifa El-Maamoun Street, Abbassia, Cairo',
                'type' => 'Specialized Hospital',
                'icon' => 'bi-building',
            ],
            [
                'name' => 'Kasr Al Ainy Hospital',
                'phone' => '+20223647545',
                'phone_link' => '+20223647545',
                'location' => 'Kasr Al Ainy Faculty of Medicine, Al-Manial, Cairo',
                'type' => 'University Hospital',
                'icon' => 'bi-mortarboard',
            ],
            [
                'name' => 'Nile Badrawi Hospital',
                'phone' => '19668',
                'phone_link' => '19668',
                'location' => 'Corniche El Nile, Maadi, Cairo',
                'type' => 'General Hospital',
                'icon' => 'bi-hospital',
            ],
            [
                'name' => 'Cleopatra Hospital',
                'phone' => '19668',
                'phone_link' => '19668',
                'location' => '39 Cleopatra Street, Salah Eldin Square, Heliopolis, Cairo',
                'type' => 'General Hospital',
                'icon' => 'bi-plus-square',
            ],
            [
                'name' => 'Dar Al Fouad Hospital',
                'phone' => '16370',
                'phone_link' => '16370',
                'location' => '6th of October City, Giza',
                'type' => 'General Hospital',
                'icon' => 'bi-activity',
            ],
            [
                'name' => 'Andalusia Hospital Maadi',
                'phone' => '01229359185',
                'phone_link' => '01229359185',
                'location' => 'Maadi, Cairo',
                'type' => 'General Hospital',
                'icon' => 'bi-hospital',
            ],
        ];
    @endphp

    <style>
        .hospitals-page {
            padding-top: 120px;
            padding-bottom: 70px;
            background: linear-gradient(180deg, #f8fbff 0%, #ffffff 55%, #f7f9fc 100%);
            min-height: 100vh;
        }

        .emergency-call-box {
            position: fixed;
            top: 90px;
            right: 25px;
            z-index: 9999;
            background: #dc2626;
            color: #ffffff;
            padding: 12px 18px;
            border-radius: 999px;
            font-weight: 800;
            font-size: 15px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 12px 30px rgba(220, 38, 38, 0.35);
            transition: all 0.2s ease;
        }

        .emergency-call-box:hover {
            background: #b91c1c;
            color: #ffffff;
            transform: translateY(-2px);
        }

        .hospitals-hero {
            background: linear-gradient(135deg, #eef5ff 0%, #ffffff 60%);
            border-radius: 28px;
            padding: 45px 35px;
            margin-bottom: 35px;
            border: 1px solid #e5edf8;
            position: relative;
            overflow: hidden;
        }

        .hospitals-hero::after {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(65, 105, 225, 0.10);
            right: -70px;
            top: -80px;
        }

        .hospitals-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #ffffff;
            color: #315b9d;
            padding: 9px 15px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 10px 25px rgba(36, 64, 115, 0.08);
            margin-bottom: 18px;
        }

        .hospitals-title {
            font-size: 42px;
            font-weight: 800;
            color: #0f2344;
            margin-bottom: 12px;
        }

        .hospitals-description {
            color: #627086;
            font-size: 17px;
            max-width: 720px;
            line-height: 1.7;
            margin-bottom: 0;
        }

        .hospital-card {
            background: #ffffff;
            border: 1px solid #e9eef6;
            border-radius: 24px;
            padding: 26px;
            height: 100%;
            box-shadow: 0 14px 35px rgba(15, 35, 68, 0.06);
            transition: all 0.25s ease;
        }

        .hospital-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 45px rgba(15, 35, 68, 0.11);
            border-color: #d8e5f8;
        }

        .hospital-icon {
            width: 56px;
            height: 56px;
            border-radius: 18px;
            background: #eef5ff;
            color: #2f6edb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            margin-bottom: 18px;
        }

        .hospital-name {
            font-size: 19px;
            font-weight: 800;
            color: #102340;
            margin-bottom: 8px;
        }

        .hospital-type {
            display: inline-block;
            background: #f2f6fb;
            color: #49627d;
            padding: 6px 11px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .hospital-info {
            display: flex;
            gap: 10px;
            color: #5e6d82;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 12px;
        }

        .hospital-info i {
            color: #2f6edb;
            font-size: 18px;
            margin-top: 2px;
        }

        .hospital-actions {
            display: flex;
            gap: 10px;
            margin-top: 22px;
            flex-wrap: wrap;
        }

        .hospital-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .hospital-btn-call {
            background: #2f6edb;
            color: #ffffff;
        }

        .hospital-btn-call:hover {
            background: #245bb8;
            color: #ffffff;
        }

        .hospital-btn-map {
            background: #f1f5f9;
            color: #23374d;
        }

        .hospital-btn-map:hover {
            background: #e2e8f0;
            color: #102340;
        }

        @media (max-width: 768px) {
            .hospitals-page {
                padding-top: 100px;
            }

            .emergency-call-box {
                top: 82px;
                right: 12px;
                font-size: 13px;
                padding: 10px 14px;
            }

            .hospitals-hero {
                padding: 32px 22px;
            }

            .hospitals-title {
                font-size: 32px;
            }

            .hospitals-description {
                font-size: 15px;
            }
        }
    </style>

    <section class="hospitals-page">
        <div class="container">

            <div class="hospitals-hero" data-aos="fade-up">
                <div class="hospitals-badge">
                    <i class="bi bi-hospital"></i>
                    <span>Hospitals Directory</span>
                </div>

                <h1 class="hospitals-title">
                    Nearby Hospitals & Emergency Contacts
                </h1>

                <p class="hospitals-description">
                    Browse a list of hospitals with contact numbers and locations to help patients,
                    families, and caregivers reach medical support faster when needed.
                </p>
            </div>

            <div class="row gy-4">
                @foreach ($hospitals as $hospital)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 80 }}">
                        <div class="hospital-card">

                            <div class="hospital-icon">
                                <i class="bi {{ $hospital['icon'] }}"></i>
                            </div>

                            <h3 class="hospital-name">
                                {{ $hospital['name'] }}
                            </h3>

                            <span class="hospital-type">
                                {{ $hospital['type'] }}
                            </span>

                            <div class="hospital-info">
                                <i class="bi bi-telephone"></i>
                                <div>
                                    <strong>Phone:</strong>
                                    <br>
                                    {{ $hospital['phone'] }}
                                </div>
                            </div>

                            <div class="hospital-info">
                                <i class="bi bi-geo-alt"></i>
                                <div>
                                    <strong>Location:</strong>
                                    <br>
                                    {{ $hospital['location'] }}
                                </div>
                            </div>

                            <div class="hospital-actions">
                                <a href="tel:{{ $hospital['phone_link'] }}" class="hospital-btn hospital-btn-call">
                                    <i class="bi bi-telephone-fill"></i>
                                    Call
                                </a>

                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($hospital['location']) }}"
                                   target="_blank"
                                   class="hospital-btn hospital-btn-map">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    View Location
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

</main>

@include('user.partials.footer')