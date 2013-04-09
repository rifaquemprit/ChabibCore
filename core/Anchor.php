<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Class Anchor{
    protected static $create_menu = array();
    public static function create($text='',$link='',$attribute='')
    {
        return  "<a href='". SITEURL . $link ."' $attribute >". $text ."</a>";
    }
}
?>
