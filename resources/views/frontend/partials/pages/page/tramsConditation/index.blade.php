@extends('frontend.layout.app')

@section('title', 'Terms & Conditions')

@section('content')

    <x-frontend.topbar.topbar :code="$data['hotNewses']" />
    <x-frontend.menu.menu-list :code="$data['menu']" />
    <x-frontend.user.user-login-registration />

    <!-- Breadcrumb Section -->
    <div class="breadcrumbs-header fl-wrap">
        <div class="container">
            <div class="breadcrumbs-header_url">
                <a href="{{ route('home')}}">Home</a><span>Terms & Conditions</span>
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

    <!-- Terms & Conditions Section -->
    <section id="terms-content" class="section-padding" style="padding: 60px 0 !important;">
        <div class="container" style="max-width: 1140px !important; margin: 0 auto !important;">
            <div class="section-heading text-center mb-5" style="margin-bottom: 40px !important;">
                <h2 class="section-title" style="font-size: 36px !important; font-weight: 600 !important; color: #333 !important;">Terms & Conditions</h2>
                <p class="section-subtitle" style="font-size: 18px !important; color: #6c757d !important;">Please read these terms and conditions carefully before using our website.</p>
            </div>

            <div class="terms-content" style="font-size: 16px !important; line-height: 1.8 !important; color: #333 !important;">
                <h3 style="font-size: 24px !important; font-weight: 500 !important; color: #007bff !important; margin-top: 30px !important; margin-bottom: 10px !important; text-align: left !important;">1. Introduction</h3>
                <p>Welcome to our news portal. By accessing and using our website, you agree to comply with and be bound by these Terms & Conditions. If you do not agree with any part of these terms, you should not use our site.</p>

                <h3 style="font-size: 24px !important; font-weight: 500 !important; color: #007bff !important; margin-top: 30px !important; margin-bottom: 10px !important; text-align: left !important;">2. Intellectual Property</h3>
                <p>The content and materials on our website, including but not limited to text, images, and graphics, are owned by or licensed to us. You may not reproduce, distribute, or otherwise use this content without our prior written consent.</p>

                <h3 style="font-size: 24px !important; font-weight: 500 !important; color: #007bff !important; margin-top: 30px !important; margin-bottom: 10px !important; text-align: left !important;">3. Use of Our Website</h3>
                <p>You agree to use our website for lawful purposes only. You may not use our site to engage in any conduct that is illegal, harmful, or otherwise inappropriate.</p>

                <h3 style="font-size: 24px !important; font-weight: 500 !important; color: #007bff !important; margin-top: 30px !important; margin-bottom: 10px !important; text-align: left !important;">4. Disclaimers</h3>
                <p>Our website is provided "as is" and "as available" without any warranties of any kind, either express or implied. We do not guarantee the accuracy, completeness, or reliability of the information on our site.</p>

                <h3 style="font-size: 24px !important; font-weight: 500 !important; color: #007bff !important; margin-top: 30px !important; margin-bottom: 10px !important; text-align: left !important;">5. Limitation of Liability</h3>
                <p>We shall not be liable for any direct, indirect, incidental, consequential, or punitive damages arising out of or in connection with your use of our website or any content provided on our site.</p>

                <h3 style="font-size: 24px !important; font-weight: 500 !important; color: #007bff !important; margin-top: 30px !important; margin-bottom: 10px !important; text-align: left !important;">6. Changes to These Terms</h3>
                <p>We reserve the right to modify these Terms & Conditions at any time. Any changes will be posted on this page with an updated revision date. It is your responsibility to review these terms periodically.</p>

                <h3 style="font-size: 24px !important; font-weight: 500 !important; color: #007bff !important; margin-top: 30px !important; margin-bottom: 10px !important; text-align: left !important;">7. Contact Information</h3>
                <p>If you have any questions about these Terms & Conditions, please <a href="{{ route('page.contact') }}" style="color: #007bff !important; text-decoration: none !important;">contact us</a> through our website.</p>
            </div>
        </div>
    </section>
    <!-- Terms & Conditions Section End -->

    <x-frontend.footer.footer :categories="$data['categories']" :pages="$data['pages']" />

@endsection
