<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../../../../wp-load.php';
include_once '../includes/helpers.php';

$data = [];
//echo '<pre>'; print_r($_SERVER); die;

// REQUEST METHOD
switch ($_SERVER['REQUEST_METHOD']):
    case 'GET':
        $data = $_REQUEST;
    break;
    case 'POST':
        $data = $_POST['data'];
    break;
    default:
        send_response('Unknown Request Method. (' . $_SERVER['REQUEST_METHOD'] .')', 203);
    break;
endswitch;


// Actions
switch (strtoupper($data['action'])):
    case 'GET-CITIES':
        $cities = get_cities($data['stateCode']); //, $is_valid=$data['isValid'] == 'true'); //$is_main_cities=$data['isMainCities'] == 'true');
        #send_response($cities);
        include_once './browse_by_loc.php';
    break;

    case 'GET-POSTS':
        $posts = get_user_posts($type=$data['type']);
        //echo '<pre>Posts: '; print_r($posts); die;
        require_once './list_posts.php';
    break;

    case 'GET-SUB-CATS':
        //echo '<pre>'; print_r($data);
        $sub_cats = get_all_categories($data['categoryId'], $is_menu_order=TRUE, $is_valid=False);
        send_response($sub_cats);
    break;
endswitch;

//$fn_name = get_var_name($data['action']);
//if (function_exists($fn_name)):
//    call_user_func($fn_name, $data);
//endif;

