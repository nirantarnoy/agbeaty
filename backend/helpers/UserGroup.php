<?php
class UserGroup{
    private static $data = [
        1 => 'Administrator',
        2 => 'User',

    ];

    private static $dataobj = [
        ['id'=>1,'name' => 'Administrator'],
        ['id'=>2,'name' => 'User'],

    ];
    public static function asArray()
    {
        return self::$data;
    }
    public static function asArrayObject()
    {
        return self::$dataobj;
    }
    public static function getTypeById($idx)
    {
        if (isset(self::$data[$idx])) {
            return self::$data[$idx];
        }

        return 'Unknown Type';
    }
    public static function getTypeByName($idx)
    {
        if (isset(self::$data[$idx])) {
            return self::$data[$idx];
        }

        return 'Unknown Type';
    }
}
?>
