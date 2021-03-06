<?php

/*
 * dibuat oleh : Chabib nurozak
 * 
 */
class Menu{
    
    protected static $submenu;
    protected static $newsubmenu;
    protected static $create_menu = array();
    
    public static function create($text='',$link='',$attribute='',$posisi=0)
    {
        self::$create_menu[] = array('text' => "<a href='". SITEURL ."admin/". $link ."' $attribute >". $text ."</a>", 'posisi' => $posisi);
    }
    
    public static function newsub($text='',$link='',$attribute='',$posisi='')
    {
        self::$newsubmenu['text'][$posisi][] = array("<a href='". SITEURL ."admin/". $link ."' $attribute >". $text ."</a>");
    }
    public static function sub($data,$posisi=0)
    {
        $sub = '';
        foreach($data as $subdata)
        {
            $link = isset($subdata['link'])? $subdata['link'] : '';
            $text = isset($subdata['text']) ? $subdata['text'] : '';
            $attr = isset($subdata['attr']) ? $subdata['attr'] : '';
            $sub .= "<li><a href='".SITEURL."admin/". $link ."' ". $attr .">". $text ."</a></li>";
        }
        
        self::$submenu['text'][$posisi] = $sub;
    }
   
    public static function generate($open_ul_class='')
    {
        
        //var_dump(self::$create_menu);
        foreach(self::$create_menu as $key => $val)
        {
            $text[$key][] = $val['text'];
            $posisi[$key] = $val['posisi'];
        }
        array_multisort($posisi, SORT_ASC,  self::$create_menu);

        $menu  = "<ul class='ch-menu $open_ul_class'>";
        foreach(self::$create_menu as $menus):
            $class = isset(self::$submenu['text'][$menus['posisi']] ) || isset(self::$newsubmenu['text'][$menus['posisi']]) ? 'ch-li-submenu' : '';
            $menu .= "<li class='$class'>".$menus['text'];
            
            if(isset(self::$submenu['text'][$menus['posisi']]) || isset(self::$newsubmenu['text'][$menus['posisi']]))
            {
               $menu .= "<ul class='ch-ul-submenu'>";
               $menu .= self::$submenu['text'][$menus['posisi']];
               if(isset(self::$newsubmenu['text'][$menus['posisi']])){
                    foreach(self::$newsubmenu['text'][$menus['posisi']] as $mainnewsub )
                    {
                        foreach ($mainnewsub as $subcreate):
                        $menu .= "<li>". $subcreate ."</li>";
                        endforeach;
                    }
                    $menu .= "</ul>";
               }
            }
            $menu .= '</li>';
        endforeach;
        $menu .= "</ul>";                                                   
        return $menu;
    }
}
?>
