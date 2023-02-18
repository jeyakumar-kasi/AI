<?php

$total = 3;

function f($current) {
    global $total;
    $segments = 6;
    
    if ($total > $segments):
        $start = $current - 3;
        $end = $current + 3;

        if ($start <= 0):
            $start = 1;
            $end_to_fill = $segments - $start;
            $end = $current + $end_to_fill;
        endif;

        if ($end - $start >= $segments):
            $end = $start + ($segments - 1);
        endif;

        if ($end > $total):
            $start -= $end - $total;
            $end = $total;
        endif;
    else:
        $start = 1;
        $end = $total;
    endif;
    
    
    return [
        'start' => $start,
        'end'   => $end
    ];
}
    

for ($i = 1; $i <= $total; $i++):
    ?>
        <div>
            <h2><?php echo $i; ?></h2>
            <div  style="margin-bottom: 60px; text-align: center;">
            <?php
                $current = $i;
                $p = f($current);
                for ($page = $p['start']; $page <= $p['end']; $page++):
                    ?>
                    <span style="margin: 5px; padding:15px 20px; min-width: 80px; background: #eee;"><?php echo $page; ?></span>
                    <?php
                endfor;
            ?>
            </div>
        </div>
    <?php
endfor;

