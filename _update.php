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
                    var data = $('#t-id , #t-name , #t-date , #t-location , #t-time').serializeArray();
                    $.ajax({
                        url: "./ajax/ajax-update.php",
                        type: 'POST',
                        data: data,
                        success: function (result) {
                            var htmlSuccues = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>อัพเดทข้อมูลสำเร็จ</strong> <a href='admin.php'>คลิกเพื่อดูผลลัพท์ </a></div>";
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
                    <font size="5">Management Events</font>   
                </a>
            </div>          
        </div>
    </nav>
    <?php
    include_once './config/config.php';
    $id = $_GET['tournament_id'];

    $sql = "select *from tournament where tournament_id = '" . $id . "'";
    $db = new dbConnection();
    $rs = mysqli_query($db->getLink(), $sql);
    $name = "";
    $location = "";
    $date = "";
    $time = "";
    while ($row = mysqli_fetch_array($rs)) {
        $name = $row['tournament_name'];
        $location = $row['tournament_location'];
        $time = $row['tournament_time'];
        $date = $row['tournament_start'];
    }
    ?>
    <div class="intro-content" >  
        <div class="container" style="min-width: 60%">
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                <div class="panel panel-info" style="margin-top: 20px">
                    <div class="panel-heading">
                        <i class="glyphicon glyphicon glyphicon-list-alt"></i><span> Update Tournaments </span>
                    </div>
                    <div class="thumbnail">
                        <form class="form" id="form-update">
                            <div class="form-group" style="margin: 10px 20px">
                                <label >Tournament name : </label>
                                <input type="text" id="t-name" name="t-name" class="form-control" value="<?php echo "$name"; ?>"  placeholder="<?php echo strtolower('TOURNAMENT name'); ?>" required="">                                                              
                            </div> 
                            <div class="form-group" style="margin: 10px 20px">
                                <label >Tournament date : </label>
                                <input type="date" id="t-date" name="t-date" class="form-control" value="<?php echo "$date"; ?>" placeholder="date" required="">                                
                            </div>
                            <div class="form-group" style="margin: 10px 20px">
                                <label >Tournament time : </label>                           
                                <input type="time" id="t-time" name="t-time" class="form-control" value="<?php echo "$time"; ?>" placeholder="time" required="">                               
                            </div>                        
                            <div class="form-group" style="margin: 10px 20px">
                                <label >Tournament location : </label>      
                                <input type="location" id="t-location" name="t-location" class="form-control" value="<?php echo "$location"; ?>" placeholder="location" required=""> 
                            </div>
                            <div>
                                <input id="t-id" type="hidden" name="t-id" value="<?php echo "$id"; ?>">
                            </div>
                            <div class="form-group text-center">
                                <button  type="submit" class="btn btn-primary" style="font-weight: bold">UPADTE TOURNAMENT</button> 
                            </div>
                        </form>
                    </div>

                </div>
            </div> 
        </div>
    </div>

</body>
</html>