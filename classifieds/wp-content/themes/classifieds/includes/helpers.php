<?php

/* 
 * Author       : Jai K
 * Purpose      : Helper Functions
 * Created On   : 2020-05-16 20:39
 */


function get_category_options($term_id) {
    $options = get_option('taxonomy_' . $term_id);

    if (empty($options['custom_order'])):
        $options['custom_order'] = 10000;
    endif;
    return $options;
}

function get_formatted_cat($category) {
    return [
        '_id'   => $category->term_id,
        'label' => $category->name,
        'link'  => get_category_link($category->term_id),
        'icon'  => isset($category->options['icon']) ? $category->options['icon'] : 'fa-star',
        'color' => isset($category->options['color']) ? $category->options['color'] : '#6f67ab',
        'order' => isset($category->options['custom_order']) ? $category->options['custom_order'] : 0,
        'count' => $category->count #'2300',
        
    ];
}

function get_all_categories($parent_id=NULL, $is_menu_order=TRUE, $is_valid=False)
{
    $args = [
        'hide_empty'=> 0,
        #'exclude'   => 1,
        'taxonomy'  => 'category',
        'posts_per_page' => -1,
        #'meta_key'=>'custom_order',
        #'orderby'=>'meta_value_num',
        'orderby'   => 'name',
        #'orderby'   => [
        #    'name'  => 'ASC',
        #    'parent'=> 'ASC'
        #],
        'order'     => 'ASC',
    ];
    
    if ($is_valid):
        $args['hide_empty'] = 1;
    endif;
    if ($parent_id !== TRUE & $parent_id != NULL):
        # Get Sub categories for particular parent ID
        $args['parent'] = $parent_id;
    elseif ($parent_id == NULL):
        # Get all main categories only.
        $args['parent'] = 0;
    endif;
    
    # Get all Categories
    $categories = get_categories($args);
    
    $results = [];
    foreach ($categories as $category):
        if ($category->parent == 0): 
            # Main Category
            $category->options = get_category_options($category->term_id); 
            $results[$category->term_id] = get_formatted_cat($category);
            $results[$category->term_id]['sub_cat_count'] = 0;
        endif;
    endforeach;
    
    if ($parent_id): // == TRUE
        # Add Sub Categories
        foreach ($categories as $category):
            if ($category->parent != 0):
                # Make all sub categories in order based on parent ID
                $category->options = get_category_options($category->term_id); 
                $results[$category->parent]['children'][$category->term_id] = get_formatted_cat($category);
                
                # Increment the Sub category Count
                $results[$category->parent]['sub_cat_count'] += 1;
            endif;
        endforeach;
    endif;
    
    # Order by 'Menu Order'
    if ($is_menu_order):
        usort($results, function($a, $b) {
            $a = $a['order'];
            $b = $b['order'];
            return is_numeric($a) && is_numeric($b) ? $a - $b : 0;
        });
    endif;

    # Put 'Other' at last always.
    
    return $results;
}

function get_states($is_main=False) {
    global $wpdb;
    # $query = 'SELECT id, state_code, state_name, posts_count FROM ' . TBL_STATES . ' WHERE status="1"';
    # if ($is_main):
    #    $query .= ' AND is_main_state="1"';
    # endif;
    # $query .= ' ORDER BY state_name, is_main_state DESC';
    
    $query = 'SELECT DISTINCT(district_name) AS state_name FROM ' . TBL_CITIES . ' WHERE country_code="IND" AND status="1"';
    $query .= ' ORDER BY state_name, is_main_city DESC';
    return $wpdb->get_results($query, ARRAY_A);
}

/*function get_cities($state_code=NULL, $is_main_cities=False, $is_valid=False, $max_count=0) {
    global $wpdb;
    $second_order = 'city_name ASC';
    $query = 'SELECT id, state_code, city_code, city_name, posts_count, is_main_city FROM ' . TBL_CITIES 
           . ' WHERE status="1"';
    if (empty($state_code)):
        # Get the most important cities from all states.
        $max_count = 60;
    else:
        $second_order = 'id ASC';
        $query .= ' AND state_code="'. $state_code .'"'; 
    endif;
    if ($is_main_cities):
        $query .= ' AND is_main_city="1"'; 
    endif;
    if ($is_valid):
        # Send Cities if it has atleast 1 post.
        $query .= ' AND posts_count > 1'; 
    endif;
    $query .= ' ORDER BY posts_count DESC, ' . $second_order;
    if ($max_count > 0):
        $query .= ' LIMIT 0, '. $max_count;
    endif;
    return $wpdb->get_results($query, ARRAY_A);
}*/

function get_cities($state_code=NULL, $is_main_cities=False, $is_valid=False, $max_count=0) {
    global $wpdb;
    $second_order = 'city_name ASC';
    $query = 'SELECT id, district_name AS state_code, city_name, posts_count, is_main_city FROM ' . TBL_CITIES 
           . ' WHERE status="1"';
    if (empty($state_code)):
        # Get the most important cities from all states.
        $max_count = 60;
    else:
        $second_order = 'id ASC';
        $query .= ' AND district_name="'. $state_code .'"'; 
    endif;
    if ($is_main_cities):
        $query .= ' AND is_main_city="1"'; 
    endif;
    if ($is_valid):
        # Send Cities if it has atleast 1 post.
        $query .= ' AND posts_count > 1'; 
    endif;
    $query .= ' ORDER BY posts_count DESC, ' . $second_order;
    if ($max_count > 0):
        $query .= ' LIMIT 0, '. $max_count;
    endif;
    return $wpdb->get_results($query, ARRAY_A);
}


