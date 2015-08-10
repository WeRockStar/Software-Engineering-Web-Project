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
        <script type=text/javascript>
            $(function (){
               $( "#chkBill" ).is( ":checked", function (){
                  var flat = true;
                  var data = $('#chkBill').val();
                  alert(""+data);
                  $.ajax({
                     url: "./ajax/getBillion.php" ,
                     type: 'POST'                     
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

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="navbar-link text-left" style="margin-top: 10px;">                           
                        <a href="logout.php"><i class="glyphicon glyphicon-log-out"></i>  <h4 style="display: inline;" class="text-sign">Logout</h4> </a>
                    </div>
                </div>                
            </div>

            <a href="buy.php" style="display: inline;float: right;margin-right: 30px;margin-top: 35px;" class="text-sign"><i class="glyphicon glyphicon-shopping-cart"></i></a>

            <a href="<?php
            if ($_SESSION['type'] == "admin") {
                echo "admin.php";
            } else {
                echo 'profile.php';
            }
            ?>" style="display: inline;float: right;margin-right: 30px;margin-top: 35px;" class="text-sign"><i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['user']; ?> (  <?php echo $_SESSION['type']; ?> ) </a>
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
                    <div class="container">
                        <h1 class='text-left'>Checkout</h1>
                        <hr/>
                        <div class='col-xs-12 col-sm-12'>
                            <div class='panel panel-info'>
                                <div class='panel-heading'>
                                    <i class='glyphicon glyphicon glyphicon-list-alt'></i><span> Items on cart</span>
                                </div>
                                <table class='table table-hover table-responsive'>
                                    <thead>
                                        <tr class='success'>
                                            <th class='text-center'>no</th>
                                            <th class='text-center'>picture</th>
                                            <th class='text-center table-bordered'>Ticket name</th>
                                            <th class='text-center'>Type</th>
                                            <th class='text-center'>Price</th>
                                            <th class='text-center' style='width:15em'>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody class='text-center'>
                                        <?php

                                        class FetchComing extends dbConnection {

                                            public function __construct() {
                                                parent::__construct();
                                            }

                                        }
                                        $total = 0;
                                        $no = 0;
                                        if (count($_SESSION['cart_items']) > 0) {
                                            $ids = "";
                                            foreach ($_SESSION['cart_items'] as $id => $value) {
                                                $ids = $id;
                                                $type1 = $_SESSION['type_items'][$id];
                                                $type2 = $_SESSION['type_items'][$id] . "_price";
                                                $t_id = $_SESSION['ticket_id'][$id];
                                                $quantity = $_SESSION['cart_items'][$id];

                                                if ($type1 == 'seller') {
                                                    $db = new FetchComing();
                                                    $sql = "SELECT * FROM ticket WHERE ticket_id = {$t_id}";
                                                    $rs = mysqli_query($db->getLink(), $sql);
                                                    $data = mysqli_fetch_array($rs);
                                                    $no = $no + 1;
                                                    echo "<tr>";
                                                    echo "<td class='row-tournament'>{$no}</td>";
                                                    echo "<td> <img style='width:150px;margin-bottom:20px' class='img-rounded' src='" . $data['tournament_img'] . "'></td>";
                                                    echo "<td class='row-tournament'>" . $data['tournament_name'] . "</td>";
                                                    echo "<td class='row-tournament'>{$type1} {$data['seat']} </td>";
                                                    echo "<td class='row-tournament'>" . $data['price'] . "</td>";
                                                    echo "<td class='row-tournament'>{$quantity}</td>";

                                                    echo "</tr>";

                                                    $total = $total + $data['price'] * $quantity;
                                                } else {
                                                    $db = new FetchComing();
                                                    $sql = "SELECT * FROM tournament WHERE tournament_id = {$ids}";
                                                    //$sql = "select * from cart where user_id =" . $_SESSION['id'];
                                                    $rs = mysqli_query($db->getLink(), $sql);
                                                    $data = mysqli_fetch_array($rs);
                                                    $no = $no + 1;
                                                    echo "<tr>";
                                                    echo "<td class='row-tournament'>{$no}</td>";
                                                    echo "<td> <img style='width:150px;margin-bottom:20px' class='img-rounded' src='" . $data['tournament_img'] . "'></td>";
                                                    echo "<td class='row-tournament'>" . $data['tournament_name'] . "</td>";
                                                    echo "<td class='row-tournament'>{$type1}</td>";
                                                    echo "<td class='row-tournament'>" . $data[$type2] . "</td>";
                                                    echo "<td class='row-tournament'>{$quantity}</td>";

                                                    echo "</tr>";

                                                    $total = $total + $data[$type2] * $quantity;
                                                }
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class='row-tournament'>Total : </td>
                                            <td class='row-tournament'><?php echo $total ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr/>

                                <?php

                                class Login extends dbConnection {

                                    public function __construct() {
                                        parent::__construct();
                                    }

                                    public function __destruct() {
                                        
                                    }

                                }

                                $db = new Login();
                                $sql = "select * from user where user_id = '" . $_SESSION['id'] . "'";
                                $rs = mysqli_query($db->getLink(), $sql);
                                $row = mysqli_fetch_array($rs);
                                ?>

                                <h4 class='text-left'>Shopping Address  <input type='checkbox' checked></h4> 
<?php
echo "<input class='form-control' value='{$row['address']}'>";
?>
                                <h4 class='text-left'>Billion Address  <input type='checkbox' id="chkBill" name="chkBill"></h4> 
                                <input class='form-control' id="tbBill">
                                <h5 class='text-left'>Payment:  Visa <input type='checkbox'>  MasterCard <input type='checkbox'></h5> 
                                <div align="right">

<?php
if ($no == 0)
    echo "<h4 class='text-right'>Can not Confirm, You have no item on cart</h4> ";
else
    echo "<a class='btn btn-default' href='confirm.php'>Confirm</a>";
?>

                                </div>
                            </div>
                        </div> <!-- end Items cart -->
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