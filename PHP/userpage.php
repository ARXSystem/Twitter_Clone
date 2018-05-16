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
        <aside class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">asdf</h3>
                </div>
                <div class="panel-body">
                    <img class="media-object img-rounded img-responsive" src="https://secure.gravatar.com/avatar/2fb65c9a2d8e5f874c4f31d25d819665?s=500&amp;r=g&amp;d=identicon" alt="">
                </div>
                            </div>
        </aside>
        <div class="col-xs-8">
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="active"><a href="http://laravel-microposts.herokuapp.com/users/435">Microposts <span class="badge">1</span></a></li>
                <li role="presentation" class=""><a href="http://laravel-microposts.herokuapp.com/users/435/followings">Followings <span class="badge">0</span></a></li>
                <li role="presentation" class=""><a href="http://laravel-microposts.herokuapp.com/users/435/followers">Followers <span class="badge">0</span></a></li>
            </ul>
                            <ul class="media-list">
        <li class="media">
        <div class="media-left">
            <img class="media-object img-rounded" src="https://secure.gravatar.com/avatar/2fb65c9a2d8e5f874c4f31d25d819665?s=50&amp;r=g&amp;d=identicon" alt="">
        </div>
        <div class="media-body">
            <div>
                <a href="http://laravel-microposts.herokuapp.com/users/435">asdf</a> <span class="text-muted">posted at 2018-05-16 14:33:06</span>
            </div>
            <div>
                <p>asdf</p>
            </div>
            <div>
                                    <form method="POST" action="http://laravel-microposts.herokuapp.com/microposts/774" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="hW7ZGkuYzvemGTXnZXYg5ZLQbzCqBHL6QWxn2jha">
                        <input class="btn btn-danger btn-xs" type="submit" value="Delete">
                    </form>
                            </div>
        </div>
    </li>
</ul>

                    </div>
    </div>
        </div>
    </body>
</html>