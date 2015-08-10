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
        <script type="text/javascript">
            var dataPro = "";
            $(function () {
                $('#form-signup').submit(function () {
                    var data = $('#user, #pass, #first, #last , #email, #address, #dis, #province:selected, #code, #birth, #phone').serializeArray();// send json
                    $.ajax({
                        url: "./ajax/signup.php",
                        type: 'POST',
                        data: data,
                        success: function (result) {
                            console.log(result);
                            // alert(result);
                            if (result == "success") {
                                alert("Sign Up Success");
                                $('#btn-close').click();
                            } else {
                                alert(result);
                            }
                        },
                        error: function () {
                            //                            
                            alert("Sign Up Error");
                        },
                    });
                    return false;
                });//end sign up  



            });
            $(function () {
                $('#province').change(function () {
                    var proid = $('#province').val();
                    if (proid != "-- select province --") {
                        $.ajax({
                            url: "./ajax/getDistrict.php",
                            type: 'POST',
                            data: {id: proid},
                            dataType: 'html',
                            success: function (result) {
                                $('#dis').append().html(result);
                            }
                        });
                    } else {
                        //$('#dis').empty();
                        $('#dis').html("<option>-- select district --</option>");
                    }
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#form-login').submit(function () {
                    var html = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>รหัสผ่านผิด</strong> กรุณากรอก username และ password</div>";
                    var data = $('#user-login, #pass-login').serializeArray();// send json
                    $.ajax({
                        url: "ajax/login.php",
                        type: 'POST',
                        data: data,
                        success: function (result) {
                            if (result == "success") {
                                window.location.href = "member.php";
                            } else if (result == "error") {
                                //alert(result);
                                $('#modal-form').prepend(html);
                                $('#user-login').val("");
                                $('#pass-login').val("");
                                window.setTimeout(removeAlert, 3000);
                            }
                            console.log(result);
                        }
                    });
                    event.preventDefault();
                });

                $('#clear').click(function () {
                    $('#user-login').val("");
                    $('#pass-login').val("");
                    event.preventDefault();
                });

                function removeAlert() {
                    $('.alert').remove();
                }
                ;
            });
        </script>
    </head>
    <body>
       <?php
        if ($_SESSION['type'] == "admin") {
            ?>
            <script type="text/javascript">                
                window.location.href = "member.php";
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
                        <?php
                        if ($_SESSION['user'] == "") {
                            echo '<a href="" data-target="#login" data-toggle="modal" type="button" ><i class="glyphicon glyphicon-log-in"></i>  <h4 style="display: inline;" class="text-sign">Login</h4> </a>                         ';
                        }
                        ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="navbar-link text-left" style="margin-top: 10px;">
                        <?php
                        if ($_SESSION['user'] == "") {
                            echo '<a href="" data-target="#signup" data-toggle="modal" type="button"><i class="glyphicon glyphicon-download-alt"></i>  <h4 style="display: inline;" class="text-sign">Register</h4> </a>';
                        } else {
                            echo ' <a href="logout.php"><i class="glyphicon glyphicon-log-out"></i>  <h4 style="display: inline;" class="text-sign">Logout</h4> </a>';
                        }
                        ?>

                    </div>
                </div>
            </div>
            <?php
            if ($_SESSION['user'] != "") {
                echo '<h4 style="display: inline;float: right;margin-right: 30px;margin-top: 35px;" class="text-sign"><i class="glyphicon glyphicon-user"></i>' . ' ' . $_SESSION['user'] . '</h4>';
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
                    <a href="index.php" class="navbar-brand">         
                        <h4 class="visible-xs visible-sm" style="margin-top: 0px">BADMINTION TICKET</h4>     
                    </a>
                </div>

                <div id="topNav" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left text-center" > 
                        <li class="active"><a href="index.php" class="menu-nav">HOME</a>
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
                        <li class="visible-xs"><a data-target="#login" data-toggle="modal" href="#" class="menu-nav">SIGN IN</a>

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
                                    // echo "<tr><td>" . $data['tournament_name'] . "</td><td>" . $data['tournament_start'] . "</td></tr>";
                                    echo "<tr><td class='row-tournament'>" . $data['tournament_name'] . "</td><td> <a class='btn btn-link' href='detail_tournaments.php?tournament_id=" . $id . "&type=visitor'>view</a></td></tr>";
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div> <!-- Coming -->

                <!-- TOURNAMENT -->
                <div class="col-md-6 col-lg-6 col-xs-12 margin-top-nav" >
                    <div class="thumbnail">
                        <div id="carousel-id" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-id" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-id" data-slide-to="1" class=""></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="img-responsive" style="width: 100%" src="images/carousel_01.jpg">

                                </div>
                                <div class="item">
                                    <img class="img-responsive" style="width: 100%" src="images/carousel_03.jpg">

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
            </div> 
            <!--        modal sign in-->
            <div class="container" >
                <div id="login" class="modal fade" role="dialog" aria-hidden="true" aria-labelledby="login-content">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3 id="login-content"> Login to BADMINTON TICKET</h3>
                            </div>
                            <div class="modal-body" id="modal-form">

                                <form class="form" role="form" id="form-login"  method="post">
                                    <div class="form-group">
                                        <label for="user">Username</label>
                                        <input type="text" class="form-control" id="user-login" name="username-login" placeholder="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="pass">Password</label>
                                        <input id="pass-login" class="form-control" type="password" name="password-login" placeholder="password">
                                    </div>
                                    <div class="form-group">
                                        <a href="forgot.php" class="btn btn-link">Forgot Password</a>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-success" type="submit" id="login-form">
                                            Submit
                                        </button>
                                        <button class="btn  btn-danger" id="clear">
                                            Clear
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!--modal register-->
            <div class="container" >
                <div id="signup" class="modal fade" role="dialog" aria-hidden="true" aria-labelledby="login-content">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3 id="login-content" > Register to BADMINTON TICKET</h3>
                            </div>

                            <div class="modal-body">
                                <!-- Sign Up Form -->
                                <form id="form-signup" action="" class="form" role="form"  method="post">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-sm">
                                            <label for="user">Username</label>
                                            <input type="text" class="form-control" name="username" id="user" placeholder="username" required>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-sm ">
                                            <label for="pass">Password</label>
                                            <input id="pass" class="form-control" name="password" type="password" placeholder="password" required>
                                        </div> 
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-group-sm">
                                            <label for="first">First Name</label>
                                            <input type="text" class="form-control" name="fname" id="first" placeholder="first name" required>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-sm ">
                                            <label for="last">Last Name</label>
                                            <input type="text" name="lname" class="form-control" id="last" placeholder="last name" required> 
                                        </div> 
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-group-sm">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" name="email" id="email" placeholder="emial" required>
                                        </div> 
                                    </div>                                                                  

                                    <div class="col-md-6">
                                        <div class="form-group form-group-sm">
                                            <label for="address">Address</label>
                                            <textarea type="text" cols="3" rows="10" name="address" class="form-control" id="address" 
                                                      placeholder="address" required></textarea>
                                        </div> 
                                    </div><div class="col-md-6">
                                        <div class="form-group form-group-sm">
                                            <label for="province">Province</label>
                                            <select id="province" name="province" class="form-control" required>
                                                <option>-- select province --</option>
                                                <?php

                                                class FetchProvince extends dbConnection {

                                                    public function conn() {
                                                        parent::__construct();
                                                    }

                                                }

                                                $db = new FetchProvince();
                                                $sql = "select PROVINCE_ID , PROVINCE_NAME from province";
                                                $rs = mysqli_query($db->getLink(), $sql);
                                                while ($row = mysqli_fetch_array($rs)) {
                                                    echo "<option value='" . $row['PROVINCE_ID'] . "'>" . $row['PROVINCE_NAME'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-sm ">
                                            <label for="dis">District</label>
                                            <select id="dis" name="district" class="form-control" required>
                                                <option>-- select district --</option>                                                                                      
                                            </select>
                                        </div> 
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-group-sm">
                                            <label for="birth">BirthDay</label>
                                            <input type="date" class="form-control" id="birth" name="birthday" placeholder="birthday" required>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-sm ">
                                            <label for="phone">Phone Number</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="phone" required>
                                        </div> 
                                    </div>                                
                                    <div class="modal-footer">
                                        <button class="btn btn-success" type="submit" name="submit">
                                            Submit
                                        </button>
                                        <button class="btn  btn-danger" id="btn-close" data-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--        </div> end modal -->

            <?php
            include './components/footer.php';
            ?>

    </body>
</html>