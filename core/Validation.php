<?php

/*
 * Dibuat       : Chabib nurozak
 * project      : Chabib Core
 * sub Project  : Form Validation
 * project url  : http://github.com/chabibnr/chabibcore
 * Desc         : sub project ini terinspirasi dari Form_validation Codeigniter
 * Date         : 14 April 2012
 * Versi        : 1.1
 * Contoh penggunaan
 * $rules = array(
 *      'input_name'  => (
 *              'validate'  => 'pesan kesalahan'
 *          ),
 *      'email' => array(
 *          'email' => "Penulisan Email Tidak Valid"
 *      ),
 *      'username' => array(
 *          'max_length|5' => 'maksimal input 5',
 *          'min_length|2' => 'minimal input 2'
 *      )
 * 
 * );
 * 
 * validation::rules($rules);
 * if(validation::run() == false)
 * validation::show_error_messages();
 * 
 * else:
 * echo "Eksekusi form";
 * 
 * endif;
 * 
 */
Class Validation{
    protected static $tidak_valid;
    protected static $messages;

    public static function rules($rule=array(),$method='post')
    {
        $msg = '<ul>';
        $method = ($method == 'post') ? $_POST : $_GET;
        foreach ($rule as $name => $value)
        {
            $create_name_rule = isset($method[$name]) ? $method[$name] : '';
            foreach($value as $valid_select => $message)
            {
                $valid_select = explode('|',$valid_select);
                $value = isset($valid_select[1]) ? $valid_select[1] : '';
                $call_function = 'valid_'.$valid_select[0];
                
                if(self::$call_function($create_name_rule,$value) == FALSE)
                {
                    $msg .=  '<li>'.$message.'</li>';
                    self::$tidak_valid[] = 1;
                }
            }
            
        }
        $msg .= '</ul>';
        self::$messages = $msg;
    }
    
    public static function show_error_messages()
    {
        return self::$messages;
    }
    
    public static function run()
    {
        return (count(self::$tidak_valid) > 0) ? FALSE : TRUE;
    }
    
    /* -- ** Validaso ** -- */
    protected static function valid_email($str)
    {
        return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
    }
    
    protected static function valid_is_numeric($str)
    {
        return (! is_numeric($str)) ? FALSE : TRUE;
    }
    
    protected static function valid_max_length($str,$val)
    {
        return (strlen($str) > $val) ? FALSE : TRUE;
    }
    
    protected static function valid_min_length($str,$val)
    {
        return (strlen($str) < $val) ? FALSE : TRUE;
    }
    
    protected static function valid_required($str)
    {
        return (trim($str) == '') ? FALSE : TRUE;
    }
    
    public function valid_alpha($str)
    {
            return ( ! preg_match("/^([a-z])+$/i", $str)) ? FALSE : TRUE;
    }
    
    public function valid_alpha_numeric($str)
    {
            return ( ! preg_match("/^([a-z0-9])+$/i", $str)) ? FALSE : TRUE;
    }
    
    public function valid_alpha_dash($str)
    {
            return ( ! preg_match("/^([-a-z0-9_-])+$/i", $str)) ? FALSE : TRUE;
    }
    
    public function valid_decimal($str)
    {
            return (bool) preg_match('/^[\-+]?[0-9]+\.[0-9]+$/', $str);
    }
}
?>
