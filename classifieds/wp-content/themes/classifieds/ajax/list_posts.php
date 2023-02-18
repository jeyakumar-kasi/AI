<?php

/* 
 * Author       : Jai K
 * Purpose      : List all posts.
 * Created On   : 2022-02-20 12:03
 */

//echo '<pre>Posts: '; print_r($posts); die;
foreach($posts as $k => $post):
?>
    <div class="row row-item">
        <div class="col-md-2">
            <img src="<?php echo has_post_thumbnail($post) ? get_the_post_thumbnail_url($post, "post-thumbnail") : TMPL_URI . '/static/images/placeholder.png'; ?>" />
            <div class="img-caption">3 Photos</div>
        </div>
        <div class="col-md-10">
            <a href="<?php echo get_permalink($post->ID); ?>">
              <h4 class="item-title _clr"><?php echo $post->post_title; ?></h4>
            </a>
            <p><?php echo get_post_summary($post); ?></p>

            <div class="info-box col-xs-12">
                <div class="col-xs-7 fL">
                    <span class="cat-breadcrumb">
                        <?php echo generate_breadcrumb_html($post, $cat_only=true, $include_icons=true); ?>
                    </span>
                    <!--<span class="hidden-link"><a href="#">View Contact Info</a></span>
                    <span class="hidden email">john_kabil@gmail.com</span>
                    <span class="hidden contact-no">+91 95660 41710</span>-->
                </div>    
                <div class="col-xs-5 text-right fR">
                    <span class="timestamp"><?php echo get_readable_date($post->post_modified); ?></span>
                    Photos: <span class="photo-count">3</span>
                    Views: <span class="views-count">120</span>
                </div>
            </div>    

        </div>
    </div>
<?php endforeach; 

