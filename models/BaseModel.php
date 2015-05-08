
//abstract class BaseModel {
//    protected static $db;
//
//    public function __construct() {
//        if (self::$db == null) {
//
//            self::$db = new mysqli(
//                DB_HOST, DB_USER, DB_PASS, DB_NAME);
//            self::$db->set_charset("utf8");
//            if (self::$db->connect_errno) {
//                die('Cannot connect to database');
//            }
//        }
//    }
//}

<?php
abstract class BaseModel {
    protected static $db;

    public function __construct() {
        if (self::$db == null) {
            $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.DB_PORT;
//            self::$db = new PDO($dsn, DB_USER, DB_PASS);
            self::$db = new mysqli(
                $dsn, DB_USER, DB_PASS);
            var_dump(self::$db);
            self::$db->set_charset("utf8");
            if (self::$db->connect_errno) {
                die('Cannot connect to database');
            }
        }
    }
}
