<?php

/* 
 * Author       : Jai K
 * Purpose      : Custom Taxonomies for 'Sub Categories'
 * Created On   : 2020-05-03 15:00
 */

function _sub_category_taxonomy()
{
    
    $labels = [
        'name'          => _x('Sub Categories', 'taxonomy general name'),
        'singular_name' => _x('Sub Category', 'taxonomy singular name'),
        'new_item_name' => __('New Sub Category'),
        'add_new_item'  => __('Add New Sub Category'),
        'edit_item'     => __('Edit Sub Category'),
        'all_items'     => __('All Sub Categories'),
        'search_items'  => __('Search Sub Categories'),
        'parent_item'   => __('Parent Sub Category'),
        'parent_item_colon'=> __('Parent Sub Category:'),
        'menu_name'     => 'Sub Categories',
    ];
    
    $args = [
        'labels'        => $labels,
        'hierarchical'  => true,
        'show_ui'       => true,
        'show_admin_column'=> true,
        'show_in_nav_menus'=> true,
        'show_tagcloud' => true
    ];
    
    register_taxonomy('sub_category', ['main_category'], $args);
}

add_action('init', '_sub_category_taxonomy', 0);