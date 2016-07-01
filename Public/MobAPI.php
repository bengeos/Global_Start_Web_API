<?php
/**
 * Created by PhpStorm.
 * User: bengeos
 * Date: 6/30/16
 * Time: 7:50 PM
 */
require_once ('../Private/WebAPI.php');
$api = new WebAPI();
$Response = array();

if(isset($_POST)){
    if(isset($_POST['Service']) && isset($_POST['Param']) && isset($_POST['User_ID'])){
        $Service = $_POST['Service'];
        $Param = $_POST['Param'];
        $User_ID = $_POST['User_ID'];

        if($Service == 'Update'){
            $Response['Response'] = array();
            $_news_feeds = $api->Get_New_NewsFeeds($User_ID);
            if(isset($_news_feeds['result'])){
                $Response['Response']['NewsFeeds'] = $_news_feeds['result'];
                foreach ($_news_feeds['result'] as $news){
                    $api->Add_NewsFeed_Log($User_ID,$news['id']);
                }
            }
        }elseif($Service == 'New'){
            $api->Delete_NewsFeed_Log_By_UserID($User_ID);
        }
        echo json_encode($Response);
    }elseif (isset($_POST['Service']) && isset($_POST['User_ID']) && isset($_POST['Title']) && isset($_POST['Content'])){
        $Service = $_POST['Service'];
        $User_ID = $_POST['User_ID'];
        $Title = $_POST['Title'];
        $Content = $_POST['Content'];
        if($Service == 'Testimony'){
            $Response['Response'] = array();
            $found = $api->Add_Testimony($User_ID,$Title,$Content);
            $Response['Response'] = $found;
            echo json_encode($Response);
        }
    }else{
        $Response['Error'] = 'Sent Parameter is not valid';
        $api->Delete_NewsFeed_Log_By_UserID('352584066232031');
        echo json_encode($Response);
    }
}else{
    $api->Delete_NewsFeed_Log_By_UserID('352584066232031');
}