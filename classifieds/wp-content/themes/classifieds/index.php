<?php

    /* 
     * Template Name: Home
     * Author       : Jai K
     * Purpose      : Main index file
     * Created On   : 2020-02-10 19:26
     */
    
    # Load Header Page
    get_header();
?>
<section id="content" class="container">
    <!--
    <div id="slogan-text" class="text-center">
        <h1 id="slogan-desc"><?php //echo $post->post_content; ?></h1>
    </div>
    -->

    <!-- Search Bar -->
    <?php get_sidebar('searchbar'); ?>

    <div class="row">
        <div id="browse-by-more" class="text-center page-block">

            <!--<div class="col-md-6 offset-md-3">
                  <a href="javascript: scrollTo('#search-bar', 500);">Browse by Category</a>
                  <a href="#browse-by-location">Browse by Location</a>
                  <a href="#" data-target="#most-search-bar" class="tgl-btn">Most searched keywords</a>
            </div>-->

            <div class="col-md-10 offset-md-2 keywords-box" id="most-search-bar">
                <div class="row">
                    <div class="active col-md-2"><a>Keywords: </a></div>
                    <div class="col-md-10">
                        <div><a href="category.shtml?q=bike+sale">bike sale</a></div>
                        <div><a href="category.shtml?q=room+rent+in+bangalore">room rent in bangalore</a></div>
                        <div><a href="category.shtml?q=bike+sale">bwelcomeke sale</a></div>
                        <div><a href="category.shtml?q=bike+sale">bike salreer fdfdfd welcome</a></div>
                        <div><a href="category.shtml?q=bike+sale">bike for sale</a></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <!--<div id="ad-count-showcase" class="text-center page-block">
             <h2>2,190</h2> Ads are active now
        </div>-->
    </div>

    <div  id="categories-grid">
        <div class="col-md-1">
              <span>Service</span>
        </div>
        <div class="col-md-1">
              <span>Personals</span>
        </div>
    </div>

    <div class="row tabs vertical" data-arrow-type="tabs-left" data-alt-arrow-type="tabs-up" id="post-tabs">
        <div class="col-md-9">
            <div id="recommendation" class="tab <?php echo IS_LOGGED_IN ? 'act' : ''; ?> list">
                <?php 
                if (IS_LOGGED_IN): 
                    $posts = get_user_posts($type='recommendation');
                    require_once 'ajax/list_posts.php';
                endif;
                ?>
            </div> <!-- Recommendation -->
            
            <div id="recent" class="tab <?php echo !IS_LOGGED_IN ? 'act' : ''; ?> list">
                <?php 
                if (!IS_LOGGED_IN): 
                    $posts = get_user_posts($type='recent');
                    //echo '<pre>Posts: '; print_r($posts); die;
                    require_once 'ajax/list_posts.php';
                endif;
                ?>
            </div> <!-- Recent Tab -->
            
            <div id="top-posts" class="tab list">&nbsp;</div> <!-- Top Posts -->
        </div>    

        <div class="col-md-3">
            <!-- Tabs -->
            <div class="tab-header">
                <?php if (IS_LOGGED_IN): ?>
                    <div class="active" data-target="#recommendation"><i class="fa fa-award"></i> <span>Recommended</span></div>
                <?php endif; ?>
                <div class="<?php echo !IS_LOGGED_IN ? 'active' : ''; ?>" data-target="#recent"><i class="fa fa-clock"></i> <span>Very Recent</span></div>
                <div class="" data-target="#top-posts"><i class="fa fa-burn"></i> <span>Top Posts</span></div>
            </div>
        </div>
    </div>
</section> <!-- #content -->

<div class="sub-footer">
    <div id="browse-by-location" class="container pad">
        <h4 class="sub-title">Browse By Location</h4>
        <div class="container">
            <div class="row">
                <?php 
                    # Get top most cities
                    $cities = get_cities(NULL, $is_main_cities=True);
                    require_once 'ajax/browse_by_loc.php'; 
                ?>
            </div>
            <div class="row">
                <div class="col-md-2 offset-md-5">
                    <select id="browse-states-list" class="text-center">
                        <option value="">- Select Location -</option>
                        <?php foreach (get_states() as $k=>$state): ?>
                            <option class="text-left" value="<?php echo $state['state_name']; ?>"><?php echo $state['state_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div> <!-- pad -->
</div>
<?php
    # Load Footer Page
    get_footer();
?>
<script type="text/javascript" src="<?php echo TMPL_URI; ?>/static/js/pages/index.js"></script>