<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Class Template extends Access
{
    protected static $getContent;
    protected static $js;
    protected static $css;
    protected static $usethemes;

    public static function title($title='')
    {
        return $title;
    }
    
    public static function useThemes($use)
    {
        self::$usethemes = ($use == false) ?  false : true;
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
                $file_content = "<h1 style='margin-top: 120px; text-align: center'>TIDAK DITEMUKAN</h1>" ;
                $file_content .= "<h2 style='text-align: center'>Maaf halaman yang anda minta belum tersedia</h2>" ;
            }
        }
        else 
        {
            $file_content = false;
        }
        if(self::$lihatcontent == 'allow')
        {
            $file_content = $file_content;
        }
        else
        {
            $file_content = "Access Denied";
        }
        self::$getContent = $file_content;
    }
    
    public static function showContent()
    {
        return self::$getContent;
    }

    public static function render()
    {
        $dir = APPPATH."admin/module/";
        $handle = opendir($dir);
        $module = array();
        while($directory_module = readdir($handle))
        {
            if(is_dir($dir . $directory_module))
            {
                $config_load = $dir . $directory_module . '/config.php';
                if(file_exists($config_load))
                {
                    include $config_load;
                }
            }
        }
        if(isset(self::$usethemes))
        {
            if(self::$usethemes == false)
            {
                echo self::showContent();
            }
            else
            {
                include APPPATH.'admin/module/themes/'. THEME_USE .'/index'.EXT;
            }
        }
        else 
        {
            include APPPATH.'admin/module/themes/'. THEME_USE .'/index'.EXT;
        }
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
