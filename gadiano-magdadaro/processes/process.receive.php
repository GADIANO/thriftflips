<?php
include '../classes/class.receive.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
    case 'create':
        create_new_transaction();
	break;
    case 'additem':
        new_receive_item();
	break;
    case 'saveitem':
        save_receive_items();
	break;
}

function create_new_transaction(){
	$receive = new Receive();
   $name= ucwords($_POST['name']);
    $desc= ucwords($_POST['desc']); 
    $amount= $_POST['amount']; 
    $rid = $receive->new_receive($name, $desc, $amount);
    if(is_numeric($rid)){
        header('location: ../index.php?page=receive&action=receive&id='.$rid);
    }
}

function new_receive_item(){
	$receive = new Receive();
    $recid= $_POST['recid'];
    $prodid= $_POST['prodid']; 
    $qty= $_POST['qty']; 
    $rid = $receive->new_receive_item($recid, $prodid, $qty);
    if($rid){
        header('location: ../index.php?page=receive&action=receive&id='.$recid);
    }
}

function save_receive_items(){
	$receive = new Receive();
    $id = $_POST['recid'];
    $receive->save_to_inventory($id);
    $rid = $receive->save_receive_items($id);
    if($rid){
        header('location: ../index.php?page=receive&action=receive&id='.$id);
    }
}