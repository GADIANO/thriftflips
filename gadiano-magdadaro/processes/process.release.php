<?php
include '../classes/class.release.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
    case 'create':
        create_new_transaction();
	break;
    case 'additem':
        new_release_item();
	break;
    case 'saveitem':
        save_receive_items();
	break;
}

function create_new_transaction(){
	$release = new Release();
   $name= ucwords($_POST['sname']);
    $desc= ucwords($_POST['desc']); 
    $amount= $_POST['amount']; 
    $rid = $release->new_release($name, $desc, $amount);
    if(is_numeric($rid)){
        header('location: ../index.php?page=release&action=release&id='.$rid);
    }
}

function new_release_item(){
	$release = new Release();
    $relid= $_POST['relid'];
    $prodid= $_POST['prodid']; 
    $qty= $_POST['qty']; 
    $rid = $release->new_release_item($relid, $prodid, $qty);
    if($rid){
        header('location: ../index.php?page=release&action=release&id='.$relid);
    }
}

function save_receive_items(){
	$release = new Release();
    $relid= $_POST['relid'];
    $release->save_to_released($relid);
    $rid = $release->save_release_items($relid);
    if($rid){
        header('location: ../index.php?page=release&action=release&id='.$relid);
    }
}