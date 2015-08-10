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
        <link href="css/starrating.css" rel="stylesheet" type="text/css" media="screen" />
        <script type="text/javascript">
            $(document).ready(function () {
                $('#ratelinks li a').click(function () {
                    var v = $(this).text();
                    var arr = v.split(",");
                    $.ajax({
                        type: "GET",
                        url: "rating.php",
                        data: "rating=" + arr[0] + "&seller=" + arr[1] + "&user=" + arr[2],
                        success: function (result) {
                            $("#ratelinks").remove();
                            // get rating after click                                                        
                            location.reload();
                        },
                        error: function (result) {
                            alert("some error occured, please try again later");
                        }
                    });

                });
            });
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
                        <?php
                        if ($_SESSION['user'] == "") {
                            echo '<a href="" data-target="#login" data-toggle="modal" type="button" ><i class="glyphicon glyphicon-log-in"></i>  <h4 style="display: inline;" class="text-sign">Sign In</h4> </a>';
                        }
                        ?>
                    </div>                                                                                                                                      
                </div>
                <div class="col-md-2">
                    <div class="navbar-link text-left" style="margin-top: 10px;">
                        <?php
                        $id = $_GET['tournament_id'];
                        $type = $_GET['type'];
                        if ($_SESSION['user'] != "") {
                            echo ' <a href="logout.php"><i class="glyphicon glyphicon-log-out"></i>  <h4 style="display: inline;" class="text-sign">Logout</h4> </a>';
                        } else {
                            echo '<a href="" data-target="#signup" data-toggle="modal" type="button"><i class="glyphicon glyphicon-download-alt"></i>  <h4 style="display: inline;" class="text-sign">Register</h4> </a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
            if ($_SESSION['user'] != "") {
                $link = "profile.php";
                if ($_SESSION['type'] == "admin") {
                    $link = "admin.php";
                }
                echo '
			<a href="buy.php" style="display: inline;float: right;margin-right: 30px;margin-top: 35px;" class="text-sign"><i class="glyphicon glyphicon-shopping-cart"></i></a>
			<a href="' . $link . '" style="display: inline;float: right;margin-right: 30px;margin-top: 35px;" class="text-sign"><i class="glyphicon glyphicon-user"></i>  ' . $_SESSION['user'] . ' ( ' . $_SESSION['type'] . ' )' . '</a>';
            }
            ?>
        </div>

        <!-- Navbar -->
        <nav class="navbar navbar-default navbar-static-top " id="stickyNav">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle collapsed menu-nav" data-toggle="collapse" data-target="#topNav" >
                        MENU
                    </button> 
                    <a href="<?php
                    if ($_SESSION['user'] != "") {
                        echo "member.php";
                    } else {
                        echo "index.php";
                    }
                    ?>" class="navbar-brand">         
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
                    <div class="container">
                        <?php

                        class Detail extends dbConnection {

                            public function __construct() {
                                parent::__construct();
                            }

                        }

                        if ($id != "") {
                            $db = new Detail();
                            $sql = "select * from tournament where tournament_id='" . $id . "'";
                            $rs = mysqli_query($db->getLink(), $sql);
                            $data = mysqli_fetch_array($rs);
                            echo "<h1 class='text-center'>" . $data['tournament_name'] . "</h1>";
                            echo "<hr/>";
                            echo "<img style='width:70%;margin: auto;' class='img-responsive' style='width: 100%' src='" . $data['tournament_img'] . "'>";
                            echo "<h5 style='margin-left:10px;font-size:1.2em' >รายละเอียด </h5>";
                            echo "<hr/>";
                            echo "<h6 style='margin-left:10px;font-size:1.2em'>วันที่ : " . $data['tournament_start'] . "</h6>";
                            echo "<h6 style='margin-left:10px;width:80%;font-size:1.2em' >เวลา : " . $data['tournament_time'] . " น.</h6>";
                            echo "<h6 style='margin-left:10px;width:80%;font-size:1.2em' >สถานที่ : " . $data['tournament_location'] . "</h6>";
                            echo "<hr/><h6 class='text-center' style='margin-left:10px;font-size:1.2em' >" . $data['tournament_detail'] . "</h6>";
                            //echo "<button class='btn btn-primary' style='min-width:80px;height:40px;font-weight: bold;margin-bottom:10px' >BUY (300 Bath.)</button>";
                        } else {
                            echo "<h1 class='text-center'>ไม่พบข้อมูลนะจ๊ะ</h1>";
                        }
                        echo "<hr/>";
                        ?> 
                        <div class='col-md-6 col-md-offset-3 col-lg-offset-3 col-lg-6 col-xs-12 col-sm-12'>
                            <div class='panel panel-info'>                                
                                <div class='panel-heading'>
                                    <i class='glyphicon glyphicon glyphicon-list-alt'></i><span> Available Sellers</span>
                                </div>
                                <table class='table table-hover table-responsive'>
                                    <thead>
                                        <tr class='success'>
                                            <th class='text-center table-bordered'>Seller name</th>
                                            <th class='text-center table-bordered'>Rate</th>
                                            <th class='text-center'>Price</th>
                                            <th class='text-center'>Type</th>
                                        </tr>
                                    </thead>
                                    <tbody class='text-center'>
                                        <?php

                                        class GetSeller extends dbConnection {

                                            public function __construct() {
                                                parent::__construct();
                                            }

                                        }

                                        $db = new GetSeller();
                                        $sql = "select firstname,lastname,seat,user.user_id from ticket_seller,user ";
                                        $sql .= "where ticket_seller.tournament_id = $id and user.user_id = ticket_seller.user_id";
                                        $rs = mysqli_query($db->getLink(), $sql);
                                        while ($row = mysqli_fetch_array($rs)) {
                                            echo "<tr>";
                                            echo "<td style='width:120px' class='row-tournament'>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
                                            echo "<td style='width:130px' class='row-tournament'>";

                                            $rating = "SELECT (SUM(value)/COUNT(value)) as sum from rating where seller_id=" . $row['user_id'];
                                            $rsRating = mysqli_query($db->getLink(), $rating);
                                            $ratingRow = mysqli_fetch_assoc($rsRating);
                                            $star = $ratingRow['sum'] * 2 * 10;
                                            ?>
                                        <ul class='star-rating ' >                                            
                                            <li class="current-rating" id="current-rating" style="width: <?php echo "$star%"; ?>"></li>
                                            <span id="ratelinks" >
                                                <li><a id="one" title="1 star out of 5" class="one-star">1,<?php echo $row['user_id'] . "," . $_SESSION['id']; ?></a></li>
                                                <li><a id="two" title="2 stars out of 5" class="two-stars">2,<?php echo $row['user_id'] . "," . $_SESSION['id']; ?></a></li>
                                                <li><a id="three"  title="3 stars out of 5" class="three-stars">3,<?php echo $row['user_id'] . "," . $_SESSION['id']; ?></a></li>
                                                <li><a id="four"  title="4 stars out of 5" class="four-stars">4,<?php echo $row['user_id'] . "," . $_SESSION['id']; ?></a></li>
                                                <li><a id="five" title="5 stars out of 5" class="five-stars">5,<?php echo $row['user_id'] . "," . $_SESSION['id']; ?></a></li>
                                            </span>
                                        </ul>
                                        <?php
                                        echo "</td>";
                                        $seat = $row['seat'];
                                        echo "<td class='row-tournament'>";
                                        if ($row['seat'] == "front") {
                                            echo "300";
                                        } else if ($row['seat'] == "mid") {
                                            echo '150';
                                        } else if ($row['seat'] == "rear") {
                                            echo "100";
                                        }
                                        echo '</td>';
                                        echo "<td class='row-tournament form-inline'>";
                                        echo $row['seat'];
                                        if ($_SESSION['user'] != "") {
                                            echo "<a style='margin-left:10px' class='form-control btn btn-success' href='AddCart.php?id={$id}&type=$seat'>BUY</a>";
                                        }
                                        echo '</td>';
                                        echo "</tr>";
                                    }
                                    ?>

                                    <?php

                                    class FetchComing extends dbConnection {

                                        public function __construct() {
                                            parent::__construct();
                                        }

                                    }

                                    $db = new FetchComing();
                                    $sql = "SELECT * FROM ticket WHERE tournament_id = {$id}";
                                    $rs = mysqli_query($db->getLink(), $sql);
                                    while ($data = mysqli_fetch_array($rs)) {

                                        echo "<tr>";
                                        echo "<td class='row-tournament'>" . $data['username'] . "</td>";
                                        echo "<td class='row-tournament'>" . $data['price'] . "</td>";
                                        echo "<td class='row-tournament form-inline'><div class='well-sm'>" . $data['seat'] . " ";
                                        if ($_SESSION['user'] != "") {
                                            echo "<a class='form-control btn btn-success' href='AddCart.php?id={$id}&type=seller&ticket={$data['ticket_id']}'>BUY</a>";
                                        }

                                        echo "</div></td></tr>";
                                    }
                                    $sql = "SELECT * FROM tournament WHERE tournament_id = {$id}";
                                    $rs = mysqli_query($db->getLink(), $sql);
                                    $data = mysqli_fetch_array($rs);
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end availble seller -->
                        <div class='col-md-6 col-md-offset-3 col-lg-offset-3 col-lg-6 col-xs-12 col-sm-12' style=""> <!-- company seller-->
                            <div class='panel panel-info'>
                                <div class='panel-heading'>
                                    <i class='glyphicon glyphicon glyphicon-list-alt'></i><span> Company Ticket Shop</span>
                                </div>
                                <table class='table table-hover table-responsive'>
                                    <thead>
                                        <tr class='success'>
                                            <th class='text-center'>Price</th>
                                            <th class='text-center'>Type</th>
                                        </tr>
                                    </thead>
                                    <tbody class='text-center'>
                                        <tr>
                                            <td class='row-tournament'><?php echo $data['front_price'] . ' บาท.'; ?></td>
                                            <td class="row-tournament form-inline">
                                                <div class="well-sm">front

                                                    <?php
                                                    if ($_SESSION['user'] != "") {
                                                        echo "<a class='form-control btn btn-success' href='AddCart.php?id={$id}&type=front'>BUY</a>";
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class='row-tournament' id="price"><?php echo $data['mid_price'] . ' บาท.'; ?></td>
                                            <td class='row-tournament form-inline'>
                                                <div class="well-sm">mid


                                                    <?php
                                                    if ($_SESSION['user'] != "") {
                                                        echo "<a class='form-control btn btn-success' href='AddCart.php?id={$id}&type=mid'>BUY</a>";
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class='row-tournament' id="price"><?php echo $data['rear_price'] . ' บาท.'; ?></td>
                                            <td class='row-tournament form-inline'>
                                                <div class="well-sm">rear

                                                    <?php
                                                    if ($_SESSION['user'] != "") {
                                                        echo "<a class='form-control btn btn-success' href='AddCart.php?id={$id}&type=rear'>BUY</a>";
                                                    }
                                                    ?>

                                                </div>
                                            </td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include './components/footer.php';
        ?>

    </body>
</html>