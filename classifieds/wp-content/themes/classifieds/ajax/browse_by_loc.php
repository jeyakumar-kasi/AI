<?php

/* 
 * Author       : Jai K
 * Purpose      : List all cities based on State
 * Created On   : 2022-02-19 19:26
 */

$columns = 6;
$cities_count = count($cities);
$per_column = ceil($cities_count / $columns);
?>
<div class="col-md-<?php echo ceil(12/$columns); ?>">
    <ul class="list">
<?php
$i = 1;
foreach($cities as $k => $city):
    ?>
        <li class="sub-list-item"><a href="<?php echo SITE_URL . '/search-by/city/' . $city['id']; ?>"><span><?php echo $city['city_name']; ?></span></a></li>    
    <?php if ($i % $per_column == 0 && $cities_count != $i): ?>
                </ul>
            </div>
            <div class="col-md-<?php echo ceil(12/$columns); ?>">
                <ul class="list">
    <?php endif;
    $i += 1;
endforeach;
?>
    </ul>
</div>
                    
