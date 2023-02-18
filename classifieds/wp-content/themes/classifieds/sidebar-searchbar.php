<?php
    $age_start = 18;
    $age_end = 80;
    
    $cat_id = get_query_var('cat');
    $cat = $cat_id ? get_category($cat_id) : NULL;
    $parent_cat_id = $cat ? ($cat->category_parent == 0 ? $cat_id : $cat->category_parent) : NULL;
?>

<!-- Search bar -->
<section class="row" id="search-bar">
    <form action="" method="post">
        <div class="container">
            <div id="search-bar-more">
                <div class="row">
                      <div class="col-md-2">
                          <label><i class="fa fa-user"></i> Posted By</label>
                          <select>
                              <option value="">Anyone</option>
                              <option value="0">Male</option>
                              <option value="1">Female</option>
                              <option value="2">Transgender</option>
                              <option value="3">Agent/Dealer</option>
                          </select>
                      </div>

                      <div class="col-md-2">
                          <label><i class="fa fa-user"></i> Age <small>(Author)</small></label>
                          <select>
                                <option value="">--Min--</option>
                                <?php for ($i = $age_start; $i <= $age_end; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>  
                          </select>
                      </div>
                      <div class="col-md-2">
                          <label>&nbsp;</label>
                          <select>
                              <option value="">--Max--</option>
                              <?php for ($i = $age_start; $i <= $age_end; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>  
                          </select>
                      </div>

                      <div class="col-md-2">
                          <label><i class="fa fa-eye"></i> Views Count</label>
                          <select>
                              <option value="">&gt;= 0</option>
                              <option value="100">&gt; 50</option>
                              <option value="100">&gt; 100</option>
                              <option value="500">&gt; 500</option>
                              <option value="1000">&gt; 1000</option>
                              <option value="10000">&gt; 10000</option>
                          </select>
                      </div>

                      <div class="col-md-2">
                          <label><i class="fa fa-sort"></i> Sort By</label>
                          <select>
                              <option value="0">Relevant</option>
                              <option value="1">Views count</option>
                              <option value="2">Likes</option>
                              <option value="3">Rating</option>
                              <option value="4">Having Photo</option>
                              <option value="5">Last Author Login</option>
                          </select>
                      </div>

                      <div class="col-md-2">
                          <label><i class="fa fa-th-list"></i> View Mode</label>
                          <select>
                              <option value="">List</option>
                              <option value="1">Gallery</option>
                          </select>
                      </div>

                </div> <!-- row -->

                <div class="row more-options">
                    <div class="col-md-2">
                        <div class="btn active">
                            <i class="fa fa-hdd"></i>
                            Try Saved Search
                        </div>
                    </div>
					
                    <div class="col-md-2 mini-chk-box">
                        <i class="fa fa-times-circle"></i>
                        <label title="Posts published by the user who are came to online recently! (Which will increase the chances of reaching the most active users)">Recent Online Users</label>
                        <input type="checkbox" name="online_now" id="search-online-now" style="display: none;"/>
                    </div>

                    <div class="col-md-2 mini-chk-box">
                        <i class="fa fa-check-circle"></i>
                        <label title="Author's Email/Mobile No is already verified and having a good reputation">Verified contacts only</label>
                        <input type="checkbox" checked name="with_verified" id="search-with-verified" style="display: none;"/>
                    </div>

                    <div class="col-md-2 mini-chk-box">
                        <i class="fa fa-times-circle"></i>
                        <label title="Post must have atleast one photo.">With Photo only</label>
                        <input type="checkbox" name="with_photo" id="search-with-photo" style="display: none;"/>
                    </div>

                    <div class="col-md-2 mini-chk-box">
                        <i class="fa fa-times-circle"></i>
                        <label title="Search within the Post title only.">Search in title only</label>
                        <input type="checkbox" name="title_only" id="search-title-only" style="display: none;"/>
                    </div>

                    <div class="col-md-2 mini-chk-box">
                        <i class="fa fa-times-circle"></i>
                        <label title="Save this all filters for future searches.">Save this search</label>
                        <input type="checkbox" name="save_search" id="search-save-search" style="display: none;"/>
                    </div>
                </div>


            </div> <!-- more -->


            <div id="search-base-bar" class="row">
                <div class="col-md-2">
                    <select id="category">
                        <option value="">-- All --</option>
                        <?php
                            foreach (get_all_categories(false) as $k => $category):
                                $is_parent_selected = NULL != $parent_cat_id && $parent_cat_id == $category['_id'];
                                ?>
                                    <option value="<?php echo $category['_id']; ?>" <?php echo $is_parent_selected && $cat->category_parent == 0 ? 'selected readonly class="active"' : ''; ?>><?php echo $category['label']; ?></option>
                                <?php
                                if ($is_parent_selected && $cat->category_parent != 0):
                                    # Append "Sub Category" of current page (if present)
                                    ?>
                                        <option value="<?php echo $cat->term_id; ?>" <?php echo ' selected readonly class="active small" style="font-style: italic;"'; ?>>&nbsp;&nbsp;<?php echo $cat->name; ?></option>
                                    <?php
                                endif;
                            endforeach;
                            ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <input type="text" id="keyword" placeholder="Search keyword or Ad ID" autofocus autocomplete="off" />
                </div>

                <div class="col-md-2">
                    <input type="text" id="location" placeholder="e.g. Bangalore" />
                </div>

                <div class="col-md-2">
                    <select id="distance">
                        <option value="5">5 KM</option>
                        <option value="10">10 KM</option>
                        <option value="15" selected>15 KM</option>
                        <option value="30">30 KM</option>
                        <option value="50">50 KM</option>
                        <option value=""> &gt; 50 KM</option>
                    </select>
                </div>

                <div class="col-md-2 btn active icon-box">
                    <input type="submit" value="Search" class="btn active" />
                    <div id="search-btn-more"><i class="fa fa-chevron-down active"></i></div>
                </div>

            </div>
        </div>
    </form>
</section>
