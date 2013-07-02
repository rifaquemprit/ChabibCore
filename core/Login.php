<?php

class Login extends Load{
    protected static function explodeuser($id)
    {
        $user = str_replace(' ','',USER_TYPE);
        $user = explode('|',$user);
        return $user[$id];
    }
    
    public static function do_login($user,$password)
    {
        $sql = "SELECT `email_user`,`id_user`,`id_level`,`nama_user` FROM ".PREFIX_TABLE."user WHERE email_user='".mysql_real_escape_string($user)."' AND sandi_user='".  sha1($password)."'";
        $query = mysql_query($sql);
        if(mysql_num_rows($query) > 0){
            $result = mysql_fetch_assoc($query);
            $_SESSION['is_login']   = true;
            $_SESSION['email']      = $result['email_user'];
            $_SESSION['id']         = $result['id_user'];
            $_SESSION['name']       = $result['nama_user'];
            $_SESSION['level']      = $result['id_level'];
            header('location:?login=true');
        }
        else return false;
    }
    
    public static function ch_login_check()
    {
        return (isset($_SESSION['is_login'])) ? true : false;        
    }
    
    public static function ch_login_level()
    {
        return (isset($_SESSION['level'])) ? self::explodeuser($_SESSION['level']) : '';        
    }
    
    public static function ch_login_email()
    {
        return (isset($_SESSION['email'])) ? $_SESSION['email'] : '';
    }
    
    public static function ch_login_id()
    {
        return (isset($_SESSION['id'])) ? $_SESSION['id'] : '';
    }
    
    public static function ch_login_name()
    {
        return (isset($_SESSION['name'])) ? $_SESSION['name'] : '';
    }
}
