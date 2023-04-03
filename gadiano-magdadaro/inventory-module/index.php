<div id="third-submenu">
     | 
    Search <input type="text"/>
    <a href="#">Result</a>
</div>
<div id="subcontent">
    <?php
      switch($action){
                case 'result':
                   include_once 'inventory-module/search-user.php';
                break;
                default:
                    include_once 'inventory-module/main.php';
                break; 
            }
    ?>
  </div>
