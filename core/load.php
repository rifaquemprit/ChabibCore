<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Load {
    private static $plugin_in_use;
    protected static $js;
    protected static $css;
    
    public static function Css($css)
    {
        $path_css = 'admin/plugins/'.self::$plugin_in_use.'/css/'.$css; 
        self::$css[] = SITEURL . $path_css;
    }
    
    public static function library($filename)
    {
        $library = APPPATH.'libraries/'.$filename.EXT;
        if(file_exists($library))
        {
            require $library;
        }
        else
        {
            exit("Tidak dapat memuat librari $filename".EXT);
        }
    }

    public static function Js($js)
    {        
        $path_js = 'admin/plugins/'.self::$plugin_in_use.'/js/'.$js; 
        self::$js[] = SITEURL . $path_js;
    }
    
    
    public static function plugin($plugins)
    {
        self::$plugin_in_use = $plugins;
        
        $plugin_detect = APPPATH."admin/plugins/".$plugins ."/handle-admin".EXT;
        if(file_exists($plugin_detect))
        {
            include $plugin_detect;
        }
        else
        {
            exit("Error include file from ".$plugin_detect);
        }
        
    }
    
    public static function Core($core)
    {
        $core_check = APPPATH.'core/'.$core.EXT;
        if(file_exists($core_check)){
            require $core_check;
        }
        else {
            exit ("Error Load Core &quot;$core&quot; <br/> Core tidak ditemukan.<br/> File Location : $core_check");
        }
    }
}
?>
