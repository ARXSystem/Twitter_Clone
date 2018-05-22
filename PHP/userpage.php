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
    $statement = null;
    
    if ($_POST['submit_img']) {
        $file_name = $_FILES['add_img']['name'];
        $image_path = '../uploads/' . $file_name;
        move_uploaded_file($_FILES['add_img']['tmp_name'], $image_path);
        
        $sql = 'UPDATE users_data SET information=:add_img WHERE id=:T_ID';
        $statement = $database->prepare($sql);
        $statement->bindParam(':add_img', $image_path);
        $statement->bindParam(':T_ID', $_SESSION['user_id']);
        $statement->execute();
        $statement = null;
    }
    
    if ($_POST['btn_del']) {
        $sql = 'DELETE FROM posts_data WHERE id=:del_post';
        $statement = $database->prepare($sql);
        $statement->bindParam(':del_post', $_POST['del_post']);
        $statement->execute();
        $statement = null;
    }
    
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
    ?>
        <div class="container">
                        
                <div class="row">
        <aside class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php print htmlspecialchars($u_name, ENT_QUOTES, 'UTF-8'); ?></h3>
                </div>
                <div class="panel-body">
                    <?php if($image_url==NULL){
                    ?>    <img class="media-object img-rounded img-responsive" src="../uploads/basic.png" alt=""><?php }else{?>
                    <img class="media-object img-rounded img-responsive" src="<?php print ($image_url); ?>" alt="">
                    <?php } ?>
                    <form action="userpage.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name="add_img">
                        <input type="submit" name="submit_img" value="Uploads"/>
                    </form>
                </div>
                            </div>
        </aside>
        <div class="col-xs-8">
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="active"><a href="userpage.php">Microposts <span class="badge"><?php print htmlspecialchars($micro_counter, ENT_QUOTES, 'UTF-8'); ?></span></a></li>
                <li role="presentation" class=""><a href="follow.php">Followings <span class="badge"><?php print htmlspecialchars($follow_counter, ENT_QUOTES, 'UTF-8'); ?></span></a></li>
                <li role="presentation" class=""><a href="follower.php">Followers <span class="badge"><?php print htmlspecialchars($follower_counter, ENT_QUOTES, 'UTF-8'); ?></span></a></li>
            </ul>
                            <ul class="media-list">
        <li class="media">
        <div class="media-left">
            <?php if($image_url==NULL){?><img class="media-object img-rounded" src="../uploads/basic.png" width="120px" height="120px" alt=""><?php }?>
            <img class="media-object img-rounded" src="<?php print ($image_url); ?>" width="120px" height="120px" alt="">
        </div>
        <div class="media-body">
            <?php if($records){
                foreach ($records as $record) {
                    $posts = $record['posts'];
                    $post_time =$record['created_at'];
                    $post_id =$record['id'];
                ?>
            <div>
                <a href="userpage.php"><?php print htmlspecialchars($u_name, ENT_QUOTES, 'UTF-8'); ?></a> <span class="text-muted">posted at <?php print htmlspecialchars($post_time, ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
     
            <div>
                <p><?php print htmlspecialchars($posts, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <div>
                                    <form method="POST" action="userpage.php" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE">
                        <input class="btn btn-danger btn-xs" type="submit" name="btn_del" value="Delete">
                        <input type="hidden" name="del_post" value="<?php print($post_id);?>"/>
                    </form>
                            </div>
            <?php                }
            }?>
        </div>
    </li>
</ul>

                    </div>
    </div>
        </div>
        
<?php      }else{
    $sql = 'SELECT * FROM users_data WHERE id=:T_ID';
    $statement = $database->prepare($sql);
    $statement->bindParam(':T_ID', $get_id);
    $statement->execute();
    $instances = $statement->fetchAll();
    foreach ($instances as $instance) {
        $i_u_name =$instance['user_name'];
        $i_image_url= $instance['information'];
    }
    
    $sql = 'SELECT * FROM posts_data WHERE users_id=:A_ID';
    $statement = $database->prepare($sql);
    $statement->bindParam(':A_ID', $get_id);
    $statement->execute();
    $instances = $statement->fetchAll();
    $micro_counter = count($instances);
    
?>
        <div class="container">
                        
                <div class="row">
        <aside class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php print htmlspecialchars($i_u_name, ENT_QUOTES, 'UTF-8'); ?></h3>
                </div>
                <div class="panel-body">
                    <?php if($i_image_url==NULL){
                    ?>    <img class="media-object img-rounded img-responsive" src="../uploads/basic.png" alt=""><?php }else{?>
                    <img class="media-object img-rounded img-responsive" src="<?php print ($i_image_url); ?>" alt="">
                    <?php } ?>
                </div>
                <div>
                    <form method="POST" action="/" accept-charset="UTF-8"><input name="_method" type="hidden" value="Follow">
                        <input class="btn btn-primary btn-lg btn-block" type="submit" name="btn_follow" value="Follow">
                        <input type="hidden" name="follow_post" value="<?php print($get_id);?>"/>
                    </form>
                </div>
                <div>
                    <form method="POST" action="/" accept-charset="UTF-8"><input name="_method" type="hidden" value="Unfollow">
                        <input class="btn btn-danger btn-lg btn-block" type="submit" name="btn_unfollow" value="Unfollow">
                        <input type="hidden" name="unfollow_post" value="<?php print($get_id);?>"/>
                    </form>
                </div>
            </div>    
        </aside>
        <div class="col-xs-8">
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="active"><a href="userpage.php?id=<?=$get_id?>">Microposts <span class="badge"><?php print htmlspecialchars($micro_counter, ENT_QUOTES, 'UTF-8'); ?></span></a></li>
                <li role="presentation" class=""><a href="follow.php?id=<?=$get_id?>">Followings <span class="badge"><?php print htmlspecialchars($follow_counter, ENT_QUOTES, 'UTF-8'); ?></span></a></li>
                <li role="presentation" class=""><a href="follower.php?id=<?=$get_id?>">Followers <span class="badge"><?php print htmlspecialchars($follower_counter, ENT_QUOTES, 'UTF-8'); ?></span></a></li>
            </ul>
                            <ul class="media-list">
        <li class="media">
            <?php
            
            
            foreach ($instances as $instance) {
                    $posts = $instance['posts'];
                    $post_time =$instance['created_at'];
                    $post_id =$instance['id'];
            ?>
        <div class="media-left">
            <?php if($i_image_url==NULL){?><img class="media-object img-rounded" src="../uploads/basic.png" width="120px" height="120px" alt=""><?php }?>
            <img class="media-object img-rounded" src="<?php print ($i_image_url); ?>" width="120px" height="120px" alt="">
        </div>
        <div class="media-body">
            
            <div>
                <a href="userpage.php"><?php print htmlspecialchars($i_u_name, ENT_QUOTES, 'UTF-8'); ?></a> <span class="text-muted">posted at <?php print htmlspecialchars($post_time, ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
     
            <div>
                <p><?php print htmlspecialchars($posts, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            
        </div><br>
    <?php }    ?>
    </li><br>
</ul>

                    </div>
    </div>
        </div>

<?php } ?>
    </body>
</html>