<?php

if(isset($_POST['store-status'])){
    $url = "http://" . $_SERVER['SERVER_NAME'].'/arbites-status/admin/status.php' ;
    if(!$_POST['status']&&!$_POST['category']){
    }else{
        include_once('../../api/config/database.php');
        include_once('../objects/statusClass.php');
        include_once('../objects/categoryClass.php');
        $database = new Database();
        $db = $database->getConnection();
        $status = new Status($db);
        $status->status=$_POST['status'];
        $status->author=$_POST['author'];
        $status->category_id=$_POST['category'];
        $status->created_at=date('Y-m-d H:i:s');
        $status->create();
    }
    header("Location:".$url);

}