<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Access extends Login{
    protected static $usertype;
    protected static $lihatcontent;

    
    
    private static function find_array($array,$find,$index)
    {
        if(isset($array[$index]))
        {
            if($array[$index] == $find)
            {
                $return = 'allow';
            }
            else
            {
                $return = self::find_array($array, $find, $index + 1);
            }
        }
        else
        {
            $return = 'deny';
        }
        return $return;
    }
    
    public static function set($access='')
    {
        $ac = explode('|',$access);
        self::$lihatcontent = self::find_array($ac,self::ch_login_level(),0);
    }
}
?>
