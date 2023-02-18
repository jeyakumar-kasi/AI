<?php

    /* 
     * Template Name: Login
     * Author       : Jai K
     * Purpose      : Register, Login, Forgot Password
     * Created On   : 2020-02-10 21:03
     */
    
    # Load Header Page
    get_header();
?>
<section id="content" class="container">

    <div id="login" class="row col-md-6 offset-md-3 dialog act">
        <div class="wrap">
            <form action="" method="post">
            <div class="form ">
                <div class="form-title">
                    <h1>Login</h1>
                </div>

                <div class="row form-content">
                    <div class="form-row">
                          <label>Username</label>
                          <input type="text" name="login_username" id="login-username" class="inp" autofocus placeholder="Email Address"/>
                    </div>

                    <div class="form-row">
                          <label>Password</label>
                          <input type="password" name="login_password" id="login-password" class="inp" autocomplete="off"/>
                    </div>

                    <div class="form-row chk-box" style="padding: 0px 5px;">
                        <input type="checkbox" checked name="login_remember" id="login-remember" >
                        <label for="login-remember">
                            <span></span> Remember Me
                        </label>
                    </div>

                    <div class="form-row ctrls text-center">
                        <a href="javascript: formValidate();" value="Login" class="col-md-2 btn active"><i class="fa fa-lock"></i> Login</a>
                        <input type="reset" value="Clear" class="col-md-2 btn" />
                    </div>

                    <div class="ctrls text-center">
                          <span class="target" data-target="#forgot-password.dialog"><a href="javascript: return false;">Forgot Password</a></span>
                          <span class="target" data-target="#register.dialog"><a href="javascript: return false;">New User?</a></span>
                    </div>

                </div>
            </div>
          </form>
        </div>
    </div>

    <div id="forgot-password" class="row col-md-6 offset-md-3 dialog">
        <div class="wrap">
            <form action="" method="post">
            <div class="form ">
                <div class="form-title">
                    <h1>Forgot Password</h1>
                </div>

                <div class="row form-content">
                    <div class="form-row">
                          <label>Username</label>
                          <input type="text" name="forgot_username" id="forgot-username" class="inp" autofocus placeholder="Email Address"/>
                    </div>

                    <div class="form-row">
                          <span class="small-text">Note: Password reset link will be sent to the above Email Address.</span>
                    </div>

                    <div class="form-row ctrls text-center">
                        <a href="javascript: formValidate();" class="col-md-6 btn active"><i class="fa fa-unlock-alt"></i> Reset Password</a>
                        <input type="reset" value="Clear" class="col-md-2 btn" />
                    </div>

                    <div class="ctrls text-center">
                          <span class="target" data-target="#login.dialog"><a href="javascript: return false;">Try Login again</a></span>
                          <span class="target" data-target="#register.dialog"><a href="javascript: return false;">New User?</a></span>
                    </div>

                </div>
            </div>
          </form>
        </div>
    </div>


    <div id="register" class="row col-md-8 offset-md-2 dialog">
        <div class="wrap">
            <form action="" method="post">
            <div class="form ">
                <div class="form-title">
                    <h1>Register</h1>
                </div>

                <div class="row form-content">
                    <div class="form-row">
                          <label>Name</label>
                          <input type="text" name="reg_name" id="reg-name" class="inp" autofocus placeholder=""/>
                    </div>

                    <div class="form-row">
                          <label>Email Address<span class="small-text"> (Username)</span></label>
                          <input type="email" name="reg_email" id="reg-email" class="inp" placeholder=""/>
                    </div>

                    <div class="form-row">
                        <label for="reg-gender">Gender</label>
                        <select name="reg_gender" id="reg-gender" class="inp" >
                              <option value="1" selected >Male</option>
                              <option value="0">Female</option>
                              <option value="2">Transgender</option>
                        </select>
                    </div>

                    <div class="form-row">
                          <div class="col-md-5 radio-box text-center">
                              <div><input type="radio" checked name="reg-type" id="reg-individual" /></div>
                              <label for="reg-individual">Individual/Personal</label>
                          </div>

                          <div class="col-md-5 radio-box text-center">
                              <div><input type="radio" name="reg-type" id="reg-agent" /></div>
                              <label for="reg-agent">Agent/Dealer</label>
                          </div>
                    </div>

                    <div class="form-row">
                          <label>Contact Number<span class="small-text"> (Optional)</span></label>
                          <input type="text" name="reg_contact_no" id="reg-contact-no" class="inp" placeholder=""/>
                    </div>

                    <div class="form-row">
                          <label>Password</label>
                          <input type="password" name="reg_password" id="reg-password" class="inp"/>
                    </div>

                    <div class="form-row">
                          <label>Confirm Password</label>
                          <input type="password" name="reg_confirm_password" id="reg-confirm-password" class="inp"/>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="reg-state">State</label>
                            <select name="reg_state" id="reg_state" class="inp">
                                <option value="">-- Select the state --</option>
                                <option value="andra-pradesh">Andra Pradesh</option>
                                <option value="kerala">Kerala</option>
                                <option value="tamil-nadu" selected>Tamil Nadu</option>
                                <option value="karnataka">Karnataka</option>
                                <option value="gujarat">Gujarat</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="reg-city">City</label>
                            <select name="reg_city" id="reg-city" class="inp">
                                <option value="">-- Select the city --</option>
                                <option value="chennai">Chennai</option>
                                <option value="tuticorin">Tuticorin</option>
                            </select>
                        </div>
                    </div> <!-- form-row -->

                    <div class="form-row" style="padding: 5px;">
                        <div class="chk-slide chk-tgl-btn">
                            <span>I Agree to the <a href="./terms-conditions" class="link" target="_blank">Terms and Conditions.</a></span>
                            <input type="checkbox" checked name="reg_agree" id="reg-agree" />
                            <label for="reg-agree"></label>
                        </div>
                    </div>

                    <div class="form-row ctrls text-center">
                        <a href="javascript: formValidate();" class="col-md-4 btn active"><i class="fa fa-user-plus"></i> Register</a>
                        <input type="reset" value="Clear" class="col-md-4 btn" />
                    </div>

                    <div class="ctrls text-center">
                          <span class="target" data-target="#login.dialog"><a href="javascript: return false;">Already have an Account?</a></span>
                          <span class="target" data-target="#forgot-password.dialog"><a href="javascript: return false;">Forgot Password</a></span>
                    </div>
                </div>
            </div>
          </form>
      </div>
    </div>
</section> <!-- #content -->
<?php
    # Load Footer Page
    get_footer();