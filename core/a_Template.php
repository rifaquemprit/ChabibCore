<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Class Template
{
    protected static $getContent;
    protected static $js;
    protected static $css;

    public static function title($title='')
    {
        return $title;
    }
    
    public static function viewContent()
    {
        if(isset($_GET['m']))
        {
            $getFile = APPPATH.'admin/module/'.$_GET['m'];
        }
        elseif(isset ($_GET['p']))
        {
            $getFile = APPPATH.'admin/plugins/'.$_GET['p'];
        }
        
        if(isset($getFile))
        {
            if(file_exists($getFile .  EXT))
            {
                ob_start();
                include($getFile . EXT);
                $file_content = ob_get_contents();
                ob_end_clean ();
            }
            
            else if(file_exists($getFile .'/index' . EXT))
            {
                ob_start();
                include($getFile . '/index' . EXT);
                $file_content = ob_get_contents();
                ob_end_clean ();
            }
            
            else
            {
                $file_content = "<h3>TIDAK DITEMUKAN</h3>".$getFile ;
            }
        }
        else 
        {
            $file_content = false;
        }
        self::$getContent = $file_content;
    }
    
    public static function showContent()
    {
        return self::$getContent;
    }

    public static function render()
    {
        include APPPATH.'admin/module/themes/'. THEME_USE .'/index'.EXT;
    }
    public static function addCss($css)
    {
        if(isset($_GET['m']))
        {
            $files_path = explode('/',$_GET['m']);
            $path_css = 'admin/module/'.$files_path[0].'/'.$css; 
        }
        if(isset($_GET['p']))
        {
            $files_path = explode('/',$_GET['p']);
            $path_css = 'admin/plugins/'.$files_path[0].'/'.$css; 
        }
        self::$css[] = SITEURL . $path_css;
    }

    public static function stylesheet($style=array())
    {
        $css = '';
        if(is_array($style))
        {
            foreach($style as $value)
            {
                $css .= "<link rel='stylesheet' href='".SITEURL."admin/module/themes/".THEME_USE."/css/".$value."' type='text/css'/> \n";
            }
        }
        if(isset(self::$css))
        {
            foreach(self::$css as $value)
            {
                $css .= "<link rel='stylesheet' href='".$value."' type='text/css'/> \n";
            }
        }
        return $css;
    }
    
    public static function addjs($js)
    {
        if(isset($_GET['m']))
        {
            $files_path = explode('/',$_GET['m']);
            $path_js = 'admin/module/'.$files_path[0].'/'.$js; 
        }
        if(isset($_GET['p']))
        {
            $files_path = explode('/',$_GET['p']);
            $path_js = 'admin/plugins/'.$files_path[0].'/'.$js; 
        }
        self::$js[] = SITEURL . $path_js;
    }
    public static function javascript($js=  array())
    {
        $javascript = '';
        if(is_array($js))
        {
            foreach ($js as $value)
            {
                $javascript .= "<script src='".SITEURL."admin/module/themes/".THEME_USE."/js/".$value."' type='text/javascript'></script> \n";
            }
        }
        
        if(isset(self::$js))
        {
            foreach (self::$js as $value)
            {
                $javascript .= "<script src='".$value."' type='text/javascript'></script> \n";
            }
        }
        
        return $javascript;
    }
}
?>