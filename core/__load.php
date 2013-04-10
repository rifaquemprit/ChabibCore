<?php
include '../config.php';
define("COREADMINPATH",APPPATH.'core/');

if(!function_exists('__load'))
{
    function __load($load)
    {
        foreach($load as $Load_now)
        {
            include COREADMINPATH . $Load_now . EXT;
        }
        Template::viewContent();
    }
    
}

/**************** // Core Load // **********************/
$is_load = array(
    'Connector',
    'Login',
    'a_Template',
    'a_Plugin',
    'Anchor',
    'a_Menu',
    'a_Default_menus',
);

__load($is_load);
