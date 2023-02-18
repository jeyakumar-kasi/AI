<?php

    /* 
     * Template Name: Publish
     * Author       : Jai K
     * Purpose      : Publish a new post
     * Created On   : 2020-02-10 20:52
     */
    
    # Load Header Page
    get_header();
    
    $categories = get_all_categories();
//    echo '<pre>'; print_r($categories); die;
    
?>
<section id="content" class="container">
    <div class="row content-header">
       <div id="breadcrumb" class="col-md-8">
           <span title="Go Back"><a href="javascript: window.history.go(-1);"><i class="fa fa-arrow-left"></i> Go Back</a></span>
       </div>
       <div class="col-md-4">
       </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <form action="" method="post">
            <div class="form big">
                <div class="form-title">
                    <h1><?php echo $post->post_title; ?></h1>
                </div>

                <div class="row form-content">
                    <div class="form-row">
                          <label>Post Title</label>
                          <input type="text" name="post_title" id="post-title" class="inp" autofocus/>
                    </div>

                    <div class="form-row">
                          <label>Main Category</label>
                          <select name="category" id="category" class="inp">
                                <option value="" readonly>-- select the main category --</option>
                                <?php //foreach($categories => ): ?>
                                <option value="2">Services</option>
                                <option value="1">Personal</option>
                                <option value="19">Dating</option>
                          </select>
                    </div>

                    <div class="form-row">
                          <label>Sub Category</label>
                          <select name="sub_category" id="sub-category" class="inp">
                                <option value="" readonly>-- Options --</option>
                                <option value="2">Missing friend</option>
                                <option value="1">Big Cats</option>
                                <option value="19">Looking for a serious relationship</option>
                          </select>
                    </div>

                    <div class="form-row">
                          <label>Description</label>
                          <textarea name="post_desc" id="post-desc" class="inp" data-count="1800" placeholder="Enter something about your Ad ..."></textarea>
                    </div>

                    <div class="form-row files">
                          <label>Attach Files / Photos</label>
                    </div>

                    <div class="form-row">
                          <label>Location of the Ad.<span class="small-text"> (Optional | Recommended)</span></label>
                          <input type="text" name="post_title" id="ad-location" class="inp autocomplete" data-target=".detect-loc-btn" placeholder="City Name (e.g. Bengaluru)"/>
                          <button class="form-right-btn active detect-loc-btn" data-target="#ad-location"><i class="fa fa-crosshairs"></i> <span>Detect My Location</span></button>
                          <div class="small-text" style="margin-top: 5px;"><i class="fa fa-info-circle _clr"></i> Helps your Ad to reach to the most closest customers from your city.</div>
                    </div>

                    <div class="form-row inner-form">
                        <div class="form-title">
                            <h1>Contact Details</h1>
                        </div>

                        <div class="form-row">
                              <label>Email Address</label>
                              <input type="email" name="post_email" id="post-email" class="inp" placeholder="" value="dev.jeyakumar@gmail.com"/>
                        </div>

                        <div class="form-row">
                              <label>Mobile Number<span class="small-text"> (Optional)</span></label>
                              <input type="text" name="post_contact_no" id="post-contact-no" class="inp" placeholder="(Recommended)" value="+91 9566041710"/>
                        </div>
                    </div>

                    <div class="form-row" style="display: grid;">
                        <div class="chk-slide chk-tgl-btn">
                            <span>Disable comments for this post.</span>
                            <input type="checkbox" name="is_commetable" id="is-commetable" />
                            <label for="is-commetable"></label>
                        </div>
                        <div class="chk-slide chk-tgl-btn">
                            <span>I Agree to the <a href="./terms-conditions" class="link" target="_blank">Terms and Conditions.</a></span>
                            <input type="checkbox" checked name="i_agree" id="i-agree" />
                            <label for="i-agree"></label>
                        </div>
                    </div>

                    <div class="form-row ctrls">
                        <input type="submit" value="Publish" class="col-md-2 btn active" />
                        <input type="reset" value="Reset" class="col-md-2 btn" />
                    </div>
                </div>
            </div>
          </form>
        </div> <!-- .col-md-8 -->
    </div>
</section> <!-- #content -->
<?php
    # Load Footer Page
    get_footer();
?>
<script type="text/javascript" src="<?php echo TMPL_URI; ?>/static/js/pages/publish.js"></script>

