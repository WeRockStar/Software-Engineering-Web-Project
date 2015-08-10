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
                $('#form-add').submit(function () {
                    var data = $("#t-name , #t-date , #t-location , #t-time, #t-detail, #t-img, #t-front, #t-mid, #t-rear").serializeArray();
                    $.ajax({
                        url: "./ajax/addtournament.php",
                        data: data,
                        type: 'POST',
                        success: function (result) {
                            var htmlSuccues = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>เพิ่มข้อมูลสำเร็จ</strong> รีเฟชรเพื่อแสดง</div>";
                            var htmlWarning = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>เพิ่มข้อมูลไม่สำเร็จ</strong> กรุณาลองใหม่ลอีกครั้ง</div>";
                            if (result == "success") {
                                $('#alert-add').prepend(htmlSuccues);
                                $('#t-name').val("");
                                $('#t-location').val("");
                                $('#t-date').val("");
                                $('#t-time').val("");
                                $('#t-detail').val("");
                                $('#t-img').val("");
                                $('#t-front').val("");
                                $('#t-mid').val("");
                                $('#t-rear').val("");
                                setInterval(location.reload(), 3000);

                                //location.reload();
                            } else if (result == "error") {
                                $('#alert-add').prepend(htmlWarning);
                            }

                        }
                    });
                    return false;
                });
            });
        </script>
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
        </script>
        <script type="text/javascript">
            $(function () {
                $('#form-signup').submit(function () {
                    var data = $('#user, #pass, #first,#status ,  #last , #email, #address, #dis, #province:selected, #code, #birth, #phone').serializeArray();// send json
                    $.ajax({
                        url: "./ajax/admin-adduser.php",
                        type: 'POST',
                        data: data,
                        success: function (result) {
                            console.log(result);
                            // alert(result);
                            if (result == "success") {
                                var html = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>ลงเบียนสำเร็จ</strong></div>";
                                $('#form-signup').prepend(html);
                                $('input').each(function () {
                                    $(this).val("");
                                });
                                $('#dis').html("<option>-- select district --</option>");
                                $('#province').html("<option>-- select province --</option>");
                                $('#address').val("");
                                window.setTimeout(removeAlert, 3000);
                                location.reload();
                            } else if (result == "not match") {
                                var html = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>กรอกรหัสผ่านผิด</strong> รหัสผ่านอย่างน้อย 8 ตัวและต้องมีทั้งตัวเลขและตัวอักษร</div>";
                                $('#form-signup').prepend(html);
                                $('#pass').val("");
                                window.setTimeout(removeAlert, 3000);
                            } else if (result == "error") {
                                var html = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>username นี้ได้รับการใช้งานแล้ว</strong> กรุณาเปลี่ยน username ใหม่</div>";
                                $('#form-signup').prepend(html);
                                window.setTimeout(removeAlert, 3000);
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
        if ($_SESSION['type'] != "admin") {
            ?>
            <script type="text/javascript">
                //alert("For Admin Only");
                window.location.href = "index.php";
            </script>
            <?php
        }
        ?>
        <!-- Header -->

        <div style="height: 80px;" class="hidden-sm hidden-xs">
            <div class="row">
                <div class="col-md-6"> 
                    <a href="member.php" class="navbar-brand" style="margin: -10px 0px 0px 10px;">
                        <h2 class="hidden-xs hidden-sm hidden-md">Administration Management </h2>
                        <h6 class="visible-xs visible-sm" style="">Administration Management </h6>                        
                    </a>
                </div>                
            </div>                              
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-default navbar-static-top " id="stickyNav">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed menu-nav" data-toggle="collapse" data-target="#topNav" >
                MENU
            </button> 
            <a href="index.php" class="navbar-brand">         
                <h4 class="visible-xs visible-sm" style="margin-top: 0px">Administration Management</h4>     
            </a>
        </div>
        <div id="topNav" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left text-center" > 
                <li class=""><a href="member.php" class="menu-nav">HOME</a>
                </li>
                <li class=""><a href="admin.php" class="menu-nav">MANAGEMENT EVENTS</a>
                </li>
                <li class="active"><a class="menu-nav" href="admin-user.php">MANAGEMENT USER</a>
                </li>                
            </ul>
        </div>
    </nav>

    <div class="intro-content" >          
        <div class="container">
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" style="margin-top: 30px">
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <i class="glyphicon glyphicon glyphicon-list-alt"></i><span> Add User </span>
                    </div>
                    <div class="panel panel-success">                       
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
                                <div class="col-md-12">
                                    <div class="form-group form-group-sm ">
                                        <label for="status">Status</label>
                                        <select id="status" class="form-control" name="status">
                                            <option>admin</option>
                                            <option>seller</option>
                                            <option>member</option>
                                        </select>
                                    </div> 
                                </div>  
                                <div class="col-md-12">
                                    <button class="btn btn-success" type="submit" name="submit">
                                        Submit
                                    </button>                                    
                                </div>
                            </form>          
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" style="margin-top: 20px">
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <i class="glyphicon glyphicon glyphicon-list-alt"></i><span> Update & Remove User </span>
                    </div>
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr class="success">
                                <th class="text-center">Username </th>
                                <th class="text-center">Status</th>
                                <th class="text-center">UPDATE</th>
                                <th class="text-center">REMOVE</th>
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
                            $sql = "select *from user";
                            $rs = mysqli_query($db->getLink(), $sql);
                            while ($data = mysqli_fetch_array($rs)) {
                                $id = $data['user_id'];
                                // echo "<tr><td>" . $data['tournament_name'] . "</td><td>" . $data['tournament_start'] . "</td></tr>";
                                echo "<tr><td class='row-tournament'><a class='link-detail' style='color:#000' href='admin-edit.php?id=" . $id . "'>" . $data['username'] . "</td><td class='row-tournament'><a class='link-detail' style='color:#000' href='admin-edit.php?id=" . $id . "'>" . $data['type'] . "</td><td> <a class='btn btn-link' href='admin-edit.php?id=" . $id . "'><i class='glyphicon glyphicon-edit'></i></a></td><td> <a onclick='return confirm(\"Are you sure you want to remove?\")' class='btn btn-link' href='admin-delete.php?id=" . $id . "'><i class='glyphicon glyphicon-trash'></i></a></td></tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>       
    </div>
</body>
</html>