<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Db {
    protected static $select = "*";
    protected static $where = "";
    protected static $leftjoin = "";
    protected static $order = "";
    protected static $num_r;
    protected static $query_client_type = 'public';
    protected static $usePrefix = true;

    public static function insert($table,$data)
    {
        $table_prefix = (self::$usePrefix) ? PREFIX_TABLE : '';
        $my_field = array();
        $my_value = array();
        foreach($data as $field => $value)
        {
            $my_field[] = '`'.$field.'`';
            $my_value[] = "'".$value."'";
        }
        $fields = implode(',',$my_field);
        $values = implode(',',$my_value);
        $sql = "INSERT INTO `".$table_prefix."$table` ($fields) VALUES ($values)";
        self::$query_client_type = 'insert';
        return self::Query($sql);
    }
    
    public static function update($table,$data)
    {
        $table_prefix = (self::$usePrefix) ? PREFIX_TABLE : '';
        $updateset = array();
        foreach($data as $field => $value)
        {
            $updateset[] = '`'.$field.'` = '."'".$value."' ";
        }
        $updateset = implode(',',$updateset);
        $sql = "UPDATE `".$table_prefix."$table` SET $updateset". self::$where ;
        self::$query_client_type = 'update';
        #echo $sql;
        return self::Query($sql);
    }

    public static function num_rows()
    {
        return self::$num_r;
    }

    public static function Query($query)
    {
        #echo $query;
        $result = mysql_query($query) or die("Kesalahan tak terduga : ".  mysql_error()." <br/> Tidak dapat melakukan Query Berikut : <br><pre>$query</pre>");

        self::$num_r = (self::$query_client_type == 'get') ? mysql_num_rows($result) : 0;

        return $result;
    }
 
    public static function select($select)
    {
        self::$select = $select;
    }

    public static function where($where)
    {
        self::$where = " WHERE ".$where;
    }
    public static function  PrefixTable($prefix=true)
    {
        self::$usePrefix = $prefix;
    }
    
    public static function Left_Join($table_join,$clause)
    {
        $table_prefix = (self::$usePrefix) ? PREFIX_TABLE : '';
        self::$leftjoin = " LEFT JOIN ".$table_prefix . $table_join." ON ".$clause ;
    }

    public static function Order_By($order_by)
    {
        self::$order = " ORDER BY $order_by ";
    }
    
    public static function get($table,$start=0,$limit=50)
    {
        $table_prefix = (self::$usePrefix) ? PREFIX_TABLE : '';
        
        $sql =  "SELECT ". self::$select .
                " FROM ". $table_prefix . $table .
                self::$leftjoin.
                self::$where.
                self::$order.
                " LIMIT ".$start. ",". $limit;
        #echo $sql;
        self::$query_client_type = 'get';
        return self::Query($sql);
    }
}
?>
