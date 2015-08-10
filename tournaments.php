<?php
include_once './config/config.php';
?>
<!DOCTYPE html>
<html >
    <head>
        <title>Badminton Ticket</title>
        <meta http-equiv="Content-Language" content="th">        
        <meta http-equiv="Content-Type" content="text/html; charset=Windows-874">    
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">    
        <meta http-equiv="content-Type" content="text/html; charset=tis-620"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <script type="text/javascript" src="js/jquery-2.1.3.js"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/bootflat.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/font-awesome.css">
        <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <script src="js/jquery.blockUI.js" type="text/javascript"></script>
        <script type="text/javascript">

        </script>
    </head>
    <body>
        <!-- Header -->
        <div style="height: 100px;" class="hidden-sm hidden-xs">
            <div class="row">
                <div class="col-md-6"> 
                    <a href="index.php" class="navbar-brand" style="margin: -10px 0px 0px 10px;">
                        <h2 class="hidden-xs hidden-sm hidden-md">BADMINTION TICKET</h2>
                        <h6 class="visible-xs visible-sm" style="">BADMINTION TICKET</h6>                        
                    </a>
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-2">
                    <div class="navbar-link text-right" style="margin-top: 10px;">
                        <a href="" data-target="#login" data-toggle="modal" type="button" ><i class="glyphicon glyphicon-log-in"></i>  <h4 style="display: inline;" class="text-sign">Sign In</h4> </a>                         
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="navbar-link text-left" style="margin-top: 10px;">
                        <a href="" data-target="#signup" data-toggle="modal" type="button"><i class="glyphicon glyphicon-download-alt"></i>  <h4 style="display: inline;" class="text-sign">Register</h4> </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar -->
        <nav class="navbar navbar-default navbar-static-top " id="stickyNav">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle collapsed menu-nav" data-toggle="collapse" data-target="#topNav" >
                        MENU
                    </button> 
                    <a href="index.php" class="navbar-brand">         
                        <h4 class="visible-xs visible-sm" style="margin-top: 0px">BADMINTION TICKET</h4>     
                    </a>
                </div>

                <div id="topNav" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left text-center" > 
                        <li class=""><a href="index.php" class="menu-nav">HOME</a>
                        </li>
                        <li><a class="dropdown-toggle menu-nav" data-toggle="dropdown" href="#">TOURNAMENT<span class="caret"></span></a>
                            <ul class="dropdown-menu"> 
                                <li><a href="#" class="menu-nav"> Intestine Tournament </a></li>
                                <li><a href="#" class="menu-nav"> National Tournament </a></li>                                                            
                            </ul>
                        </li>
                        <li><a href="#" class="menu-nav">SALE</a>
                        </li>
                        <li><a href="#" class="dropdown-toggle menu-nav" data-toggle="dropdown">CUSTOMER CARE <span class="caret"></span></a>
                            <ul class="dropdown-menu"> 
                                <li><a href="#" class="menu-nav"> Help Center </a></li>
                                <li><a href="#" class="menu-nav"> Orders & Payments </a></li>
                                <li><a href="#"class="menu-nav"> Returns & Refunds </a></li>                                
                            </ul>
                        </li>
                        <li><a href="#" class="menu-nav">SUPPORT</a>
                        </li>
                        <li><a href="#" class="menu-nav">CONTACT US</a>
                        </li>
                        <li class="visible-xs"><a data-target="#login" data-toggle="modal" href="#" class="menu-nav">SIGN IN</a>

                    </ul>
                </div>
            </div>
        </nav>

        <div class="intro-content" >
            <div class="container">
                <div class="jumbotron">
                    <div class="jumbotron-contents">
                        <h1 class="text-center" style="text-decoration: underline">Tournaments</h1>
                    </div>
                </div>
            </div>

        </div>

        <?php
        include './components/footer.php';
        ?>

    </body>
</html>