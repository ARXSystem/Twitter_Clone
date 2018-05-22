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
        $id = $record['id'];
        $u_name =$record['user_name'];
        $image_url= $record['information'];
    }
    
        $get_id=$_GET[id];
    
    if($_POST['btn_follow']){
        $sql = 'INSERT INTO follows_data(users_id,follows_id) VALUES(:u_id,:fol_id)';
        $statement = $database->prepare($sql);
        $statement->bindParam(':u_id', $_SESSION['user_id']);
        $statement->bindParam(':fol_id', $get_id);
        $statement->execute();
        $statement = null;
    }
    
    if($_POST['btn_unfollow']){
        $sql = 'DELETE FROM follows_data WHERE (users_id=:user_id AND follows_id=:fol_id)';
        $statement = $database->prepare($sql);
        $statement->bindParam(':user_id', $_SESSION['user_id']);
        $statement->bindParam(':fol_id', $get_id);
        $statement->execute();
        $statement = null;
    }
    
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
<?php
$get_id=$_GET[id];
if($get_id==NULL){
    $sql = 'SELECT * FROM posts_data WHERE users_id=:T_ID';
    $statement = $database->prepare($sql);
    $statement->bindParam(':T_ID', $_SESSION['user_id']);
    $statement->execute();
    $records = $statement->fetchAll();
    $micro_counter = count($records);
    
    $sql = 'SELECT * FROM follows_data WHERE users_id=:T_ID';
    $statement = $database->prepare($sql);
    $statement->bindParam(':T_ID', $_SESSION['user_id']);
    $statement->execute();
    $records = $statement->fetchAll();
    $follow_counter = count($records);
    
    $sql = 'SELECT * FROM follows_data WHERE follows_id=:T_ID';
    $statement = $database->prepare($sql);
    $statement->bindParam(':T_ID', $_SESSION['user_id']);
    $statement->execute();
    $records = $statement->fetchAll();
    $follower_counter = count($records);
    
    ?>
        <div class="container">
            <div class="row">
                <aside class="col-xs-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php print htmlspecialchars($u_name, ENT_QUOTES, 'UTF-8'); ?></h3>
                        </div>
                        <div class="panel-body">
                            <?php if($image_url==NULL){ ?>  
                                <img class="media-object img-rounded img-responsive" src="../uploads/basic.png" alt="">
                            <?php }else{?>
                                <img class="media-object img-rounded img-responsive" src="<?php print ($image_url); ?>" alt="">
                            <?php }?>
                        </div>
                    </div>
                </aside>
                <div class="col-xs-8">
                    <ul class="nav nav-tabs nav-justified">
                        <li role="presentation" class=""><a href="userpage.php>">Microposts <span class="badge"><?php print htmlspecialchars($micro_counter, ENT_QUOTES, 'UTF-8'); ?></span></a></li>
                        <li role="presentation" class=""><a href="follow.php">Followings <span class="badge"><?php print htmlspecialchars($follow_counter, ENT_QUOTES, 'UTF-8'); ?></span></a></li>
                        <li role="presentation" class="active"><a href="follower.php">Followers <span class="badge"><?php print htmlspecialchars($follower_counter, ENT_QUOTES, 'UTF-8'); ?></span></a></li>
                    </ul>
                    <ul class="media-list">
                        <?php 
                        foreach($records as $record){
                            $link_id=$record['users_id'];
                
                            $sql = 'SELECT * FROM users_data WHERE id=:A_ID';
                            $statement = $database->prepare($sql);
                            $statement->bindParam(':A_ID', $link_id);
                            $statement->execute();
                            $instances = $statement->fetchAll();
                
                            foreach ($instances as $instance) {
                                $f_id = $instance['id'];
                                $f_u_name =$instance['user_name'];
                                $f_image_url= $instance['information'];
                        }?>
                        <li class="media">
                        <div class="media-left">
                            <?php if($f_image_url==NULL){?><img class="media-object img-rounded" src="../uploads/basic.png" width="120px" height="120px" alt=""><?php }?>
                            <img class="media-object img-rounded" src="<?php print ($f_image_url); ?>" width="120px" height="120px" alt="">
                        </div>
                        <div class="media-body">
            
                            <div><a href="/"><?php print htmlspecialchars($f_u_name, ENT_QUOTES, 'UTF-8'); ?></span></div>
                            <div><p><a href="userpage.php?id=<?=$f_id?>">View profile</a></p></div>
                        </div>
                        </li>
                        <?php               }
                        $database=NULL?>
                    </ul>
                </div>
            </div>
        </div>
        
<?php      }else{
    $sql = 'SELECT * FROM posts_data WHERE users_id=:A_ID';
    $statement = $database->prepare($sql);
    $statement->bindParam(':A_ID', $get_id);
    $statement->execute();
    $instances = $statement->fetchAll();
    $micro_counter = count($instances);
    
    $sql = 'SELECT * FROM follows_data WHERE users_id=:T_ID';
    $statement = $database->prepare($sql);
    $statement->bindParam(':T_ID', $get_id);
    $statement->execute();
    $records = $statement->fetchAll();
    $follow_counter = count($records);
    
    $sql = 'SELECT * FROM follows_data WHERE follows_id=:T_ID';
    $statement = $database->prepare($sql);
    $statement->bindParam(':T_ID', $get_id);
    $statement->execute();
    $records = $statement->fetchAll();
    $follower_counter = count($records);
    
    $sql = 'SELECT * FROM users_data WHERE id=:T_ID';
    $statement = $database->prepare($sql);
    $statement->bindParam(':T_ID', $get_id);
    $statement->execute();
    $records = $statement->fetchAll();
    foreach($records as $record){
        $u_name=$record["user_name"];
        $image_url=$record["information"];
    }
    
    $sql = 'SELECT * FROM follows_data WHERE follows_id=:T_ID';
    $statement = $database->prepare($sql);
    $statement->bindParam(':T_ID', $get_id);
    $statement->execute();
    $records = $statement->fetchAll();
?>
    <div class="container">
        <div class="row">
            <aside class="col-xs-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php print htmlspecialchars($u_name, ENT_QUOTES, 'UTF-8'); ?></h3>
                    </div>
                    <div class="panel-body">
                        <?php if($image_url==NULL){ ?>    
                            <img class="media-object img-rounded img-responsive" src="../uploads/basic.png" alt=""><?php }else{?>
                            <img class="media-object img-rounded img-responsive" src="<?php print ($image_url); ?>" alt="">
                        <?php }?>
                        <?php 
                        $flag=NULL;
                        $sql = 'SELECT * FROM follows_data WHERE users_id=:A_ID';
                        $statement = $database->prepare($sql);
                        $statement->bindParam(':A_ID', $_SESSION['user_id']);
                        $statement->execute();
                        $checks = $statement->fetchAll();
                        foreach($checks as $check){
                            $follow=$check['follows_id'];
                            if($get_id==$follow){ ?>
                                <div>
                                    <form method="POST" action="follower.php?id=<?=$get_id?>" accept-charset="UTF-8"><input name="_method" type="hidden" value="Unfollow">
                                        <input class="btn btn-danger btn-lg btn-block" type="submit" name="btn_unfollow" value="Unfollow">
                                        <input type="hidden" name="unfollow_post" value="<?php print($get_id);?>"/>
                                    </form>
                                </div>
                            <?php   $flag="complete";
                            } 
                        } 
                        if($flag==NULL){ ?>
                            <div>
                                <form method="POST" action="follower.php?id=<?=$get_id?>" accept-charset="UTF-8"><input name="_method" type="hidden" value="Follow">
                                    <input class="btn btn-primary btn-lg btn-block" type="submit" name="btn_follow" value="Follow">
                                    <input type="hidden" name="follow_post" value="<?php print($get_id);?>"/>
                                </form>
                            </div>
                <?php   } ?>
                    </div>
                </div>
            </aside>
                <div class="col-xs-8">
                    <ul class="nav nav-tabs nav-justified">
                        <li role="presentation" class=""><a href="userpage.php?id=<?=$get_id?>">Microposts <span class="badge"><?php print htmlspecialchars($micro_counter, ENT_QUOTES, 'UTF-8'); ?></span></a></li>
                        <li role="presentation" class=""><a href="follow.php?id=<?=$get_id?>">Followings <span class="badge"><?php print htmlspecialchars($follow_counter, ENT_QUOTES, 'UTF-8'); ?></span></a></li>
                        <li role="presentation" class="active"><a href="follower.php?id=<?=$get_id?>">Followers <span class="badge"><?php print htmlspecialchars($follower_counter, ENT_QUOTES, 'UTF-8'); ?></span></a></li>
                    </ul>
                    <ul class="media-list">
                        <?php 
                        foreach($records as $record){
                            $link_id=$record['users_id'];
                
                            $sql = 'SELECT * FROM users_data WHERE id=:A_ID';
                            $statement = $database->prepare($sql);
                            $statement->bindParam(':A_ID', $link_id);
                            $statement->execute();
                            $instances = $statement->fetchAll();
                
                            foreach ($instances as $instance) {
                                $f_id = $instance['id'];
                                $f_u_name =$instance['user_name'];
                                $f_image_url= $instance['information'];
                        }?>
                        <li class="media">
                        <div class="media-left">
                            <?php if($f_image_url==NULL){?><img class="media-object img-rounded" src="../uploads/basic.png" width="120px" height="120px" alt=""><?php }?>
                            <img class="media-object img-rounded" src="<?php print ($f_image_url); ?>" width="120px" height="120px" alt="">
                        </div>
                        <div class="media-body">
                            <div><a href="/"><?php print htmlspecialchars($f_u_name, ENT_QUOTES, 'UTF-8'); ?></span></div>
                            <div><p><a href="userpage.php?id=<?=$f_id?>">View profile</a></p></div>
                        </div>
                        </li>
                        <?php               }
                        $database=NULL?>
                    </ul>
                </div>
            </div>
        </div>
    <?php } ?>
    </body>
</html>