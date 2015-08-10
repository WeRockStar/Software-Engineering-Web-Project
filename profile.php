<?php
session_start();
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
            $(function () {
                $('#form-profile').submit(function () {
                    var data = $('#password , #passC, #fname , #lname , #bday , #address , #tel, #email , #id').serializeArray(); //send json
                    $.ajax({
                        url: "./ajax/ajax-profile.php",
                        data: data,
                        type: 'POST',
                        success: function (result) {
                            $('.alert').remove();
                            var htmlSuccues = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>อัพเดทข้อมูลสำเร็จ</strong> <a href='profile.php'>คลิกเพื่อดูผลลัพท์ </a></div>";
                            var htmlWarning = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>อัพเดทข้อมูลไม่สำเร็จ</strong> กรุณาลองใหม่ลอีกครั้ง</div>";
                            if (result == "success") {
                                $('#form-profile').prepend(htmlSuccues);
                            } else if (result == "error") {
                                $('#form-profile').prepend(htmlWarning);
                            }

                        }
                    });
                    return false;
                });
            });
        </script>
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
<!--                        <a href="" data-target="#login" data-toggle="modal" type="button" ><i class="glyphicon glyphicon-log-in"></i>  <h4 style="display: inline;" class="text-sign">Sign In</h4> </a>                         -->
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="navbar-link text-left" style="margin-top: 10px;">
<!--                        <a href="" data-target="#signup" data-toggle="modal" type="button"><i class="glyphicon glyphicon-download-alt"></i>  <h4 style="display: inline;" class="text-sign">Register</h4> </a>-->
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
                        <li ><a data-target="#login" data-toggle="modal"  class="menu-nav"><h4>PROFILE : <?php echo $_SESSION['user']; ?></h4></a>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="intro-content" >
            <div class="container">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                    <div class="col-md-offset-3 col-md-6 col-lg-6 col-lg-offset-3" >
                        <div class="thumbnail" >                            
                            <div class="caption">
                                <h3>UPDATE PROFILE</h3>
                                <form class="form" id="form-profile">
                                    <div class="form-group">
                                        <?php
                                        class Fetch extends dbConnection {

                                            public function __construct() {
                                                parent::__construct();
                                            }
                                        }

                                        $db = new Fetch();
                                        $sql = "select *from user where user_id = '" . $_SESSION['id'] . "'";
                                        $rs = mysqli_query($db->getLink(), $sql);
                                        $user = "";
                                        $pass = "";
                                        $fname = "";
                                        $lname = "";
                                        $birthday = "";
                                        $email = "";
                                        $address = "";
                                        $tel = "";
                                        while ($row = mysqli_fetch_array($rs)) {
                                            $user = $row['username'];
                                            $pass = $row['password'];
                                            $fname = $row['firstname'];
                                            $lname = $row['lastname'];
                                            $birthday = $row['birthday'];
                                            $email = $row['email'];
                                            $address = $row['address'];
                                            $tel = $row['phone'];
                                        }
                                        ?>
                                        <label class="" >username : </label>                                            
                                        <input type="text" id="username" class="form-control" name="username" value="<?php echo $user; ?>"  placeholder="username" disabled>                                                                                    
                                    </div>                                    
                                    <div class="form-group">                                        
                                        <label class="" >password : </label>                                            
                                        <input type="password" id="password" class="form-control" name="password" value=""  placeholder="Confirm password">                                                                               
                                    </div>
                                    
                                    <div class="form-group">                                                                               
                                        <label class="" >First Name : </label>                                        
                                        <input type="text" id="fname" class="form-control" name="fname" value="<?php echo $fname; ?>"  placeholder="first name">                                                                                    
                                    </div>
                                    <div class="form-group">                                                                                
                                        <label class="" >Last Name : </label>                                            
                                        <input type="text" id="lname" class="form-control" name="lname" value="<?php echo $lname; ?>"  placeholder="last name">                                                                                   
                                    </div>
                                    <div class="form-group">                                                                               
                                        <label class="" >Birthday : </label>                                            
                                        <input type="text" id="bday" class="form-control" name="bday" value="<?php echo $birthday; ?>" placeholder="birthday">                                                                                   
                                    </div>
                                    <div class="form-group">                                                                                
                                        <label class="" >Email : </label>                                        
                                        <input type="email" id="email" class="form-control" name="email" value="<?php echo $email; ?>"  placeholder="email">                                                                                    
                                    </div>
                                    <div class="form-group">                                                                                
                                        <label class="" >Address : </label>                                        
                                        <input type="text" id="address" class="form-control" name="address" value="<?php echo $address; ?>"  placeholder="address">                                                                                    
                                    </div>
                                    <div class="form-group">                                                                               
                                        <label class="" >Tel : </label>                                        
                                        <input class="form-control" id="tel"  name="tel" value="<?php echo $tel; ?>" placeholder="tel" type="text">
                                    </div>
                                    <div class="form-group">                                        
                                        <label class="" >Status : </label>
                                        <input type="tel" class="form-control"  value="<?php echo '  ' . $_SESSION['type']; ?>"  placeholder="Status" disabled="">                                            
                                    </div>
                                    <div class="form-group">                                                                                
                                        <input type="hidden" id="id" name="id" class="form-control"  value="<?php echo $_SESSION['id']; ?>"> 
                                        <input type="hidden" id="passC" name="passC" class="form-control"  value="<?php echo $pass; ?>">
                                    </div>
                                    <div class="form-group">                                        
                                        <?php
                                        if ($_SESSION['type'] == "seller") {
                                            echo "<a class='btn btn-link'> Seller View</a>";
                                        }
                                        ?>
                                    </div>

                                    <div class="form-group form-inline text-center" >
                                        <button class="form-control btn btn-success" type="submit" style="color: #fff;font-weight: bold" >UPDATE</button>
                                        <a href="member.php" class="form-control btn btn-danger" style="color: #fff;font-weight: bold">CANCEL</a>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>