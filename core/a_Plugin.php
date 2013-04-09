<?php
/*
 * 
 */
Class Plugin
{
    
    private static function info($info)
    {
        $data['PLUGIN_PEMBUAT']       = isset($info['PEMBUAT'])     ? $info['PEMBUAT']      : ''; 
        $data['PLUGIN_DESCRIPTION']   = isset($info['DESCRIPTION']) ? $info['DESCRIPTION']  : ''; 
        $data['PLUGIN_NAMA_PLUGIN']   = isset($info['NAMA_PLUGIN']) ? $info['NAMA_PLUGIN']  : ''; 
        $data['PLUGIN_TANGGAL_BUAT']  = isset($info['TANGGAL_BUAT'])? $info['TANGGAL_BUAT'] : '';
        $data['PLUGIN_VERSI']         = isset($info['VERSI'])       ? $info['VERSI']        : '';
        $data['PLUGIN_WEB_PLUGIN']    = isset($info['WEB_PLUGIN'])  ? $info['WEB_PLUGIN']   : '';
        $data['PLUGIN_WEB_PEMBUAT']   = isset($info['WEB_PEMBUAT']) ? $info['WEB_PEMBUAT']  : '';
        $data['PLUGIN_REGISTER']      = isset($info['REGISTER'])    ? $info['REGISTER']     : '';
        return $data;
    }
    
    public static function __list()
    {
        $dir = APPPATH."admin/plugins/";
        $handle = opendir($dir);
        $PLUGIN = array();
        while($directory_plugin = readdir($handle))
        {
            if(is_dir($dir . $directory_plugin))
            {
                $file_info = $dir . $directory_plugin . '/info.php';
                if(file_exists($file_info))
                {
                    $info = array();
                    include $file_info;
                    $PLUGIN[] = Plugin::info($info);
                }
            }
        }
        return $PLUGIN;
    }
}