<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// 5px => 168, 188, 48
// 15  => 168, 188, 68
// 25  => 168, 188, 88

//$date_str = '2021-12-02 16:25:00';
$date_str = '2022-02-06 16:46:10';
date_default_timezone_set('Asia/Kolkata');
echo $date_str;
function get_readable_date($date_str, $date_format='Y-m-d H:i:s') {
    $time_diff = time() - strtotime($date_str); // 300 sec
    
    
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

// 60 * 60 * 24 * 30 =>   25,92,000 (1 month)
//                   => 3,11,04,000 (1 Year)  

//exit('<br />'. get_readable_date($date_str));

?>
<style type="text/css">
    section {
        padding: 10px;
        counter-reset: c;
    }

    div {
        /*padding: 40px 10px 40px 10px;*/
        padding: 5px; 
        margin: 10px;
        text-align: center;
        /*counter-increment: c;*/  
        background: #006799;
        color: #fff;
        width: 80px;
        min-width: 80px;
        
    }
    
    .arrow {
        position: absolute;
        border: solid black;
        border-width: 0px 0px 3px 3px;
        border-color: #006799;
        display: none;
        padding: 10px;
        transform: rotate(135deg);
        transition: all .5s ease-in;
      }
      
/*      div:focus ~ div {
          counter-increment: a;
      }*/
      
/*      :root {
        --magic-number: 90;
      }*/
      
/*      div:focus ~ .arrow {
        --deg: calc(counter(c)*10%);
        transform: translateY(calc(c * 10%));  rotate(135deg);
        transform: rotate(calc(var(--magic-number) * 1deg));
        --magic-number: calc(100-c); calc(counters(c, '.') * 1);
        transform: translateY(calc(var(--magic-number) * -10%));

        color: #f44;
        
      }*/
      
      #d::before {
          /*margin-bottom: calc((var(--parent-children-count)- sibling-index()) * 100);*/
          /*margin-bottom: calc(10% - 10px);*/
          /*counter-reset: current-index var(--parent-children-count);*/
          
          /*content: counter(var(--parent-children-count));*/
        /*content: counters(c, '.') " th position.";*/
      }
</style>

<section style="height: 100px; margin-bottom: 40px;">
    Hello, Tabs..
</section>

<section class="parent tabs-left">
    <div tabindex="0">Recent</div>
    <div tabindex="0">Trending</div>
    <div tabindex="0">Trending</div>
    <div tabindex="0">Trending</div>
    <div tabindex="0">Trending</div>
    <div tabindex="0">Trending</div>
    <div tabindex="0">Trending</div>
    
    <div tabindex="0" id="d" class="active">Recommend</div>
</section>

<script type="text/javascript" src="http://127.0.0.1/works/hyproid-ads/wp-content/themes/classifieds/static/js/jquery-3.4.0.min.js"></script>
<script type='text/javascript'>
    $(function(){
        function getVarName(str) {
            console.log(str);
            str = str.replace(/\W+/g, ' ').trim();
            console.log(str);
            var s = ''
            ,   passLetter = '';
            for (var i=0; i < str.length; i++) {
                if (str[i] == ' ') {
                    passLetter = str[i+1].toUpperCase();
                } else  {
                    passLetter =(passLetter != '' ? passLetter : str[i]);
                    s += (s == '') ? passLetter.toLowerCase() : passLetter;
                    passLetter = '';
                }
            }
            return s;
        }
        
        alert(getVarName('#top-posts '));


        $('div').on('click', function(){
            var style = ''
            ,   $this = $(this)
            ,   $parent = $this.parent();
            if ($this.siblings('.arrow').length == 0) {
                if ($parent.hasClass('tabs-left')) {
                    style += 'border-width: 0px 3px 3px 0px;'; // Left Arrow
                    style += 'margin-left: -5px; ';
                    
                } else if ($parent.hasClass('tabs-right')) {
                    style += 'border-width: 3px 0px 0px 3px;'; // Right Arrow
                    style += 'left: ' + $this.outerWidth(true) + 'px;';
                } else if ($parent.hasClass('tabs-up')) {
                    style += 'border-width: 0px 0px 3px 3px;'; // Up Arrow
                    style += 'margin-top: -15px;';
                } else {
                    style += 'border-width: 3px 3px 0px 0px;'; // Down Arrow
                    style += 'margin-top: '+ ($this.outerHeight(true) - 5) +'px;';
                }
                $parent.prepend('<i class="arrow" style="'+ style +'"></i>');
            }
            
            // 20 = 3
            // 30 = 2
            // 10 = 4
            
            var H = 0
            ,   attr = {display: 'inline-block'}
            ,   idx = $this.index();
            if ($parent.hasClass('tabs-left') || $parent.hasClass('tabs-right')) {
                H = $this.outerHeight(true);
                //alert($parent.offset().top + ', ' + $this.offset().top + ', ' + H);
                var T = ($this.offset().top - $parent.offset().top) - ((H/2)-16); //- ((H/(H/16))-16);//((H/3) - (H/2));
                //transformAttr = 'translateY('+ (((idx-1) * H) + (H/2) - 15) +'px)';
                attr['transform'] = 'translateY('+ T +'px)';
                var m = (H-$this.height())
                attr['margin-top'] = (H-32)-(H/((H/32)*2)) + 'px';
//                alert(H + ', ' + $this.height());  // (5, 5) => 38, 18 = 3 OK // (5, 10) => 48,18 = 2 OK
            } else {
                H = $this.outerWidth(true);
                attr['transform'] = 'translateX('+ ($this.offset().left + (H/3) - 15) +'px)';
            }
            
            attr['transform'] += ' rotate(135deg)';
            window.setTimeout(function(){ $this.siblings('.arrow').css(attr); }, 0);
        });
    });
</script>



