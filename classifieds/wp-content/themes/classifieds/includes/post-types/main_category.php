<?php

/* 
 * Author       : Jai K
 * Purpose      : Custom Post types for 'Categories'
 * Created On   : 2020-05-03 13:37
 */

function _main_category_post_type() 
{
    $labels = [
        'name'          => _x('Main Categories', 'post type general name'),
        'singular_name' => _x('Main Category', 'post type singular name'),
        'add_new'       => _x('Add New', 'Main Category'),
        'add_new_button'=> __('Add New Main Category'),
        'edit_item'     => __('Edit Main Category'),
        'new_item'      => __('New Main Category'),
        'all_items'     => __('All Main Categories'),
        'view_item'     => __('View Main Category'),
        'search_items'  => __('Search Main Categories'),
        'not_found'     => __('No Main Categories found.'),
        'not_found_in_trash'=> __('No Main Categories found in the Trash!'),
        'parent_item_colon'=> '\'',
        'menu_name'     => 'Main Categories'
    ];
    
    $args = [
        'labels'        => $labels,
        'description'   => 'List all Main Categories',
        'public'        => true,
        'menu_position' => 5,
        'supports'      => [
            'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 
            'page-attributes', 'custom-fields', 'revisions'
        ],
        'has_archive'   => false,
        
        'show_ui'       => true,
        'show_in_menu'  => true,
        'query_var'     => true,
        'hierarchical'  => true,
        'rewrite'       => ['slug', '/', 'with_front' => false],
        'publicly_queryable'=> true,
        //'capability_type'=> 'post',
        'taxonomies'    => ['sub_category', 'post_tag'],
        //'exclude_from_search'=> false
    ];
    register_post_type('main_category', $args);
    flush_rewrite_rules();
}
add_action('init', '_main_category_post_type');


function _remove_category_slug($post_link, $post, $leavename)
{
    if ($post->post_status != 'publish' || $post->post_type != 'main_category') {
        return $post_link;
    }
    return str_replace('/' . $post->post_type . '/', '/', $post_link);
}
add_filter('post_type_link', '_remove_category_slug', 10, 3);

