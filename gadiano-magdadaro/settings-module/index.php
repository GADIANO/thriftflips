<div id="second-submenu">
    <a href="index.php?page=settings&subpage=users">Users</a> |
    <a href="index.php?page=settings&subpage=systems">System Settings</a>
</div>
<div id="content">
    <?php
      switch($subpage){
                case 'users':
                    require_once 'users-module/index.php';
                break; 
                case 'module':
                    require_once '#-module/index.php';
                break; 
                case 'module_xxx':
                    require_once 'module-folder/';
                break; 
                default:
                    require_once 'main.php';
                break; 
            }
    ?>
  </div>