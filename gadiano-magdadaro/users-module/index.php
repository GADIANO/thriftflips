<?php
include_once 'classes/class.user.php';
/* instantiate class object */
$user = new User();
?>
<div id="third-submenu">
    <a href="index.php?page=settings&subpage=users">List Users</a> | <a href="index.php?page=settings&subpage=users&action=create">New User</a> | Search <input type="text"/>
</div>
<div id="subcontent">
    <?php
      switch($action){
                case 'create':
                    require_once 'users-module/create-user.php';
                break; 
                case 'modify':
                    require_once 'users-module/modify-user.php';
                break;
                case 'result':
                    require_once 'users-module/search-user.php';
                break;
                default:
                    require_once 'users-module/main.php';
                break; 
            }
    ?>
  </div>