function get_user_posts($type='recent', $limit=6) {
    
    $type = strtoupper($type);
    if ($type == 'TOPPOSTS'):
        # No. of views
        $order = 'ASC';
        $order_by = 'post_modified';
    elseif ($type == 'RECOMMENDATION'):
        # Based on history
        $order = 'ASC';
        $order_by = 'post_name';
    else:
        $order = 'DESC';
        $order_by = 'post_date';
    endif;
    $args = [
        'post_type'     => 'post',
        'post_status'   => 'publish',
        'order_by'      => $order_by,
        'order'         => $order,
        'posts_per_page'=> $limit ? $limit : POSTS_PER_PAGE
    ];
    return get_posts($args);
}

function get_post_summary($post) {
    if (!empty($post->post_excerpt))
        return $post->post_excerpt;
    
    # Get content
    $summary = strip_tags(str_replace('<br>', ' ', substr($post->post_content, 0, MAX_CHARS)));
    if (strlen($post->post_content) > MAX_CHARS):
        // Add "Read More" label.
        $summary .= '... <small><a class="link" href="'. get_permalink($post->ID) .'" target="_blank">(Read More)</a></small>';
    endif;
    return $summary;
}

function get_readable_date($date_str, $date_format='Y-m-d H:i:s') {
    $time_diff = time() - strtotime($date_str);
    //echo time() . ' - ' .strtotime($date_str) . '=' . $time_diff;
    
    if ($time_diff < 60) { // Within mins
        return $time_diff . ' secs ago';
    } elseif ($time_diff < 3600) { // Within Hrs
        return ceil($time_diff / 60) . ' mins ago';
    } elseif ($time_diff < 86400) { // Within Days
        return ceil($time_diff / 3600) . ' hrs ago';
    } elseif ($time_diff < (86400 * 7)) { // Within Weeks
        return ceil($time_diff / 86400) . ' days ago'; 
    } elseif ($time_diff < (86400 * 30)) { // Within months
        return ceil($time_diff / (86400 * 7)) . ' weeks ago';
    } elseif ($time_diff < (86400 * 30 * 12)) { // Within years
        return ceil($time_diff / (86400 * 30)) . ' months ago';
    } 
        
    //$date = date($date_format, strtotime($date_str));
    return ceil($time_diff / (86400 * 30 * 12)) . ' years ago (' . strftime('%d %b, %Y', strtotime($date_str)) . ')';
}



function get_var_name($str) {
    return str_replace('-', '_', $str);
}

function send_response($msg, $code=200){
    // echo '<pre>Res: '; print_r($msg); die;
    echo json_encode([
        'status' =>  strval($code)[0] == '2' ? 'Success' : 'Failed',
        'statusCode' => $code,
        'results' => $msg
    ]);
}

function get_pagination_range($total_pages, $current_page) {
    $segments = 5;
    
    if ($total_pages > $segments):
        $start = $current_page - 2;
        $end = $current_page + 2;

        if ($start <= 0):
            $start = 1;
            $end_to_fill = $segments - $start;
            $end = $current_page + $end_to_fill;
        endif;

        if ($end - $start >= $segments):
            $end = $start + ($segments - 1);
        endif;

        if ($end > $total_pages):
            $start -= $end - $total_pages;
            $end = $total_pages;
        endif;
    else:
        $start = 1;
        $end = $total_pages;
    endif;
    
    $hide_first = $current_page == 1 || $start == 1;
    $hide_last  = $current_page == $total_pages || $end == $total_pages;
    return [
        'start'         => $start,
        'end'           => $end,
        'hide_first'    => $hide_first,
        'hide_last'     => $hide_last,
        'hide_prev'     => ($hide_first || ($start - $segments) > 1),
        'hide_next'     => ($hide_last || ($total_pages - $segments) > $end),
    ];
}

function generate_breadcrumb_html($post, $cat_only=false, $include_icons=false, $include_current_title=false)
{
    if (! $cat_only):
    ?>
        <span title="Go to Home"><a href="<?php echo SITE_URL; ?>"><i class="fa fa-home"></i> Home</a></span>
    <?php 
    endif;
    
    $categories = [];
    if (isset($post->term_id)):
        array_push($categories, $post);
        if ($post->category_parent != 0):
            array_push($categories, get_category($post->category_parent));
        endif;
    else:
        foreach(wp_get_post_categories($post->ID) as $k => $cat_id): 
            array_push($categories, get_category($cat_id));
        endforeach;
    endif;
    
    foreach(array_reverse($categories) as $k => $category): 
        $icon_html = '';
        if ($include_icons):
            $term_meta = get_option('taxonomy_' . $category->term_id);
            $icon_html = !empty($term_meta['icon']) ? '<i class="fa ' . $term_meta['icon'] . '"></i> ' : '';
        endif;
    ?>
        <span title="Go to <?php echo $category->cat_name; ?>"><a href="<?php echo get_term_link($category->term_id); ?>"><?php echo $icon_html; ?><?php echo $category->cat_name; ?></a></span>
    <?php 
    endforeach; 

    if ($include_current_title):
    ?>
        <span><?php echo strlen($post->post_title) > 30 ? substr($post->post_title, 0, 30) . ' ...' : $post->post_title; ?></span>
    <?php
    endif;
}