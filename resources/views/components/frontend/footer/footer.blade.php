<footer class="fl-wrap main-footer">
    <div class="container">
        <!-- footer-widget-wrap -->
        <div class="footer-widget-wrap fl-wrap">
            <div class="row">
                <!-- footer-widget -->
                <div class="col-md-4">
                    <div class="footer-widget">
                        <div class="footer-widget-content">
                            <a href="index.html" class="footer-logo"><img src="{{ Storage::url('assets/image/logo/ec_logo_with_name.png') }}" alt=""></a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Eaque ipsa quae ab illo inventore veritatis et quasi architecto. </p>

                            <x-frontend.social-icon.social-icon :position="'footer'" />

                        </div>
                    </div>
                </div>
                <!-- footer-widget  end-->
                <!-- footer-widget -->
                <div class="col-md-2">
                    <div class="footer-widget">
                        <div class="footer-widget-title">Cetegories </div>
                        <div class="footer-widget-content">
                            <div class="footer-list footer-box fl-wrap">
                                <ul>
                                    @foreach ($data['categories'] as $category)
                                        <li> <a href="{{ URL::to($category['slug'])}}">{{ $category['title'] }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer-widget  end-->
                <!-- footer-widget -->
                <div class="col-md-2">
                    <div class="footer-widget">
                        <div class="footer-widget-title">Links</div>
                        <div class="footer-widget-content">
                            <div class="footer-list footer-box fl-wrap">
                                <ul>
                                    @foreach ($data['pages'] as $page)
                                        <li> <a href="{{ URL::to($page['slug'])}}">{{ $page['title'] }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer-widget  end-->
                <!-- footer-widget -->
                <div class="col-md-4">
                    <div class="footer-widget">
                        <div class="footer-widget-title">Subscribe</div>
                        <div class="footer-widget-content">
                            <div class="subcribe-form fl-wrap">
                                <p>Want to be notified when we launch a new template or an udpate. Just sign up and we'll send you a notification by email.</p>
                                <form id="mail-subscribe-form" method="post">
                                    <input class="enteremail" name="email" id="subscribe-email" placeholder="Your Email" spellcheck="false" type="text">
                                    <button type="button" id="mail-subscribe-button" class="subscribe-button color-bg">Send </button>
                                    <label for="subscribe-email" class="subscribe-message"></label>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer-widget  end-->
            </div>
        </div>
        <!-- footer-widget-wrap end-->
    </div>
    <div class="footer-bottom fl-wrap">
        <div class="container">
            <div class="copyright"><span>&#169; Infra-Red Communications Limited
            </span> . All rights reserved. </div>
            <div class="to-top"> <i class="fas fa-caret-up"></i></div>
            <div class="subfooter-nav">
                <ul>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
