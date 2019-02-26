<?php 
include_once('../../api/config/database.php');
include_once('../../functions.php');
$url = "http://" . $_SERVER['SERVER_NAME'].'/arbites-status/admin/' ;
$isLogin = checkLogin();
if($isLogin){
    header("Location:".$url);
}
$database = new Database();
$db = $database->getConnection();
if(isset($_POST['login'])){
    $u_email = $_POST['email'];
    $password = $_POST['password'];
    $check_user = "SELECT * FROM users WHERE email='$u_email' AND password='$password'";
    try {
        $statement = $db->prepare($check_user);
        $statement->execute();
        $data = $statement->fetchall(PDO::FETCH_ASSOC);
         
        if(count($data) > 0){
            $_SESSION['email'] = $u_email;
            // echo "hello2";
            header('Location: '.$url);      
        }else{
            header('Location: '.$url);
        }

    } catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
}
?>




<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="./assets/img/favicon.ico">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Admin Panel</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet" />
    <link href="../documentation/css/documentation.css" rel="stylesheet" />
</head>

<body>
    <?php
    // if(!$_SESSION['email'])  
    // {  
    //     header("Location: login.php");//redirect to login page to secure the welcome page without login access.  
    // }  
    ?>
    <?php $url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];  ?>
    <div class="header-wrapper">

        <div class="header" style="background-image: url('../assets/img/bg1.jpg');">
            <div class="filter"></div>
            <div class="title-container text-center" style="padding:0 60px">
                <h1>Admin Panel</h1>
                
                <!-- <div class="row"> -->
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6" >
                        <form class="form-horizontal " action="" method ="post">
                        <!-- <form class="form-horizontal " action="<?php echo $url?>auth-pages/login.php" method ="post"> -->
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Email:</label>
                                <div class="col-sm-10">
                                    <input name="email" required type="email" class="form-control" id="email" placeholder="Enter email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Password: </label>
                                <div class="col-sm-10">
                                    <input name="password" required type="password" class="form-control" id="pwd" placeholder="Enter password">
                                </div>
                            </div>
                            <button class="btn btn-neutral  btn-fill submit" value="login" name="login">Login</button>
                        </form>
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-3"></div>
                <!-- </div>/.row -->

            </div>
        </div>

    </div>
</body>

</html>

