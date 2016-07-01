<?php

/**
 * Created by PhpStorm.
 * User: bengeos
 * Date: 6/30/16
 * Time: 7:44 PM
 */
require_once ('DB_Access.php');
class WebAPI
{
    private $connection;
    private $database;

    public function __construct()
    {
        $this->database = new DB_Access();
        $this->connection = $this->database->pass_connection();
        $this->connection->query("USE global_start");
    }

    public function Add_NewsFeed($Title, $Content, $ImageURL)
    {
        $res = array();
        $res['status'] = 1;
        try {
            $sql = "INSERT INTO NewsFeeds (Title, Content, Image_URL) VALUES(:nws_title, :nws_content, :nws_url)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindvalue(':nws_title', $Title, PDO::PARAM_STR);
            $stmt->bindvalue(':nws_content', $Content, PDO::PARAM_STR);
            $stmt->bindvalue(':nws_url', $ImageURL, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            $res['status'] = 0;
            $res['report'] = $e->getMessage();
        }
        return $res;
    }
    public function Add_NewsFeed_Log($User_ID, $News_ID)
    {
        $res = array();
        $res['status'] = 1;
        try {
            $sql = "INSERT INTO NewsFeeds_Log (User_ID, NewsFeed_ID) VALUES(:nws_usr, :nws_id)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindvalue(':nws_usr', $User_ID, PDO::PARAM_STR);
            $stmt->bindvalue(':nws_id', $News_ID, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            $res['status'] = 0;
            $res['report'] = $e->getMessage();
        }
        return $res;
    }
    public function Add_Testimony($User_ID, $Title, $Content)
    {
        $res = array();
        $res['status'] = 1;
        try {
            $sql = "INSERT INTO Testimony (User_ID, Title, Content) VALUES(:tst_usr, :tst_ttl, :tst_cnt)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindvalue(':tst_usr', $User_ID, PDO::PARAM_STR);
            $stmt->bindvalue(':tst_ttl', $Title, PDO::PARAM_STR);
            $stmt->bindvalue(':tst_cnt', $Content, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            $res['status'] = 0;
            $res['report'] = $e->getMessage();
        }
        return $res;
    }
    public function Get_New_NewsFeeds($User_ID)
    {
        $res = array();
        $res['status'] = 1;
        try {
            $sql = "SELECT * FROM NewsFeeds WHERE id NOT IN (SELECT NewsFeed_ID FROM NewsFeeds_Log WHERE User_ID=:u_id)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindvalue(':u_id', $User_ID, PDO::PARAM_STR);
            $stmt->execute();
            $set = array();
            while($row = $stmt->fetch())
            {
                $set[] = $row;
            }
            $res['result'] = $set;
        } catch (PDOException $e) {
            $res['status'] = 0;
            $res['report'] = $e->getMessage();
        }
        return $res;
    }
    public function Delete_All_NewsFeeds()
    {
        $res = array();
        $res['status'] = 1;
        try {
            $sql = "DELETE FROM NewsFeeds";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
        } catch (PDOException $e) {
            $res['status'] = 0;
            $res['report'] = $e->getMessage();
        }
        return $res;
    }
    public function Delete_NewsFeed_ByID($News_ID)
    {
        $res = array();
        $res['status'] = 1;
        try {
            $sql = "DELETE FROM NewsFeeds WHERE id=:news_id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindvalue(':news_id', $News_ID, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            $res['status'] = 0;
            $res['report'] = $e->getMessage();
        }
        return $res;
    }
    public function Delete_NewsFeed_Log_By_UserID($User_ID)
    {
        $res = array();
        $res['status'] = 1;
        try {
            $sql = "DELETE FROM NewsFeeds_Log WHERE User_ID=:usr_id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindvalue(':usr_id', $User_ID, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            $res['status'] = 0;
            $res['report'] = $e->getMessage();
        }
        return $res;
    }
    public function Get_All_News()
    {
        $res = array();
        $res['status'] = 1;
        try {
            $sql = "SELECT * FROM NewsFeeds ORDER  BY id";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $set = array();
            while ($row = $stmt->fetch()) {
                $set[] = $row;
            }
            $res['result'] = $set;
        } catch (PDOException $e) {
            $res['status'] = 0;
            $res['report'] = $e->getMessage();
        }
        return $res;
    }


}