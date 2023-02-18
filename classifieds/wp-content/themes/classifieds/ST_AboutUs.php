<?php

    /* 
     * Template Name: About Us
     * Author       : Jai K
     * Purpose      : About Us Page
     * Created On   : 2020-02-10 22:33
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
            </div>

            <div class="page-content">
                <div class="row page-row">
                      <?php echo $post->post_content; ?>

                      <p>Here are some stats,</p>
                  </div>

                  <div id="about-us-stats">
                      <div class="row">
                            <div class="col-md-6">
                                <div class="block">
                                    <i class="fa fa-id-card _clr"></i>
                                    <div class="content">
                                        <span>Total Posts</span>
                                        <h4 class="_clr">12,453+</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="block">
                                    <i class="fa fa-search _clr"></i>
                                    <div  class="content">
                                        <span>Total Searches</span>
                                        <h4 class="_clr">23,012+</h4>
                                    </div>
                                </div>
                            </div>

                      </div> <!-- row -->

                      <div class="row">
                            <div class="col-md-6">
                                <div class="block">
                                    <i class="fa fa-users _clr"></i>
                                    <div class="content">
                                        <span>Total Users</span>
                                        <h4 class="_clr">3,234+</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="block">
                                    <i class="fa fa-building _clr"></i>
                                    <div  class="content">
                                        <span>Total Cities</span>
                                        <h4 class="_clr">210+</h4>
                                    </div>
                                </div>
                            </div>
                      </div>
                  </div> <!-- stats -->

                  <div class="row page-row">
                      <p>If still not satisfied with our platform or feeling some thing is missing, then feel free to <a href="./contact_us.shtml" class="link">contact us</a>
                        at any time and make this site more beautiful and useful for others too.</p>
                  </div>


            </div> <!-- page-content -->
        </div>
    </div> <!-- row -->
</section> <!-- #content -->
<?php
    # Load the Footer
    get_footer();