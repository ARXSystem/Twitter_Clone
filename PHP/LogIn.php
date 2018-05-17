<?php
session_start();
    // MySQLサーバ接続に必要な値を変数に代入
    $username = 'root';
    $password = '';
    $database = new PDO('mysql:host=localhost;dbname=clone_DB;charset=UTF8;', $username, $password);

    if ($database == false) {
        die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
    }

    if ($_POST['btn-login']){ 
            
            $sql = 'SELECT EXISTS(SELECT * FROM users_data WHERE user_id=:email)';
            //$sql = 'SELECT * FROM users_data WHERE user_id=:email';
            
            $statement = $database->prepare($sql);
            $statement->bindParam(':email', $_POST['email']);
            $statement->execute();
            $records = $statement->fetchAll();
            $check = $records[0][0];
            if($check==1){
                $statement = null;
                $sql = 'SELECT * FROM users_data WHERE user_id=:email';
                $statement = $database->prepare($sql);
                $statement->bindParam(':email', $_POST['email']);
                $statement->execute();
                $records = $statement->fetchAll();
                
                foreach ($records as $record) {
                    $id = $record['id'];
                    $u_pw = $record['user_pw'];
                }
                if($u_pw==$_POST['password']){
                    $_SESSION['user_id'] = $id;
                    $statement = null;
                    $database = null;
                    Header("Location:micropost.php");
                }else {
                    $statement = null;
                    $database = null;
                    echo "<script>alert(\"Wrong password\");</script>";
                }
            }else{
                $statement = null;
                $database = null;
                echo "<script>alert(\"Can't find the User\");</script>";
            }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Microposts</title>
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <header>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Microposts</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                                            <li><a href="SignUp.php">Sign up</a></li>
                        <li><a href="LogIn.php">Login</a></li>
                                    </ul>
            </div>
        </div>
    </nav>
</header>        
        <div class="container">
                        
                <div class="text-center">
        <h1>Log in</h1>
    </div>
    
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            
            <form method="POST" action="LogIn.php" accept-charset="UTF-8"><input name="_token" type="hidden" value="hW7ZGkuYzvemGTXnZXYg5ZLQbzCqBHL6QWxn2jha">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" name="email" type="email" id="email">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" name="password" type="password" value="" id="password">
                </div>
                
                <input class="btn btn-primary btn-block" type="submit" value="Log in" name="btn-login">
            </form>
            
            <p>New user? <a href="SignUp.php">Sign up now!</a></p>
        </div>
    </div>
        </div>
    </body>
</html>
