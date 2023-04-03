<?php
include_once 'classes/class.user.php';
include_once 'classes/class.product.php';
include_once 'classes/class.release.php';
include_once 'classes/class.receive.php';
include 'config/config.php';

$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
$subpage = (isset($_GET['subpage']) && $_GET['subpage'] != '') ? $_GET['subpage'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

$user = new User();
$product = new Product();
$release = new Release();
$receive = new Receive();
if (!$user->get_session()){
    header("location: login.php");
}
$user_id = $user->get_user_id($_SESSION['user_email']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>TriftFlips</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Assistant&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?<?php echo time();?>">
</head>
<body>

    <div id="header">
        <img src = "Thriftflips.png" alt="">
    </div>
<div id="wrapper">
  <div id="menu">
      <a href="index.php">Home</a> | 
      <a href="index.php?page=ordering">Ordering</a> | 
      <a href="index.php?page=products">Product</a> |
      <a href="index.php?page=inventory">Inventory</a> |
      <a href="index.php?page=settings">Settings</a> |
      <a href="logout.php" class="move-right">Log Out</a>
  </div>
  <div id="content">
    <?php
      switch($page){
                case 'settings':
                    require_once 'settings-module/index.php';
                break; 
                case 'ordering':
                    require_once 'order-module/ordering.php';
                break; 
                case 'products':
                    require_once 'products-module/index.php';
                break; 
                case 'inventory':
                    require_once 'inventory-module/index.php';
                break; 
                case 'logout':
                    require_once 'login.php';
                break; 
                default:
                    require_once 'main.php';
                break; 
            }
    ?>
  </div>
</div>

</body>
</html>