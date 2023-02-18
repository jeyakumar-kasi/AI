<?php

    /* 
     * Template Name: Contact Us
     * Author       : Jai K
     * Purpose      : Contact Us Page
     * Created On   : 2020-02-10 22:25
     */
    
    # Load the Header 
    get_header();
?>
<section id="content" class="container">

    <div class="row content-header">
        <div id="breadcrumb" class="col-md-8">
            <span title="Go to Home"><a href="./"><i class="fa fa-home"></i> Home</a></span>
            <span><?php echo $post->post_title; ?></span>
        </div>
        <div class="col-md-4">

        </div>
    </div>

    <div class="row">
        <div id="faq-content" class="col-md-8">
            <div class="page-title">
                <h1 class=""><?php echo $post->post_title; ?></h1>
                <div class="row sub-text">
                    <div class="col-md-12">
                        <?php echo $post->post_content; ?>
                    </div>
                </div>
            </div>

            <div class="page-content">
                <div class="row">
                  <form name="contact-form" method="post" enctype="multipart/form-data" class="form">
                      <div class="row form-content">
                          <div class="form-row">
                                <label for="name">How should we call you?</label>
                                <input type="text" name="name" id="name" class="inp" value="John" />
                          </div>

                          <div class="form-row">
                                <label for="email">Email Address<span class="small-text"> (Will be used to communicate further)</span></label>
                                <input type="text" name="email" id="email" class="inp" value="dev.j81k@gmail.com"/>
                          </div>

                          <div class="form-row">
                                <label for="contact-no">Contact No<span class="small-text"> (Optional)</span></label>
                                <input type="text" name="contact_no" id="contact-no" class="inp"/>
                          </div>

                          <div class="form-row">
                                <label for="contact-subject">Subject</label>
                                <select name="contact_subject" id="contact-subject" class="inp">
                                    <option value="">-- Select the Subject --</option>
                                    <option value="my_ads">My Ads related</option>
                                    <option value="postings">New Ad Posting/Approval issue</option>
                                    <option value="payments">Account/Login related problems</option>
                                    <option value="payments">Payments related issues</option>
                                    <option value="blocked">Blocked reason</option>
                                    <option value="site_improvement">Site improvement or extra features</option>
                                    <option value="other">Other</option>
                                </select>
                          </div>

                          <div class="form-row files">
                                <label>Any files to share with us?<span class="small-text"> (Optional)</span></label>
                          </div>

                          <div class="form-row">
                                <label for="msg">Message</label>
                                <textarea name="msg" id="msg" class="inp" data-count="600" placeholder="Please describe your queries in here." ></textarea>
                          </div>

                          <div class="form-row">
                              <div class="chk-slide chk-tgl-btn" style="padding-left: 5px;">
                                  <span>I Agree to the <a href="./terms-conditions" class="link" target="_blank">Terms and Conditions.</a></span>
                                  <input type="checkbox" checked name="i_agree" id="i-agree" />
                                  <label for="i-agree"></label>
                              </div>
                          </div>
                          <div class="form-row ctrls">
                              <a href="javascript: formValidate();" class="col-md-2 btn active"><i class="fa fa-paper-plane"></i> Send</a>
                              <input type="reset"  value="Reset" class="col-md-2 btn" />
                          </div>
                      </div> <!-- form-content -->
                  </form>
                </div>
            </div> <!-- page-content -->
        </div>
    </div> <!-- row -->
</section> <!-- #content -->
<?php
    # Load the Footer
    get_footer();