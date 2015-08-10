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
                                var html = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>ลงเบียนสำเร็จ</strong></div>";
                                $('#form-signup').prepend(html);        
                                window.location.reload();
//                                window.setTimeout(removeAlert, 2000);
//                                $('input[type!="time"]').val("");
//                                $('#address').val("");
//                                $('#dis').html("<option>-- select district --</option>");
//                                $('#province').html("<option>-- select province --</option>");
                            } else if (result == "not match") {
                                var html = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>กรอกรหัสผ่านผิด</strong> รหัสผ่านอย่างน้อย 8 ตัวและต้องมีทั้งตัวเลขและตัวอักษร</div>";
                                $('#form-signup').prepend(html);
                                $('#pass').val("");
                                window.setTimeout(removeAlert, 2000);
                            } else if(result == "error"){
                                var html = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>username นี้ได้รับการใช้งานแล้ว</strong> กรุณาเปลี่ยน username ใหม่</div>";
                                $('#form-signup').prepend(html);
                                window.setTimeout(removeAlert, 2000);
                            }
                        }                        
                    });
                    return false;
                });//end sign up                               
            });
            function removeAlert() {
                $('.alert').remove();
            }
            ;
        </script>
    </head>
    <body>
        <?php
        if ($_SESSION['user'] != "") {
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
                        }
                        ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="navbar-link text-left" style="margin-top: 10px;">
                        <?php
                        if ($_SESSION['user'] == "") {
                            
                        } else {
                            echo ' <a href="logout.php"><i class="glyphicon glyphicon-log-out"></i>  <h4 style="display: inline;" class="text-sign">Logout</h4> </a>';
                        }
                        ?>

                    </div>
                </div>
            </div>
            <?php
            if ($_SESSION['user'] != "") {
                echo '<a href="profile.php" style="display: inline;float: right;margin-right: 30px;margin-top: 35px;" class="text-sign"><i class="glyphicon glyphicon-user"></i>' . ' ' . $_SESSION['user'] . '  ( ' . $_SESSION['type'] . ' )</a>';
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
                        <?php
                        if ($_SESSION['user'] != "") {
                            echo '<li class="visible-xs"><a href="logout.php" data-toggle="modal" class="menu-nav">LOGOUT</a></li>';
                        } else {
                            echo '<li class="visible-xs"><a data-target="#login" data-toggle="modal" href="#" class="menu-nav">SIGN IN</a></li>';
                        }
                        ?>


                    </ul>
                </div>
            </div>
        </nav>

        <div class="intro-content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-success" style="margin-top: 30px;">
                    <div class="panel-heading">
                        <h1 class="panel-title">Register</h1>
                    </div>
                    <div class="panel-body">
                        <form id="form-signup" action="" class="form" role="form"  method="post">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user">Username</label>
                                    <input type="text" class="form-control" name="username" id="user" placeholder="username" required>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pass">Password</label>
                                    <input id="pass" class="form-control" name="password" type="password" placeholder="password" required>
                                </div> 
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first">First Name</label>
                                    <input type="text" class="form-control" name="fname" id="first" placeholder="first name" required>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="last">Last Name</label>
                                    <input type="text" name="lname" class="form-control" id="last" placeholder="last name" required> 
                                </div> 
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="emial" required>
                                </div> 
                            </div>                                                                  

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea type="text" cols="3" rows="2" name="address" class="form-control" id="address" 
                                              placeholder="address" required></textarea>
                                </div> 
                            </div><div class="col-md-6">
                                <div class="form-group">
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
                                <div class="form-group">
                                    <label for="dis">District</label>
                                    <select id="dis" name="district" class="form-control" required>
                                        <option>-- select district --</option>                                                                                      
                                    </select>
                                </div> 
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
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

                            <button class="btn btn-success" type="submit" name="submit">
                                Submit
                            </button>
                            <button class="btn  btn-danger" id="btn-close" data-dismiss="modal">
                                Close
                            </button>

                        </form>          
                    </div>
                </div>
            </div>


            <!--        </div> end modal -->
        </div>
        <?php
        include './components/footer.php';
        ?>

    </body>
</html>