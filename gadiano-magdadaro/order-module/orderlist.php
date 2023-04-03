<div id="third-submenu">
    <a href="index.php?page=ordering">Order List</a> | 
    <a href="index.php?page=ordering&action=create">Order Transaction</a> | 

    Search <input type="text"/>
</div>


<div id="subcontent">

    <?php
      switch($action){
        case 'create':
            require_once 'order-module/createorder.php';
        break;
                case 'order':
                    require_once 'order-module/orderlist.php';
                break;
                default:
                    require_once 'order-module/ordering.php';
                break; 
            }
    ?>
  </div>

