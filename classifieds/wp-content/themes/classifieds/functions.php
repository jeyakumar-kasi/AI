<?php

/* 
 * Author       : Jai K
 * Purpose      : Functions file
 * Created On   : 2020-02-10 19:43
 */

// echo '<pre>'; print_r($_SERVER); die;

$script_name_e = explode('/', $_SERVER['SCRIPT_NAME']);
define('SITE_NAME', get_bloginfo('name'));
define('IS_HOME', ($script_name_e[count($script_name_e)-1] == 'index.php') || is_home() || (is_front_page()));
define('SITE_URL', site_url());
define('TMPL_URI', get_template_directory_uri());
define('TMPL_DIR', get_template_directory());
define('IS_LOGGED_IN', is_user_logged_in());

show_admin_bar(False);
//error_reporting(E_ERROR);
date_default_timezone_set('Asia/Kolkata');
add_theme_support('post-thumbnails');
add_post_type_support('page', 'excerpt');

include_once 'constants.php';
include_once 'includes/helpers.php';
include_once 'includes/hooks.php';

# Custom Postypes
//include_once 'includes/post-types/main_category.php';
//include_once 'includes/taxonomies/sub_category.php';
//
//
//function custom_post_types() {
//    $args = array(
//        'public' => true,
//        'label'  => 'Products'
//    );
//    register_post_type( 'product', $args );
//
//    $args = array(
//        'label' => 'Product category',
//        'rewrite' => array( 'slug' => 'product_category' ),
//        'hierarchical' => true,
//    );
//    register_taxonomy( 'product_category', 'product', $args );
//}
//add_action('init', 'custom_post_types', 0);


function category_metabox_order_fn($term) {
    $term_meta = get_option('taxonomy_' . $term->term_id);
    //echo '<pre>Data: '; print_r($term_meta); die;
    ?>
        <div class="form-field">
            <label for="term-meta-custom-order">Order</label>
            <input type="text" name="term_meta[custom_order]" id="term-meta-custom-order" value="<?php echo isset($term_meta['custom_order']) ? $term_meta['custom_order'] : ''; ?>"/>
            <p class="description">Enter the Category Order</p>
        </div>

        <div class="form-field">
            <label for="term-meta-icon">Icon</label>
            <input type="text" name="term_meta[icon]" id="term-meta-icon" value="<?php echo isset($term_meta['icon']) ? $term_meta['icon'] : ''; ?>" placeholder="fa-star"/>
            <p class="description">Enter the Category Icon</p>
        </div>

        <div class="form-field">
            <label for="term-meta-color">Color</label>
            <input type="text" name="term_meta[color]" id="term-meta-color" value="<?php echo isset($term_meta['color']) ? $term_meta['color'] : ''; ?>" placeholder="#6f67ab"/>
            <p class="description">Enter the Category Color</p>
        </div>
    <?php
}
add_action('category_add_form_fields', 'category_metabox_order_fn', 10, 2);
add_action('category_edit_form_fields', 'category_metabox_order_fn', 10, 2);


function category_metabox_order_save_fn($term_id) {
    if (isset($_POST['term_meta'])):
        $term_meta = get_option('taxonomy_' . $term_id);
        $cat_keys  = array_keys($_POST['term_meta']);
        //echo '<pre>'; print_r($_POST['term_meta']); print_r($cat_keys); die;
        
        foreach ($cat_keys as $key):
            if (isset($_POST['term_meta'][$key])):
                $term_meta[$key] = $_POST['term_meta'][$key];
            endif;
        endforeach;
        
        update_option('taxonomy_' . $term_id, $term_meta);
    endif;
}
add_action('create_category', 'category_metabox_order_save_fn', 10, 2);
add_action('edited_category', 'category_metabox_order_save_fn', 10, 2);












