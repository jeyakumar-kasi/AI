<?php

/* 
 * Name         : Post Details Page
 * Author       : Jai K
 * Purpose      : Show the post with detailed information.
 * Created On   : 2022-10-02 23:23
 */

get_header();

?>
<section id="content" class="container">
    <div class="row content-header">
        <div id="breadcrumb" class="col-md-8">
            <span title="Go to Home"><a href="./"><i class="fa fa-home"></i> Home</a></span>
            <span title="Go to Services"><a href="/services">Services</a></span>
            <span title="Go to Missing friend"><a href="/services/missing-friend">Missing friend</a></span>
            <span>Hello I'm Here to help u ...</span>
        </div>
        <div class="col-md-4">

        </div>
    </div>

    <div class="row">
        <div id="single-content" class="col-md-8">
            <div class="page-title">
                <h1 class=""><?php echo $post->post_title; ?></h1>
                <div class="row sub-text">
                    <div class="col-md-4 text-left">
                        <span><i class="fa fa-tag"></i> Ad ID: S321GH21</span>
                    </div>
                    <div class="col-md-8 text-right" style="padding-right: 0px;">
                        <span><a href="./author.shtml" class="link"><i class="fa fa-user"></i> Ashok Kumar</a> | </span>
                        <span><i class="fa fa-calendar"></i> 29 Aug, 2019</span>
                    </div>
                </div>

            </div>

            <div class="page-content">
                  <div class="wrapper">
                      <div class="col-lg-8 col-xs-12 slider-wrapper" >
                          <div class="slider">
                              <img src="./uploads/icon.png" alt="Image 01" />
                              <img src="./uploads/placeholder.jpg" alt="Image 01" />
                              <img src="./uploads/icon.png" alt="Image 03" />
                              <img src="./uploads/placeholder.jpg" alt="Image 01" />
                              <div class="controls">
                                  <i class="fa fa-fast-backward"></i>
                                  <i class="fa fa-chevron-left"></i>
                                  <i class="fa fa-pause"></i>
                                  <i class="fa fa-chevron-right"></i>
                                  <i class="fa fa-fast-forward"></i>
                                  <span class="count">&nbsp;</span>
                              </div>
                          </div>
                    </div>

                    <div class="row info-table">
                          <table>
                              <tr><th class="lbl">Location</th><td>: Chennai, India</td></tr>
                              <tr><th class="lbl">Age</th><td>: 27</td></tr>
                              <tr><th class="lbl">Gender</th><td>: Male</td></tr>
                              <tr><th class="lbl">Tags</th><td>: <a href="./category.shtml" target="_blank">Services</a>, <a href="./category.shtml" target="_blank">Massage</a></td></tr>
                          </table>
                          <div>
                              <p>This is my new ad. and here for some of the information that I want to here for some of the information that I want to
                                here for some of the information that I want to
                                here for some of the information that I where for some of the information that I want to express it.</p>
                          </div>
                      </div> <!-- info-table -->

                      <div id="contacts-info" class="row">
                          <button class="show-contacts-btn _bg tgl-btn" data-target="#contacts-details-box" data-callback="autoRemoveFn"><i class="fa fa-phone-square"></i> Show Contact Details</button>
                          <table id="contacts-details-box" class="show-contacts-details hide">
                              <tr><th class="lbl">Contact No</th><td>: +91 95660 41710</td></tr>
                              <tr><th class="lbl">Email ID</th><td>: j81k@outlook.com</td></tr>
                          </table>
                      </div> <!-- contact info -->

                      <div id="bottom-box">
                          <div id="social-info" class="row">
                                <div class="col-md-4">
                                    <span>Share with: </span>
                                    <span><a href=""><i class="fab fa-twitter-square"></i> Twitter</a></span>
                                    <span><a href=""><i class="fab fa-facebook-square"></i> Facebook</a></span>
                                </div>
                                <div class="col-md-8 text-right">
                                    <span class="pip">Views: 120</span>
                                    <span class="pip">Likes: 20</span>
                                    <span class="">Rating: 4.5/5</span>
                                    <span class="pip"><i class="fa fa-ban"></i> Report as Spam</span>
                                </div>
                          </div>
                      </div> <!-- bottom-box -->

                      <div class="rating-box" class="row">
                          <div class="rating-msg">&nbsp;
                              <!--<i class="fa fa-thumbs-up ico like" title="Like it"></i>
                              <i class="fa fa-thumbs-down ico unlike" title="Don't Like it"></i>-->
                          </div>
                          <div class="rating-stars">
                              <span><i class="fa fa-star"></i></span>
                              <span><i class="fa fa-star"></i></span>
                              <span><i class="fa fa-star"></i></span>
                              <span><i class="fa fa-star"></i></span>
                              <span><i class="fa fa-star"></i></span>
                          </div>
                          <div class="rating-advice">Help others to find this post useful or not.</div>
                      </div>
                  </div> <!-- wrapper -->


                  <div id="forms">
                      <div class="tabs">
                          <div class="tab-header">
                              <div data-target="#tab-1">Contact</div>
                              <div data-target="#tab-2" class="active">Comments</div>
                          </div>

                          <!-- tab 1 -->
                          <div class="tab" id="tab-1">
                              <form name="contact-form" method="post" enctype="multipart/form-data" class="form">
                                  <div class="row form-content">
                                      <div class="form-row">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" class="inp"/>
                                      </div>

                                      <div class="form-row">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email" class="inp"/>
                                      </div>

                                      <div class="form-row">
                                            <label for="contact-no">Contact No<span class="small-text"> (Optional)</span></label>
                                            <input type="text" name="contact_no" id="contact-no" class="inp"/>
                                      </div>

                                      <div class="form-row files">
                                            <label>Attach Files / Photos<span class="small-text"> (Optional)</span></label>
                                      </div>

                                      <div class="form-row">
                                            <label for="msg">Message</label>
                                            <textarea name="msg" id="msg" class="inp" data-count="600" placeholder="Your message ..."></textarea>
                                      </div>

                                      <div class="form-row ctrls">
                                          <input type="submit" value="Submit" class="col-md-2 btn active" />
                                          <input type="reset"  value="Clear" class="col-md-2 btn" />
                                      </div>
                                  </div> <!-- form-content -->
                              </form>
                          </div> <!-- tab -->

                          <!-- Comments -->
                          <div class="tab" id="tab-2">
                              <div id="comments" class="row list">
                                  <nav>
                                      <ul>
                                          <li>
                                              <div class="row row-item" id="comment-23117">
                                                  <div class="col-md-2">
                                                      <img src="./uploads/placeholder.jpg" alt="John" />
                                                  </div>
                                                  <div class="col-md-10 content">
                                                      <p>This is all about something and can not understand!!! This is all about somethin This is all about somethinThis is all about somethinThis is all about somethinThis is all about somethinThis is all about somethinThis is all about somethin This is all about somethinThis is all about somethin This is all about sometsomething and can not understand!!! This is all about somethin This is all about somethinThis is all about somethinThis is all about somethinThis is all about somethinThis is all about somethinThis is all about somethin This is all about somethinThis is all about somethin This is all about something.</p>
                                                      <div class="more-info">
                                                          <small class="left-info reply-opener">Show Replies <i class="fa fa-chevron-down"></i></small>
                                                          <small class="pip comment-reply-btn"><a href="#comment-form">Reply</a></small>
                                                          <small class="pip replied-username"><a href=""><i class="fa fa-user"></i> <span>John Abraham</span></a></small>
                                                          <small>20 Jun, 2015</small>
                                                      </div>
                                                  </div>

                                                  <ul class="hide">
                                                      <li>
                                                          <div class="row row-item" id="comment-83211">
                                                              <div class="col-md-2">
                                                                  <img src="./uploads/chess.png" alt="John" />
                                                              </div>
                                                              <div class="col-md-10 content">
                                                                  <p>This is all about something and can not understand!!!</p>
                                                                  <div class="more-info">
                                                                      <small class="pip comment-reply-btn"><a href="#comment-form">Reply</a></small>
                                                                      <small class="pip replied-username"><a href=""><i class="fa fa-user"></i> <span>Maken Paul</span></a></small>
                                                                      <small>21 Jun, 2015</small>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </li>
                                                      <li>
                                                          <div class="row row-item">
                                                              <div class="col-md-2">
                                                                  <img src="./uploads/placeholder.jpg" alt="John" />
                                                              </div>
                                                              <div class="col-md-10 content">
                                                                  <p>This is all about something and can not understand!!!</p>
                                                                  <div class="more-info">
                                                                      <small class="left-info reply-opener">Show Replies <i class="fa fa-chevron-down"></i></small>
                                                                      <small class="pip"><a href="#comment-form">Reply</a></small>
                                                                      <small class="pip"><a href=""><i class="fa fa-user"></i> John Abraham</a></small>
                                                                      <small>21 Jun, 2015</small>
                                                                  </div>
                                                              </div>
                                                              <ul class="hide">
                                                                  <li>
                                                                      <div class="row row-item">
                                                                          <div class="col-md-2">
                                                                              <img src="./uploads/chess.png" alt="John" />
                                                                          </div>
                                                                          <div class="col-md-10 content">
                                                                              <p>This is all about something and can not understand!!!</p>
                                                                              <div class="more-info">
                                                                                  <small class="pip"><a href="#comment-form">Reply</a></small>
                                                                                  <small class="pip"><a href=""><i class="fa fa-user"></i> Maken Paul</a></small>
                                                                                  <small>21 Jun, 2015</small>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </li>
                                                                  <li>
                                                                      <div class="row row-item">
                                                                          <div class="col-md-2">
                                                                              <img src="./uploads/placeholder.jpg" alt="John" />
                                                                          </div>
                                                                          <div class="col-md-10 content">
                                                                              <p>This is all about something and can not understand!!!</p>
                                                                              <div class="more-info">
                                                                                  <small class="pip"><a href="#comment-form">Reply</a></small>
                                                                                  <small class="pip"><a href=""><i class="fa fa-user"></i> John Abraham</a></small>
                                                                                  <small>21 Jun, 2015</small>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </li>
                                                              </ul>
                                                          </div>
                                                      </li>
                                                  </ul>
                                              </div> <!-- row-item -->
                                          </li>

                                          <li>
                                            <div class="row row-item">
                                                <div class="col-md-2">
                                                    <img src="./uploads/icon.png" alt="John" />
                                                </div>
                                                <div class="col-md-10 content">
                                                    <p>About something and can not understand!!! This is all about somethin This is all about somethinThis is all about somethinThis is all about somethin!!!</p>
                                                    <div class="more-info">
                                                        <small class="reply-opener">Show Replies <i class="fa fa-chevron-down"></i></small>
                                                        <small class="pip"><a href="#comment-form">Reply</a></small>
                                                        <small class="pip"><a href=""><i class="fa fa-user"></i> John Abraham</a></small>
                                                        <small>27 Jun, 2015</small>
                                                    </div>
                                                </div>
                                            </div> <!-- row-item -->
                                          </li>

                                      </ul>
                                  </nav>

                                  <div class="form hide" id="comment-form">
                                      <form class="form simple" name="comment_form">
                                          <div class="row form-content">
                                              <div class="form-row ">
                                                  <textarea name="comment" id="comment" class="inp" data-count="600" placeholder="">@John </textarea>
                                              </div>

                                              <div class="form-row ctrls">
                                                  <input type="submit" value="Comment" class="col-md-5 btn active" />
                                                  <button class="col-md-5 btn reply-cancel-btn">Discard</button>
                                              </div>
                                            </div>
                                      </form>
                                  </div>
                              </div> <!-- comments -->


                            </div> <!-- tab 2 -->

                    </div>  <!-- tabs -->
                </div> <!-- form -->

            </div> <!-- page content -->
        </div> <!-- single-content -->

        <!-- Side bar -->
    </div>
</section>
<?php get_footer(); ?>
<script type="text/javascript" src="<?php echo TMPL_URI; ?>/static/js/slider.js"></script>
