<?php
    // MySQLサーバ接続に必要な値を変数に代入
    $username = 'root';
    $password = '';

    $database = new PDO('mysql:host=localhost;dbname=clone_DB;charset=UTF8;', $username, $password);

    if ($database == false) {
        die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
    }

    if ($_POST['btn_signUp']){ 
        if($_POST['password']==$_POST['password_confirmation']){
        
            $sql = 'INSERT INTO users_data (user_name,user_id,user_pw) VALUES(:name,:email,:password)';
        
            $statement = $database->prepare($sql);
        
            $statement->bindParam(':name', $_POST['name']);
            $statement->bindParam(':email', $_POST['email']);
            $statement->bindParam(':password', $_POST['password']);
 
        
            $statement->execute();
      
            $statement = null;
            
            //$sql = 'SELECT * FROM message_data ORDER BY created_at';
  
            //$statement = $database->query($sql);
   
            //$records = $statement->fetchAll();

            //$statement = null;
   
            $database = null;
            
            Header("Location:LogIn.php");

        }else{
        echo "<script>alert(\"Not matched the password\");</script>";
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
        <h1>Sign up</h1>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            
            <form method="POST" action="SignUp.php" accept-charset="UTF-8">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" name="name" type="text" id="name" name="name">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" name="email" type="email" id="email" name="email">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" name="password" type="password" value="" id="password" name="password">
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">Confirmation</label>
                    <input class="form-control" name="password_confirmation" type="password" value="" id="password_confirmation">
                </div>
                
                <input class="btn btn-primary btn-block" type="submit" value="Sign up" name="btn_signUp">
            </form>
        </div>
    </div>
        </div>
    </body>
</html>
