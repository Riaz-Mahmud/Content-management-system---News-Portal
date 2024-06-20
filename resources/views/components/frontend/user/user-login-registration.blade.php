<!--register form -->
<div class="main-register-container">
    <div class="reg-overlay close-reg-form"></div>
    <div class="main-register-holder">
        <div class="fl-wrap">
            <div class="main-register tabs-act fl-wrap">
                <ul class="tabs-menu">
                    <li class="current"><a href="#tab-1"><i class="fal fa-sign-in-alt"></i> Login</a></li>
                    <li><a href="#tab-2"><i class="fal fa-user-plus"></i> Register</a></li>
                </ul>
                <div class="close-modal close-reg-form"><i class="fal fa-times"></i></div>
                <!--tabs -->
                <div id="tabs-container">
                    <div class="tab">
                        <!--tab -->
                        <div id="tab-1" class="tab-content first-tab">
                            <div class="custom-form">
                                <form method="POST" action="{{ route('login') }}" name="registerform">
                                    @csrf
                                    <label>Email Address <span>*</span> </label>
                                    <input type="text" onClick="this.select()" name="email" :value="old('email')" required autofocus autocomplete="email" >

                                    <label>Password <span>*</span> </label>
                                    <input type="password" onClick="this.select()" type="password" name="password" required autocomplete="current-password">

                                    <div class="filter-tags">
                                        <input id="check-a" type="checkbox" name="check" checked>
                                        <label for="check-a">Remember me</label>
                                    </div>
                                    <div class="lost_password">
                                        <a href="#">Lost Your Password?</a>
                                    </div>
                                    <div class="clearfix"></div>
                                    <button type="submit" class="log-submit-btn color-bg"><span>Log In</span></button>
                                </form>
                            </div>
                        </div>
                        <!--tab end -->
                        <!--tab -->
                        <div class="tab">
                            <div id="tab-2" class="tab-content">
                                <div class="custom-form">
                                    <form method="POST" action="{{ route('register') }}" name="registerform" class="main-register-form" id="main-register-form2">
                                        @csrf

                                        <label>First Name <span>*</span> </label>
                                        <input name="first_name" type="text" onClick="this.select()" :value="old('first_name')" required autofocus autocomplete="first name" >

                                        <label>Last Name</label>
                                        <input name="last_name" type="text" onClick="this.select()" :value="old('last_name')" autofocus autocomplete="last name" >

                                        <label>Email Address <span>*</span></label>
                                        <input name="email" type="text" onClick="this.select()" :value="old('email')" autocomplete="email" >

                                        <label>Profession <span>*</span> </label>
                                        <input name="profession" type="text" onClick="this.select()" :value="old('profession')" required autofocus>

                                        <label>Field of Profession<span>*</span> </label>
                                        <input name="field_of_profession" type="text" onClick="this.select()" :value="old('field_of_profession')" required autofocus>

                                        <label>Address <span>*</span> </label>
                                        <textarea name="address" onClick="this.select()" :value="old('address')" required autofocus>{{ old('address') }}</textarea>

                                        <label>Country <span>*</span> </label>
                                        <input name="country" type="text" onClick="this.select()" :value="old('country')" autofocus>

                                        <label>URL of the recently published article or news <span>*</span> </label>
                                        <input name="publication" type="text" onClick="this.select()" :value="old('publication')" required autofocus>

                                        <label>Phone Number <span>*</span> </label>
                                        <input name="phone_number" type="text" onClick="this.select()" :value="old('phone_number')" required autofocus>

                                        <label>Organization <span>*</span> </label>
                                        <input name="organization" type="text" onClick="this.select()" :value="old('organization')" required autofocus>

                                        <label>Organization Address <span>*</span> </label>
                                        <input name="organization_address" type="text" onClick="this.select()" :value="old('organization_address')" required autofocus autocomplete="organization address">

                                        <label>Password <span>*</span></label>
                                        <input name="password" type="password" onClick="this.select()" required autocomplete="new-password">

                                        <label>Confirm Password <span>*</span></label>
                                        <input name="password_confirmation" type="password" onClick="this.select()" required autocomplete="new-password">

                                        <button type="submit" class="log-submit-btn color-bg"><span>Register</span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--tab end -->
                    </div>
                    <!--tabs end -->
                    <div class="log-separator fl-wrap"><span>or</span></div>
                    <div class="soc-log  fl-wrap">
                        <p>For faster login or register use your social account.</p>
                        <a href="#" ><i class="fab fa-facebook-f"></i>Connect with Facebook</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--register form end -->
