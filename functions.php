
<?php 
session_start();
function checkLogin(){
    $isLogin = false;
    if(isset($_SESSION['email'])  ){
        $isLogin = true;
    }
    return $isLogin;
}