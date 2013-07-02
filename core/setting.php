<?php
class Setting{
    
    /* waktu indonesia */
    private static function olahwaktu($format,$waktu)
    {
        $bulan_aray= array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

        switch ($format){
            case 'y':
                $return = substr($waktu,0,4);
                break;
            case 'm':
                $return = $bulan_aray[substr($waktu,5,2)-1];
                break;
            case 'd':
                $return = substr($waktu,8,2);
                break;
            case 't':
                $return = substr($waktu,11,8);
                break;
        }
        return $return;
    }

    public function date_indonesia($waktu,$format='d-m-y')
    {
        $format = explode('-',$format);
        $return = '';
        foreach ($format as $key):
            $return .= self::olahwaktu($key, $waktu). ' ';
        endforeach;
        return $return;
    }

    public static function money($money,$userp=true)
    {
        if($userp==true)
        {
            $span_open = "<span style='float: left'> Rp. ";
            $span_close = "</span><span class='clear: both'></span>";
        }
        else
        {
            $span_open = "";
            $span_close = "";
        }
        return $span_open . $span_close . number_format($money, 2, ',', '.');
    }

    public function select_bulan($attribute='',$name='')
    {
        $bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $name = ($name=='')? 'bulan' : $name;
        echo "<select name='".$name."' $attribute>";
        for ($bulan_angka = 0; $bulan_angka<12; $bulan_angka++){
         $bulan_dg_angka = $bulan_angka+1;
         echo "<option value=".$bulan_dg_angka.">". $bulan[$bulan_angka]."</option>";
        }
        echo "</select>";
    }
    
    public static function persen($p,$a)
    {
        return $a / 100 *$p;
    }

    public function spesial_input($text){
        $text = htmlspecialchars($text);
        $text = preg_replace("/=/", "=\"\"", $text);
        $text = preg_replace("/&quot;/", "\"", $text);
        $tags = "/&lt;(\/|)(\w*)(\ |)(\w*)([\\\=]*)(?|(\")\"&quot;\"|)(?|(.*)?&quot;(\")|)([\ ]?)(\/|)&gt;/i";
        $replacement = "&lt;$1$2$3$4$5$6$7$8$9$10&gt;";
        $text = preg_replace($tags, $replacement, $text);
        $text = preg_replace("/=\"\"/", "=", $text);
        //$text = nl2br($text);
        $text = preg_replace("/&quot;/", "&quot;&quot;", $text);

        return $text;
    }
}
