<?php

/* 
 * Template Name: Profile
 * Author       : Jai K
 * Purpose      : Account details
 * Created On   : 2021-08-09 20:57
 */

# Load Header Page
get_header();
?>
<section id="content" class="container">
    <div class="row content-header">
        <div id="breadcrumb" class="col-md-8 offset-md-1">
            <span title="Go Back"><a href="javascript: window.history.go(-1);"><i class="fa fa-arrow-left"></i> Go Back</a></span>
            <span><?php echo $post->post_title; ?></span>
        </div>
        <div class="col-md-4">
        </div>
    </div>
    
    <div class="row">
        <div class="tabs col-md-10 offset-md-1">
            <div class="tab-header">
                <div data-target="#tab-1" class="active"><i class="fa fa-user"></i> Profile</div>
                <div data-target="#tab-2"><i class="fa fa-newspaper"></i> My ADs</div>
                <div data-target="#tab-3"><i class="fa fa-envelope"></i> Messages</div>
                <div data-target="#tab-4"><i class="fa fa-wrench"></i> Settings</div>
            </div>

            <!-- tab 1 -->
            <div class="tab" id="tab-1">
                <?php include "ajax/biodata.php"; ?>
            </div> <!-- tab 1 -->

            <!-- tab 2 -->
            <div class="tab" id="tab-2">
                <?php include "ajax/myads.php"; ?>
            </div> <!-- tab 2 -->

            <!-- tab 4 -->
            <div class="tab" id="tab-4">
                <?php include "ajax/settings.php"; ?>
            </div> <!-- tab 4 -->

            <!-- tab 5 -->
            <div class="tab" id="tab-5">
                  <?php include "ajax/password.php"; ?>
            </div> <!-- tab 5 -->

            <!-- tab 3 -->
            <div class="tab" id="tab-3">
                <?php include "ajax/messages.php"; ?>
            </div> <!-- tab 3 -->
        </div>
    </div>
</section>
<?php
    # Load the Footer
    get_footer();






