<?php
global $MyConfig;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Class Config extends Db
{
    protected static $config_to_array;
    protected static $get_index_setting;

    public static function settingQuery()
    {
        $indexing = array();
        $values   = array();
        $config_array = array();
        Db::PrefixTable();
        $result = Db::get('settings');
        while($setting = mysql_fetch_object($result))
        {
            $config_array[] = array('index' => $setting->setting_register, 'value' =>  $setting->setting_value);
        }
        foreach ($config_array as $key => $value)
        {
            self::$config_to_array[$value['index']] = json_decode($value['value'],TRUE);
        }
       
    }
    
    public static function getConfig($index)
    {
        self::$get_index_setting = $index;
    }

    public static function MyConfig($use_setting,$costume_index=NULL)
    {
        self::$get_index_setting = (isset($costume_index)) ? $costume_index : self::$get_index_setting;
        $converttophp = @self::$config_to_array[self::$get_index_setting];
        return (isset($converttophp[$use_setting])) ? $converttophp[$use_setting] : ''; 
    }
    
    public static function saveConfig($register,$value)
    {
        Db::select('setting_register');
        Db::where("setting_register='$register'");
        Db::get('settings');
        $data['setting_value'] = json_encode($value);
        
        if(Db::num_rows() > 0)
        {
            Db::where("setting_register='$register'");
            $return = Db::update('settings', $data);
        }
        else
        {
            $data['setting_register'] = $register;
            $data['setting_value'] = json_encode($value);
            $return = Db::insert('settings', $data);
        }
        return $data;
    }
}
Config::settingQuery();
?>
