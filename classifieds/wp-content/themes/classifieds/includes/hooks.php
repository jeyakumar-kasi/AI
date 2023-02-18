<?php

/* 
 * Author       : Jai K
 * Purpose      : Custom Hooks
 * Created On   : 2022-10-01 14:57
 */

function add_query_vars_filter($vars) 
{
    $vars[] = "page";
    $vars[] = "total-pages";
    return $vars;
}

add_filter("query_var", "add_query_vars_filter");
