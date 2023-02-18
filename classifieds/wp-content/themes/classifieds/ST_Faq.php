<?php

    /* 
     * Template Name: FAQ
     * Author       : Jai K
     * Purpose      : Help & Frequently Asked Questions
     * Created On   : 2020-02-10 22:13
     */
    
    # Load Header Page
    get_header();
?>
<section id="content" class="container">

    <div class="row content-header">
        <div id="breadcrumb" class="col-md-8">
            <span title="Go to Home"><a href="<?php echo home_url(); ?>"><i class="fa fa-home"></i> Home</a></span>
            <span>FAQ / Help</span>
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
                <div class="row page-row">
                    <ul class="accordion">
                        <li>
                            <h2 class="accordion-title">
                                <i class="fa fa-plus-circle"></i> How I can post on this website?
                            </h2>
                            <div class="accordion-content">
                                  You can either use the single page file to post.
                            </div>
                        </li>
                        <li>
                            <h2 class="accordion-title">
                                <i class="fa fa-plus-circle"></i> Where can I find to change my password?
                            </h2>
                            <div class="accordion-content">
                                  Under "My Account &gt; Biodata &gt; Change Password", you can find the option to change your new password.
                                  Here are the questions are frequently asked and if once your required details not found,
                                    then feel free to contact us. tly asked and if once your required details not found,
                                      then feel free to contact us.tly asked and if once your required details not found,
                                        then feel free to contact us.

                                        Here are the questions are frequently asked and if once your required details not found,
                                          then feel free to contact us. tly asked and if once your required details not found,
                                            then feel free to contact us.tly asked and if once your required details not found,
                                              then feel free to contact us.

                                              Here are the questions are frequently asked and if once your required details not found,
                                                then feel free to contact us. tly asked and if once your required details not found,
                                                  then feel free to contact us.tly asked and if once your required details not found,
                                                    then feel free to contact us.
                            </div>
                        </li>
                        <li>
                            <h2 class="accordion-title">
                                <i class="fa fa-plus-circle"></i> How do I make a payment.
                            </h2>
                            <div class="accordion-content">
                                  Payments is an easy way to do and we're providing lot of options like 'Net Banking, Paytm and etc'.
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="row page-article">
                    <div class="">
                        <p>Can't find some thing that what you are looking for then let's feel free to <a href="./contact_us.shtml" class="link">contact us.</a> We're glad to hear from you.</p>
                    </div>
                </div>
            </div> <!-- page-content -->
        </div>
    </div> <!-- row -->
</section> <!-- #content -->
<?php
    # Load Footer Page
    get_footer();