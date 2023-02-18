<?php

/* 
 * Author       : Jai K
 * Purpose      : Load the user's Settings
 * Created On   : 2021-08-09 21:30
 */
?>
<div id="settings">
  <form action="" method="post">
    <div class="row">
        <div class="col-md-10 offset-md-1 form simple">
            <div class="form-title">
                <h1>Options</h1>
            </div>

            <div class="form-content">
                <div class="row">
                    <div class="skew-box chk-tgl-btn">
                        <span>&nbsp;</span>
                        <input type="checkbox" checked name="is_show_dob" id="is-show-dob" />
                        <label for="is-show-dob" data-tg-off="OFF" data-tg-on="ON"></label>
                        I'm ok to show my date of birth (ie. DOB) to others.
                    </div>

                    <div class="skew-box chk-tgl-btn">
                        <span>&nbsp;</span>
                        <input type="checkbox" name="is_alert_expire" id="is-alert-expire" />
                        <label for="is-alert-expire" data-tg-off="OFF" data-tg-on="ON"></label>
                        Alert me about my Ad goes to expire, through email. (Before of 7 days and 1 day before)
                    </div>

                    <div class="skew-box chk-tgl-btn">
                        <span>&nbsp;</span>
                        <input type="checkbox" name="is_show_adults" id="is-show-adults" />
                        <label for="is-show-adults" data-tg-off="OFF" data-tg-on="ON"></label>
                        Show my adult posts to others in my author's page, under "Posts by me" section.
                    </div>
                </div> <!-- row -->

                <span>Show my contacts details to,</span>
                <div class="row">
                    <div class="col-md-2"><small>(Personal)</small></div>
                    <div class="col-md-10" style="display: grid;">
                        <div class="radio-box">
                            <div><input type="radio" name="show_contacts_to" id="show-every-one" /></div>
                            <label for="show-every-one">Every One</label>
                        </div>

                        <div class="radio-box">
                            <div><input type="radio" checked name="show_contacts_to" id="show-to-friends" /></div>
                            <label for="show-to-friends">Only to my friends & who are already conducted by me.</label>
                        </div>

                        <div class="radio-box">
                            <div><input type="radio" name="show_contacts_to" id="show-nobody" /></div>
                            <label for="show-nobody">Nobody</label>
                        </div>
                    </div>
                </div> <!-- row -->


                <div class="row">
                    <div class="col-md-2"><small>(Ad Contact Details)</small></div>
                    <div class="col-md-10" style="display: grid;">
                        <div class="radio-box">
                            <div><input type="radio" name="show_ad_contacts_to" id="show-ad-every-one" checked /></div>
                            <label for="show-ad-every-one">Every One</label>
                        </div>

                        <div class="radio-box">
                            <div><input type="radio" name="show_ad_contacts_to" id="show-ad-to-friends" /></div>
                            <label for="show-ad-to-friends">My friends & who are already conducted by me.</label>
                        </div>

                        <div class="radio-box">
                            <div><input type="radio" name="show_ad_contacts_to" id="show-ad-nobody" /></div>
                            <label for="show-ad-nobody">Nobody</label>
                        </div>
                    </div>
                </div> <!-- row -->


            </div> <!-- form-content -->

            <div class="form-title">
                <h1>Block Users</h1>
            </div>

            <div class="form-content">
                <div class="form-row">
                      <small>Start typing to find the users...</small>
                      <input type="text" name="block_user" id="block-user" class="inp" placeholder="Username or ID" value=""/>
                      <button class="btn danger hide" id="block-user-btn"><i class="fa fa-ban"></i> Block</button>
                </div>

                <div class="form-row col-md-6">
                    <button class="btn tgl-btn active" data-target="#blocked-users" data-callback="autoRemoveFn">Show blocked users</button>
                </div>

                <div class="hide" id="blocked-users">
                    <div class="row infinite-content">
                        <div class="col-md-4">
                            <input type="text" name="block_search" id="block-search" class="inp box" placeholder="Search by Name" />
                        </div>
                        <div class="col-md-8">Showing <span>5</span> of 46</div>
                    </div>
                    <div class="row list fix-box-height">
                          <div class="row row-item">
                              <div class="col-md-2 author-img">
                                  <img  src="./uploads/profile.jpg" />
                              </div>
                              <div class="col-md-10 chk-group">
                                  <div class="chk-box fR">
                                      <input type="checkbox" name="unblock_all_2453" id="unblock-all-2453" >
                                      <label for="unblock-all-2453" class="chk-all">
                                          <span></span> Unblock All
                                      </label>
                                  </div>

                                  <h4><a href="./author.shtml">Jai K</a></h4>
                                  <div class="more-info">
                                        <small class="pip advanced-options-btn"><a href="#">Advanced Options</a></small>
                                        <small class="timestamp">Blocked On: 03 Jul, 2015 12:34 PM</small>
                                  </div>

                                  <div class="hide advanced-options chk-box-set">
                                        <div class="chk-box">
                                            <input type="checkbox"  name="unblock_send_2453" id="unblock-send-2453" >
                                            <label for="unblock-send-2453">
                                                <span></span> Show their posts to me.
                                            </label>
                                        </div>

                                        <div class="chk-box">
                                            <input type="checkbox"  name="unblock_receive_2453" id="unblock-receive-2453" >
                                            <label for="unblock-receive-2453">
                                                <span></span> Allow them to see all my posts.<small> (Includes to comment your post)</small>
                                            </label>
                                        </div>

                                        <div class="chk-box">
                                            <input type="checkbox"  name="unblock_others_2453" id="unblock-others-2453" >
                                            <label for="unblock-others-2453">
                                                <span></span> Allow other things.<small> (e.g message, notification etc)</small>
                                            </label>
                                        </div>
                                  </div>
                              </div>
                          </div> <!-- .row-item -->

                          <div class="row row-item">
                              <div class="col-md-2 author-img">
                                  <img  src="./uploads/icon.png" />
                              </div>
                              <div class="col-md-10 chk-group">
                                  <div class="chk-box fR">
                                      <input type="checkbox"  name="unblock_all_43" id="unblock-all-43" >
                                      <label for="unblock-all-43" class="chk-all">
                                          <span></span> Unblock All
                                      </label>
                                  </div>
                                  <h4><a href="./author.shtml">John Abraham</a></h4>
                                  <div class="more-info">
                                        <small class="pip advanced-options-btn"><a href="#">Advanced Options</a></small>
                                        <small class="timestamp">Blocked On: 19 Aug, 2015 01:34 AM</small>
                                  </div>

                                  <div class="hide advanced-options chk-box-set">
                                        <div class="chk-box">
                                            <input type="checkbox"  name="unblock_send_43" id="unblock-send-43" >
                                            <label for="unblock-send-43">
                                                <span></span> Show their posts to me.
                                            </label>
                                        </div>

                                        <div class="chk-box">
                                            <input type="checkbox"  name="unblock_receive_43" id="unblock-receive-43" >
                                            <label for="unblock-receive-43">
                                                <span></span> Allow them to see all my posts.<small> (Includes to comment your post)</small>
                                            </label>
                                        </div>

                                        <div class="chk-box">
                                            <input type="checkbox"  name="unblock_others_43" id="unblock-others-43" >
                                            <label for="unblock-others-43">
                                                <span></span> Allow other things.<small> (e.g message, notification etc)</small>
                                            </label>
                                        </div>
                                  </div>
                              </div>
                          </div> <!-- .row-item -->
                    </div>
                </div> <!-- blocked users -->
            </div> <!-- form-content -->

            <div class="row hr"></div>
            <div class="row form-content">
                <div class="form-row">
                    <div class="col-md-4"><button class="btn danger">Delete My Account</button> </div>
                    <div class="row push-right">
                        <span class="small-text">Caution: This action can not be undo anymore.</span>
                    </div>
                </div>
            </div>
        </div> <!-- .form simple -->
        <div class="col-md-4">
            <div>

            </div>
        </div>
    </div> <!-- row -->


  </form>
</div> <!-- #settings -->

