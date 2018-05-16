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
                                            <li><a href="http://laravel-microposts.herokuapp.com/users">Users</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">asdf <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="http://laravel-microposts.herokuapp.com/users/435">My profile</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="http://laravel-microposts.herokuapp.com/logout">Logout</a></li>
                            </ul>
                        </li>
                                    </ul>
            </div>
        </div>
    </nav>
</header>        
        <div class="container">
                        
                                <div class="row">
            <aside class="col-md-4">
                <form method="POST" action="http://laravel-microposts.herokuapp.com/microposts" accept-charset="UTF-8"><input name="_token" type="hidden" value="hW7ZGkuYzvemGTXnZXYg5ZLQbzCqBHL6QWxn2jha">
                    <div class="form-group">
                        <textarea class="form-control" rows="5" name="content" cols="50"></textarea>
                    </div>
                    <input class="btn btn-primary btn-block" type="submit" value="Post">
                </form>
            </aside>
            <div class="col-xs-8">
                            </div>
        </div>
            </div>
    </body>
</html>
