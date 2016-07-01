<?php
/**
 * Created by PhpStorm.
 * User: Robel
 * Date: 4/2/2015
 * Time: 3:38 AM
 */
class DB_Access{
    private $DB_NAME;
    private $DB_HOST;
    private $DB_USER;
    private $DB_PASS;
    private $conn;
    public function __construct()
    {
        $this->load_config();
        $this->establish_conn();

    }
    private function load_config()
    {
        try{
            require_once "common.php";
            $this->DB_NAME = DB_NAME;
            $this->DB_HOST = DB_HOST;
            $this->DB_USER = DB_USER;
            $this->DB_PASS = DB_PASS;
            
            if($this->DB_NAME == null || $this->DB_HOST == null || $this->DB_USER== null)
            {
                die("Failed to load the system configuration");
            }
        }catch(Exception $e)
        {
            die($e->getmessage());
        }


    }
    public function establish_conn()
    {
        $DSN = "mysql:host={$this->DB_HOST};db_name={$this->DB_NAME};";
        $this->conn = new PDO($DSN, $this->DB_USER, $this->DB_PASS);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
        $this->conn->setAttribute(PDO::ATTR_PERSISTENT, true);
        if($this->conn === null)
        {
            die("Attempt to connect to the databse was not succesful");
        }
    }
    public function pass_connection()
    {
        return $this->conn;
    }

}
?>