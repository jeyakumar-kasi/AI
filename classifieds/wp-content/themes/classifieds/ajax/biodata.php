<?php

/* 
 * Author       : Jai K
 * Purpose      : Load the user's information
 * Created On   : 2021-08-09 21:07
 */

?>
<form action="" method="post">
  <div class="row">
      <div class="col-md-3">
          <div id="profile-photo">
              <img src="<?php echo wp_get_upload_dir()['baseurl']; ?>/profile.jpg" />
          </div>
      </div>

      <div class="col-md-9 form simple">
          <div class="form-title">
              <h1>Basic Information</h1>
          </div>

          <div class="row form-content">
              <div class="form-row">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="inp" autofocus placeholder="" value="Jai K"/>
              </div>

              <div class="form-row">
                    <label>Headline</label>
                    <input type="text" name="headline" id="headline" class="inp" placeholder="e.g Building Contractor" value=""/>
              </div>

              <div class="form-row">
                    <label>Username / Email Address</label>
                    <input type="email" name="email" id="email" class="inp" placeholder="" readonly disabled value="dev.jeyakumar@gmail.com" />
              </div>

              <div class="form-row">
                    <label>Contact Number <span class="small-text">(Optional)</span></label>
                    <input type="text" name="contact_no" id="contact-no" class="inp" placeholder="" value="+91 9566041710"/>
              </div>

              <div class="form-row">
                    <label>About me <span class="small-text">(Optional)</span></label>
                    <textarea name="about_me" id="about-me" class="inp" data-count="1800" placeholder="Some words about you..."></textarea>
              </div>

              <div class="form-title">
                  <h1>More Details</h1>
              </div>

              <div class="form-row">
                  <div class="col-md-6">
                      <label for="dob">Date of birth <span class="small-text">(Optional, <b id="age">Age: <span>18</span></b>)</span></label>
                      <div class="group">
                            <select name="dob-month" id="dob-month">
                                <option value="1">Jan</option>
                                <option value="2">Feb</option>
                                <option value="3">Mar</option>
                            </select>
                            <select class="" name="dob-day" id="dob-day">
                                <option value="1">01</option>
                                <option value="2">02</option>
                                <option value="31">31</option>
                            </select>
                            <select name="dob-year" id="dob-year">
                                <option value="1989">1989</option>
                                <option value="2000">2000</option>
                                <option value="2007">2007</option>
                            </select>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="inp" >
                              <option value="1" selected >Male</option>
                              <option value="0">Female</option>
                              <option value="2">Transgender</option>
                        </select>
                    </div>
                </div> <!-- form-row -->

                <div class="form-row">
                    <div class="col-md-6">
                        <label for="state">State</label>
                        <select name="state" id="state" class="inp">
                            <option value="">-- Select the state --</option>
                            <option value="andra-pradesh">Andra Pradesh</option>
                            <option value="kerala">Kerala</option>
                            <option value="tamil-nadu" selected>Tamil Nadu</option>
                            <option value="karnataka">Karnataka</option>
                            <option value="gujarat">Gujarat</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="city">City</label>
                        <select name="city" id="city" class="inp">
                            <option value="">-- Select the city --</option>
                            <option value="chennai">Chennai</option>
                            <option value="tuticorin">Tuticorin</option>
                        </select>
                    </div>
                </div> <!-- form-row -->

              <div class="form-row">
                  <div class="col-md-7">
                      <a href="javascript: formValidate();" class="col-md-2 btn active"><i class="fa fa-save"></i> Save</a>
                      <input type="reset" value="Reset" class="col-md-2 btn" />
                  </div>
                  <div class="col-md-5 tab-header" style="margin-top: 5px; background: #fff;">
                      <div data-target="#tab-5"><i class="fa fa-key"></i> Change Password</div>
                  </div>
              </div>
          </div>
      </div>
    </div>
</form>



