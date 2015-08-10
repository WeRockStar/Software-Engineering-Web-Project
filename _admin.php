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
                    var data = $("#t-name , #t-date , #t-location , #t-time").serializeArray();
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
                                setInterval(location.reload() , 3000);
                                
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
    </head>
    <body>
        <?php
        if ($_SESSION['type'] != "admin") {
            ?>
            <script type="text/javascript">
                alert("For Admin Only");
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
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle collapsed menu-nav" data-toggle="collapse" data-target="#topNav" >
                    MENU
                </button> 
                <a href="admin.php" class="navbar-brand">         
                    <font size="5">Management Events</font>   
                </a>
            </div>          
        </div>
    </nav>

    <div class="intro-content" >  
        <div class="container">
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                <div class="panel panel-info" style="margin-top: 20px">
                    <div class="panel-heading">
                        <i class="glyphicon glyphicon glyphicon-list-alt"></i><span> Add Tournaments </span>
                    </div>
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr class="success">
                                <th class="text-center">TOURNAMENT</th>                                
                            </tr>
                        </thead>
                        <tbody class="text-center" id="alert-add">
                            <tr>
                                <td>
                                    <form class="form" id="form-add">
                                        <div class="form-group form-inline">
                                            <input type="text" name="t-name" id="t-name" class="form-control"  placeholder="<?php echo strtolower('TOURNAMENT name'); ?>" required="">
                                            <input type="date" name="t-date" id="t-date" class="form-control" placeholder="date" required="">
                                            <input type="time" name="t-time" id="t-time" class="form-control" placeholder="time" required="">
                                            <input type="location" name="t-location" id="t-location" class="form-control" placeholder="location" required="">                                            
                                        </div> 
                                        <div class="form-group form-inline">
                                            <button type="submit" class="btn btn-primary">ADD TOURNAMENT</button> 
                                        </div>
                                    </form>
                                </td>                               
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <i class="glyphicon glyphicon glyphicon-list-alt"></i><span> Update & Remove Tournaments </span>
                    </div>
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr class="success">
                                <th class="text-center">TOURNAMENT</th>
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
                            $sql = "select tournament_id,tournament_name,tournament_start from tournament";
                            $rs = mysqli_query($db->getLink(), $sql);
                            while ($data = mysqli_fetch_array($rs)) {
                                $id = $data['tournament_id'];
                                // echo "<tr><td>" . $data['tournament_name'] . "</td><td>" . $data['tournament_start'] . "</td></tr>";
                                echo "<tr><td class='row-tournament'><a class='link-detail' style='color:#000' href='detail_tournaments.php?tournament_id=".$id."'>" . $data['tournament_name'] . "</td><td> <a class='btn btn-link' href='update.php?tournament_id=" . $id . "'><i class='glyphicon glyphicon-edit'></i></a></td><td> <a onclick='return confirm(\"Are you sure you want to remove?\")' class='btn btn-link' href='delete.php?tournament_id=" . $id . "'><i class='glyphicon glyphicon-trash'></i></a></td></tr>";
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