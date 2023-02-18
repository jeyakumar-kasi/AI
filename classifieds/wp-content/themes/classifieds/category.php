<?php

/* 
 * Name         : Category - Landing Page
 * Author       : Jai K
 * Purpose      : List all the posts for the given category.
 * Created On   : 2022-09-30 22:41
 */

$limit = 10;
$category = get_queried_object();
$total_pages = get_query_var("total-pages");
$current_page = get_query_var("page") ? get_query_var("page") : 1;
$offset = ($current_page - 1) * $limit;
# echo '<pre>'; print_r($category); die;

# Get all the posts for the particular category.
$args = [
    "post_type"         => "post",
    "taxonomy"          => "category",
    #"cat"               => [$category->cat_ID, $category->category_parent],
    "cat"               => $category->cat_ID,
    "post_status"       => "publish",
    "posts_per_page"    => $limit,
    "offset"            => $offset,
    "order_by"          => "post_modified",
    "order"             => "DESC",
    #"paged"             => $current_page
];

if ($current_page == 1 || !$total_pages):
    # Finf the total number of pages.
    $wp_query = new WP_Query($args);
    $total_count = $wp_query->found_posts;
    $total_pages = ceil($total_count/$limit);
    wp_reset_query();
else:
    $total_count = $total_pages * $current_page;
endif;


$posts = get_posts($args);
#echo '<pre>'.$total_pages; print_r($posts); die;

# Load Header Page
get_header();

?>

<section id="content" class="container">
    <!-- Search Bar -->
    <?php get_sidebar('searchbar'); ?>
    
    <div class="row content-header">
        <div id="breadcrumb" class="col-md-7">
            <?php echo generate_breadcrumb_html($category, $include_current_title=false); ?>
        </div>
        <div class="col-md-5">
            <div>Total: <?php echo $total_count; ?></div>
            <div>Per Page:
                <select class="per-page mini-select-box">
                    <option value="10" <?php echo $limit == 10 ? "selected" : ""; ?>>10</option>
                    <option value="20" <?php echo $limit == 20 ? "selected" : ""; ?>>20</option>
                    <option value="30" <?php echo $limit == 30 ? "selected" : ""; ?>>30</option>
                    <option value="50" <?php echo $limit == 50 ? "selected" : ""; ?>>50</option>
                    <option value="100" <?php echo $limit == 100 ? "selected" : ""; ?>>100</option>
                </select>
            </div>
            <div class="switcher">
                <i title="Grid View" class="fa fa-th"></i>
                <i title="List View" class="fa fa-list active"></i>
            </div>
        </div>
    </div>

    <div class="row list">
        <?php require_once "ajax/list_posts.php"; ?>
    </div> <!-- row -->

    
    <div class="row paging">
        <div class="container">
            <?php if ($total_pages > 1): ?>
                <div class="row">
                    <?php  $paging_range = get_pagination_range($total_pages, $current_page); ?>
                    <div class="col-md-2">
                        <span style="padding: 10px; box-shadow: none; border: none; cursor: auto;">&nbsp;</span>
                    </div>
                    <div class="col-md-8">
                        <?php if (! $paging_range['hide_first']): ?><a href="?page=1&total-pages=<?php echo $total_pages; ?>" class="col-xs-hide"><span title="Go to 1st page"><i class="fa fa-angle-double-left"></i></span></a><?php endif; ?>
                        <?php if (! $paging_range['hide_prev']): ?><a href="?page=<?php echo $paging_range['start'] - 1; ?>&total-pages=<?php echo $total_pages; ?>" class="col-xs-hide"><span title="Go to Page <?php echo $paging_range['start'] - 1; ?>"><i class="fa fa-angle-left"></i></span></a><?php endif; ?>
                        <span style="padding: 1px; box-shadow: none; border: none; cursor: auto;">&nbsp;</span>
                        <?php for ($i = $paging_range['start']; $i <= $paging_range['end']; $i++): ?>
                            <a <?php echo ($i == $current_page) ? '' : 'href="?page=' . $i . '&total-pages='.$total_pages . '"'; ?> ><span title="Page <?php  echo $i; ?>" class="<?php echo ($i == $current_page ? 'active' : ''); ?>" ><?php echo $i; ?></span></a>
                        <?php endfor; ?>
                        <span style="padding: 1px; box-shadow: none; border: none; cursor: auto;">&nbsp;</span>
                        <?php if (! $paging_range['hide_next']): ?><a href="?page=<?php echo $paging_range['end'] + 1; ?>&total-pages=<?php echo $total_pages; ?>" class="col-xs-hide"><span title="Go to Page <?php echo $paging_range['end'] + 1; ?>"><i class="fa fa-angle-right"></i></span></a><?php endif; ?>
                        <?php if (! $paging_range['hide_last']): ?><a href="?page=<?php echo $total_pages; ?>&total-pages=<?php echo $total_pages; ?>" class="col-xs-hide"><span title="Go to <?php echo $total_pages; ?>th page"><i class="fa fa-angle-double-right"></i></span></a><?php endif; ?>
                    </div>
                    <div class="col-md-2">
                        <span style="padding: 10px; box-shadow: none; border: none; cursor: auto;">&nbsp;</span>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
            <?php if ($total_pages != 0): ?>
                <div class="col-md-12 paging-title"><label id="paging-lbl" style="box-shadow: none; border: none;">Total Pages</label> :
                  <input disabled type="number" id="go-to-page" class="mini-select-box" title="Go to Page"
                        style="color: #1baadd; border-bottom: 1px dotted #ccc; text-align: center;" min="1" max="<?php echo $total_pages; ?>" placeholder="<?php echo $total_pages; ?>" current="<?php echo $current_page; ?>"
                        onfocus="javascript: document.getElementById('paging-lbl').innerHTML='Total Pages: <b id=paginglbl>' + (this.placeholder) + '</b> | <i class=\'active\' style=\'padding:2px 5px; cursor: pointer;\' \
                        onclick=\'Javascript: document.forms[0].submit();\'>Go to </i>'; this.placeholder = '';"
                        onblur="javascript: this.placeholder=document.getElementById('paginglbl').innerHTML; this.value== '' ? document.getElementById('paging-lbl').innerHTML='Total Pages' : '';" />
                </div>
            <?php endif; ?>
            </div>
        </div> <!-- container -->    
    </div> <!-- paging -->
</section>
<?php
get_footer();
