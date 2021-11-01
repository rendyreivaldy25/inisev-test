<?php

    require_once 'helper/connection.php';
    require_once 'repository/user.php';
    require_once 'service/user.php';
    require_once 'configs.php';

    $errorMessage = "";
    if(isset($_POST['login'])){
        $connection = new Connection(
            $CONFIGS['DB_HOST'], 
            $CONFIGS['DB_USERNAME'],
            $CONFIGS['DB_PASSWORD'],
            $CONFIGS['DB_NAME']
        );
        $connectionCheck = $connection->connectionCheck();
        if(!$connectionCheck['status']){
            echo "Connection to MySQL failed. Error : ".$connectionCheck['message'];
            exit;
        }
        $userRepo = new UserRepository($connection);
        $userService = new UserService($userRepo);
        $loginCheck = $userService->login($_POST);
        if($loginCheck['status']){ 
            $url = "admininput.php";
            ob_start();
            header('Location: '.$url);
            ob_end_flush();
            die();
        } else {
            $errorMessage = $loginCheck['message'];
        }
    }

?>


<html>
    <head>
    </head>
    <body>
        <form method="post" action="">
            <div id="">
                <h1>Admin Login</h1>
                <div>
                    <input type="text" id="username" name="username" placeholder="Username" />
                </div>
                <div>
                    <input type="password" id="password" name="password" placeholder="Password"/>
                </div>
                <div>
                    <input type="submit" value="Submit" name="login" id="login" />
                </div>
                <?php if($errorMessage != '') echo "<p>$errorMessage</p>"; ?>
            </div>
        </form>
    </body>
</html>