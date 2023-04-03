nes (4 sloc)  84 Bytes

<?php
include 'config/config.php';
session_destroy();
header("location: index.php");