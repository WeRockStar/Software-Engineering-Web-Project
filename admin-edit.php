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
                $('#form-update').submit(function () {
                    $('.alert').remove();
                    var data = $("#user-id, #user , #first , #last , #pass , #email , #status , #address , #phone , #birth").serializeArray();
                    $.ajax({
                        url: "./ajax/ajax-admin-edit.php",
                        type: 'POST',
                        data: data,
                        success: function (result) {
                            var htmlSuccues = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>อัพเดทข้อมูลสำเร็จ</strong> <a href='admin-user.php'>คลิกเพื่อดูผลลัพท์ </a></div>";
                            var htmlWarning = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>อัพเดทข้อมูลไม่สำเร็จ</strong> กรุณาลองใหม่ลอีกครั้ง</div>";
                            if (result == "success") {
                                $('#form-update').prepend(htmlSuccues);
                            } else if (result == "error") {
                                $('#form-update').prepend(htmlWarning);
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
        if ($_SESSION['type'] != "admin") {
            ?>
            <script type="text/javascript">
                alert("For Admin Only");
                window.location.href = "member.php";
            </script>
            <?php
        }
        ?>
        <!-- Header -->

        <div style="height: 80px;" class="hidden-sm hidden-xs">
            <div class="row">
                <div class="col-md-6"> 
                    <a href="index.php" class="navbar-brand" style="margin: -10px 0px 0px 10px;">
                        <h2 class="hidden-xs hidden-sm hidden-md">Administration Management </h2>
                        <h6 class="visible-xs visible-sm" style="">Administration Management </h6>                        
                    </a>
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
                <a href="admin.php" class="navbar-brand">         
                    <font size="5">Management User</font>   
                </a>
            </div>          
        </div>
    </nav>
    <?php
    include_once './config/config.php';
    $id = $_GET['id'];

    $sql = "select * from user where user_id = '" . $id . "'";
    $db = new dbConnection();
    $rs = mysqli_query($db->getLink(), $sql);
    $username = "";
    $firstname = "";
    $lastname = "";
    $password = "";
    $type = "";
    $email = "";
    $birthday = "";
    $address = "";
    $phone = "";    
    while ($row = mysqli_fetch_array($rs)) {
        $username = $row['username'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $password = $row['password'];
        $type = $row['type'];
        $email = $row['email'];
        $birthday = $row['birthday'];
        $address = $row['address'];
        $phone = $row['phone'];
    }
    ?>
    <div class="intro-content" >  
        <div class="container" style="min-width: 60%">
            <div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-xs-12 col-sm-12">
                <div class="panel panel-info" style="margin-top: 20px">
                    <div class="panel-heading">
                        <i class="glyphicon glyphicon glyphicon-list-alt"></i><span> Update User </span>
                    </div>
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr class="success">
                                <th class="text-center">USER INFO</th>                                
                            </tr>
                        </thead>
                        <tbody class="" id="alert-success">
                            <tr>
                                <td>
                                    <form id="form-update" action="" class="form" role="form"  method="post">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="user" >Username</label>
                                                <input type="text" class="form-control" name="username" value="<?php echo "$username"; ?>" id="user" placeholder="username" required>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pass">Password</label>
                                                <input id="pass" class="form-control" name="password" type="text" value="<?php echo "$password"; ?>" placeholder="password" required>
                                            </div> 
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first">First Name</label>
                                                <input type="text" class="form-control" name="fname" id="first" value="<?php echo "$firstname"; ?>" placeholder="first name" required>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label for="last">Last Name</label>
                                                <input type="text" name="lname" class="form-control" id="last" value="<?php echo "$lastname"; ?>" placeholder="last name" required> 
                                            </div> 
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" name="email" id="email" value="<?php echo "$email"; ?>" placeholder="emial" required>
                                            </div> 
                                        </div>                                                                  
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="birth">BirthDay</label>
                                                <input type="date" class="form-control" id="birth" name="birthday" value="<?php echo "$birthday"; ?>" placeholder="birthday" required>
                                            </div> 
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea type="text" cols="3" rows="2" name="address" class="form-control" id="address" 
                                                          placeholder="address" required><?php echo "$address"; ?></textarea>
                                            </div> 
                                        </div>                                                                               

                                        <div class="col-md-6">
                                            <div class="form-group form-group-sm ">
                                                <label for="phone">Phone Number</label>
                                                <input type="tel" class="form-control" id="phone" value="<?php echo "$phone"; ?>" name="phone" placeholder="phone" required>
                                            </div> 
                                        </div>   
                                        <div class="col-md-6">
                                            <div class="form-group form-group-sm ">
                                                <label for="phone">Status</label>
                                                <select id="status" name="status" class="form-control">
                                                    <?php
                                                    if ($type == "admin") {
                                                        echo "<option>admin</option>";
                                                        echo "<option>member</option>";
                                                        echo "<option>seller</option>";
                                                    } else if ($type == "seller") {
                                                        echo "<option>seller</option>";
                                                        echo "<option>member</option>";
                                                        echo "<option>admin</option>";
                                                    } else if ($type == "member") {
                                                        echo "<option>member</option>";
                                                        echo "<option>seller</option>";
                                                        echo "<option>admin</option>";
                                                    }
                                                    ?>                                                    

                                                </select>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-sm ">                                                
                                                <input type="hidden" class="form-control" id="user-id" value="<?php echo "$id"; ?>" name="userid" placeholder="phone" required>
                                            </div> 
                                        </div> 
                                        <div class="row text-center">
                                            <div class="col-md-12">
                                                <button class="btn btn-success" type="submit" name="submit">
                                                    Submit
                                                </button>
                                               
                                            </div>
                                        </div>
                                    </form> 
                                </td>                               
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>
</body>
</html>