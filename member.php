<?php
include_once './config/config.php';
session_start();
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
    </head>
    <body>
        <?php
        if ($_SESSION['user'] == "") {
            ?>
            <script type="text/javascript">
                alert("Login Please");
                window.location.href = "index.php";
            </script>
            <?php
        }
        ?>
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

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="navbar-link text-left" style="margin-top: 10px;">                           
                        <a href="logout.php"><i class="glyphicon glyphicon-log-out"></i>  <h4 style="display: inline;" class="text-sign">Logout</h4> </a>
                    </div>
                </div>                
            </div>
			
			<a href="buy.php" style="display: inline;float: right;margin-right: 30px;margin-top: 35px;" class="text-sign"><i class="glyphicon glyphicon-shopping-cart"></i></a>
			
            <a href="<?php if ($_SESSION['type'] == "admin") {
            echo "admin.php";
        } else {
            echo 'profile.php';
        } ?>" style="display: inline;float: right;margin-right: 30px;margin-top: 35px;" class="text-sign"><i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['user']; ?> (  <?php echo $_SESSION['type']; ?> ) </a>
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
                        <li class="active"><a href="member.php" class="menu-nav">HOME</a>
                        </li>
                        <li><a class="dropdown-toggle menu-nav" data-toggle="dropdown" href="#">TOURNAMENT<span class="caret"></span></a>
                            <ul class="dropdown-menu"> 
                                <li><a href="tournaments.php" class="menu-nav"> Intestine Tournament </a></li>
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
                        <?php
                        if ($_SESSION['type'] != "") {
                            echo '<li class="visible-xs"><a href="admin.php" class="menu-nav">ADMIN</a></li>';
                            echo '<li class="visible-xs"><a href="logout.php" class="menu-nav">LOGOUT</a></li>';
                        } else {
                            echo '<li class="visible-xs"><a data-target="#login" data-toggle="modal" href="#" class="menu-nav">SIGN IN</a></li>';
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </nav>

        <div class="intro-content" >
            <div class="container-fluid">               
                <!-- Coming TOURNAMENT -->
                <div class="col-md-3 col-lg-3 col-xs-12 margin-top-nav" >
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="glyphicon glyphicon glyphicon-list-alt"></i><span> Coming Tournament </span>
                        </div>
                        <table class="table table-hover table-responsive">
                            <thead>
                                <tr class="success">
                                    <th class="text-center table-bordered">TOURNAMENT</th>
                                    <th class="text-center">DETAILS</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php

                                //include_once './config/config.php';
                                class FetchComing extends dbConnection {

                                    public function __construct() {
                                        parent::__construct();
                                    }

                                }

                                date_default_timezone_set('Asia/Bangkok');
                                $db = new FetchComing();
                                $sql = "select tournament_id,tournament_name,tournament_start from tournament where tournament_start > NOW() order by tournament_start limit 5";
                                $rs = mysqli_query($db->getLink(), $sql);
                                while ($data = mysqli_fetch_array($rs)) {
                                    $id = $data['tournament_id'];
                                    echo "<tr><td class='row-tournament'>" . $data['tournament_name'] . "</td><td> <a class='btn btn-link' href='detail_tournaments.php?tournament_id=" . $id . "&type=member'>view</a></td></tr>";
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div> <!-- Coming -->

                <!-- TOURNAMENT -->
                <div class="col-md-6 col-lg-6 col-xs-12 col-xs-12 margin-top-nav" >
                    <div class="thumbnail">
                        <div id="carousel-id" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-id" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-id" data-slide-to="1" class=""></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="img-responsive" src="images/carousel_01.jpg" style="width: 100%">

                                </div>
                                <div class="item">
                                    <img class="img-responsive" src="images/carousel_03.jpg" style="width: 100%">
                                </div>
                            </div>
                        </div>
                        <div class="caption text-center">
                            <h1 style="font-family: 'Montserrat', sans-serif;">BADMINTION TICKET</h1>
                            <p style="font-family: 'Montserrat', sans-serif;">
                                " Tickets Information & Prices "
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Remember TOURNAMENT -->
                <div class="col-md-3 col-lg-3 col-xs-12 margin-top-nav">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="glyphicon glyphicon glyphicon-list-alt"></i><span> Reminders </span>
                        </div>
                        <table class="table table-hover table-responsive">
                            <thead>
                                <tr class="success">
                                    <th class="text-center table-bordered">TOURNAMENT</th>
                                    <th class="text-center">DETAILS</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php

                                //include_once './config/config.php';
                                class FetchReminders extends dbConnection {

                                    public function __construct() {
                                        parent::__construct();
                                    }

                                }

                                date_default_timezone_set('Asia/Bangkok');
                                $db = new FetchReminders();
                                $sql = "select tournament_id,tournament_name,tournament_start from tournament where tournament_start > NOW() order by tournament_start limit 5";
                                $rs = mysqli_query($db->getLink(), $sql);
                                while ($data = mysqli_fetch_array($rs)) {
                                    $id = $data['tournament_id'];
                                    echo "<tr><td class='row-tournament'>" . $data['tournament_name'] . "</td><td> <a class='btn btn-link' href='detail_tournaments.php?tournament_id=" . $id . "&type=member'>view</a></td></tr>";
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recommend  -->
                <div class="col-md-3 col-xs-12 margin-top-nav" >
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="glyphicon glyphicon glyphicon-list-alt"></i><span> Recommend</span>
                        </div>
                        <table class="table table-hover table-responsive">
                            <thead>
                                <tr class="success">
                                    <th class="text-center">TOURNAMENT</th>
                                    <th class="text-center">DETAILS</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php

                                //include_once './config/config.php';
                                class fetchdb extends dbConnection {

                                    public function conn() {
                                        parent::__construct();
                                    }

                                }

                                date_default_timezone_set('Asia/Bangkok');
                                $db = new fetchdb();
                                $sql = "select tournament_id ,tournament_name,tournament_start from tournament where tournament_start > NOW() order by tournament_recom desc limit 5";
                                $rs = mysqli_query($db->getLink(), $sql);
                                while ($data = mysqli_fetch_array($rs)) {
                                    $id = $data['tournament_id'];
                                    echo "<tr><td class='row-tournament'>" . $data['tournament_name'] .
                                    "</td><td class='row-tournament'><a href='detail_tournaments.php?tournament_id=" . $id . "&type=member'>view</a></td></tr>";
                                    //"</td><td class='row-tournament'>".$data['tournament_start']."</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div> 

<?php
include './components/footer.php';
?>

    </body>
</html>