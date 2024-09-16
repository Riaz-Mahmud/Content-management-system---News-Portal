@extends('frontend.layout.app')

@section('title', 'Privacy Policy')

@section('content')

    <x-frontend.topbar.topbar :code="$data['hotNewses']" />
    <x-frontend.menu.menu-list :code="$data['menu']" />
    <x-frontend.user.user-login-registration />

    <!-- Breadcrumb Section -->
    <div class="breadcrumbs-header fl-wrap">
        <div class="container">
            <div class="breadcrumbs-header_url">
                <a href="{{ route('home')}}">Home</a><span>Privacy Policy</span>
            </div>
            <div class="scroll-down-wrap">
                <div class="mousey">
                    <div class="scroller"></div>
                </div>
                <span>Scroll Down To Discover</span>
            </div>
        </div>
        <div class="pwh_bg"></div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Privacy Policy Section -->
    <section id="policy-content" class="section-padding" style="padding: 60px 0 !important;">
        <div class="container" style="max-width: 1140px !important; margin: 0 auto !important;">
            <div class="section-heading text-center mb-5" style="margin-bottom: 40px !important;">
                <h2 class="section-title" style="font-size: 36px !important; font-weight: 600 !important; color: #333 !important;">Privacy Policy</h2>
                <p class="section-subtitle" style="font-size: 18px !important; color: #6c757d !important;">Your privacy is important to us. Please read our policy to understand how we handle your information.</p>
            </div>

            <div class="policy-content" style="font-size: 16px !important; line-height: 1.8 !important; color: #333 !important;">
                <h3 style="font-size: 24px !important; font-weight: 500 !important; color: #007bff !important; margin-top: 30px !important; margin-bottom: 10px !important; text-align: left !important;">1. General Information</h3>
                <p>We are committed to safeguarding your privacy when you use our website. This Privacy Policy outlines how we manage information on our site. Please note that we do not collect personal information such as names, email addresses, or account details.</p>

                <h3 style="font-size: 24px !important; font-weight: 500 !important; color: #007bff !important; margin-top: 30px !important; margin-bottom: 10px !important; text-align: left !important;">2. Use of Cookies</h3>
                <p>We use cookies to improve your browsing experience. Cookies are small text files stored on your device when you visit our site. They help enhance functionality and provide analytical insights. You can control or disable cookies through your browser settings if desired.</p>

                <h3 style="font-size: 24px !important; font-weight: 500 !important; color: #007bff !important; margin-top: 30px !important; margin-bottom: 10px !important; text-align: left !important;">3. Third-Party Services</h3>
                <p>We utilize third-party services like Google Analytics to monitor website performance and user engagement. These services collect non-personal data such as device information, browser type, and pages visited. No personally identifiable information is collected or shared.</p>

                <h3 style="font-size: 24px !important; font-weight: 500 !important; color: #007bff !important; margin-top: 30px !important; margin-bottom: 10px !important; text-align: left !important;">4. Data Security</h3>
                <p>Even though we do not collect personal data, we employ best practices to secure the information we receive via cookies and third-party analytics. We use robust security protocols to protect our website and prevent unauthorized access.</p>

                <h3 style="font-size: 24px !important; font-weight: 500 !important; color: #007bff !important; margin-top: 30px !important; margin-bottom: 10px !important; text-align: left !important;">5. Updates to this Privacy Policy</h3>
                <p>We may revise this Privacy Policy from time to time. Any significant changes will be clearly indicated on this page. We encourage you to review this policy periodically to stay informed about how we are protecting your privacy.</p>

                <h3 style="font-size: 24px !important; font-weight: 500 !important; color: #007bff !important; margin-top: 30px !important; margin-bottom: 10px !important; text-align: left !important;">6. Contact Information</h3>
                <p>If you have any questions about our Privacy Policy or data handling practices, feel free to <a href="{{ route('page.contact') }}" style="color: #007bff !important; text-decoration: none !important;">contact us</a> through our website.</p>
            </div>
        </div>
    </section>

    <!-- Privacy Policy Section End -->

    <x-frontend.footer.footer :categories="$data['categories']" :pages="$data['pages']" />

@endsection
