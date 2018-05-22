<?php
session_start();
    $username = 'root';
    $password = '';
    $database = new PDO('mysql:host=localhost;dbname=clone_DB;charset=UTF8;', $username, $password);
    if ($database == false) {
        die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
    }
    
    $sql = 'SELECT * FROM users_data WHERE id=:T_ID';
    $statement = $database->prepare($sql);
    $statement->bindParam(':T_ID', $_SESSION['user_id']);
    $statement->execute();
    $records = $statement->fetchAll();
    foreach ($records as $record) {
        $u_name =$record['user_name'];
    }
    
    $sql = 'SELECT * FROM posts_data ORDER BY created_at DESC';
            $statement = $database->prepare($sql);
            $statement->execute();
            $records = $statement->fetchAll();
    $statement = null;
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
                                            <li><a href="alluserpage.php">Time Line</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php print htmlspecialchars($u_name, ENT_QUOTES, 'UTF-8'); ?><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="userpage.php">My profile</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="./Logout.php">Logout</a></li>
                            </ul>
                        </li>
                                    </ul>
            </div>
        </div>
    </nav>
</header>        
        <div class="container">
                <ul class="media-list">
                    <?php
            if($records){
                foreach ($records as $record) {
                    $posts = $record['posts'];
                    $post_time =$record['created_at'];
                    $post_id =$record['users_id'];
                    
                    $sql = 'SELECT * FROM users_data WHERE id=:A_ID';
                    $statement = $database->prepare($sql);
                    $statement->bindParam(':A_ID', $post_id);
                    $statement->execute();
                    $instances = $statement->fetchAll();
                    foreach ($instances as $instance) {
                        $image_url=$instance['information'];
                        $name=$instance['user_name'];
                    }
                    
                ?>
    <li class="media">
        
        <div class="media-left">
            <?php if($image_url==NULL){?><img class="media-object img-rounded" src="../uploads/basic.png" width="60px" height="60px" alt=""><?php }else{?>
            <img class="media-object img-rounded" src="<?php print ($image_url); ?>" width="60px" height="60px" alt="">
            <?php } ?>
        </div>
        <div class="media-body">
            <div>
                <a href="userpage.php"><?php print htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></a> <span class="text-muted">posted at <?php print htmlspecialchars($post_time, ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
            <div>
                <?php print htmlspecialchars($posts, ENT_QUOTES, 'UTF-8'); ?>
            </div>
            <div>
                <p><a href="userpage.php?id=<?=$post_id?>">View profile</a></p>
            </div>
        </div>
    </li>
    <?php                }
            }?>
</ul>
<ul class="pagination"><li class="disabled"><span>&laquo;</span></li> <li class="active"><span>1</span></li><li><a href="/">2</a></li><li><a href="/">3</a></li><li class="disabled"><span>...</span></li><li><a href="/">40</a></li><li><a href="/">41</a></li> <li><a href="/" rel="next">&raquo;</a></li></ul>
        </div>
    </body>
</html>
