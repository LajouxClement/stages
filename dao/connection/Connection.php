<?php


include('ConnectionProperty.php');
class Connection {

    private static $connection;

    public function __construct() {
       self::$connection = self::Connection();
    }
    
    public static function Connection() {
        try {
            $host = 'host=' . ConnectionProperty::getHost();
            $dbname = 'dbname=' . ConnectionProperty::getDatabase();
            $port = ConnectionProperty::getPort();
            $user = ConnectionProperty::getUser();
            $pass = ConnectionProperty::getPassword();
            $db = new PDO('mysql:' . $host . ';' . $dbname . ';' . $port . ';', $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
        
            if(DEBUG){
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            
        } catch (PDOException $e) {
            echo "Erreur lors de la connexion! " . $e->getMessage() . "<br />";
            die();
        }
        return $db;
    }

    private static function getInstance() {
        if (!isset(self::$connection)) { 
            self::$connection = new self();
        }
        return self::$connection;
    }
    
    public function getConnection() {
        return self::getInstance();
    }

}
