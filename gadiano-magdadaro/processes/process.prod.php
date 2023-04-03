<?php
include 'order-module/ordering.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action){
    case 'newtype':
        create_new_type();
	break;
    case 'newproduct':
        create_new();
	break;
    case 'updateproduct':
        update_product();
	break;
    case 'upload':
        upload();
	break;
}

function create_new_type(){
	$product = new Product();
    $tname= ucwords($_POST['tname']);    
    $tid = $product->new_product_type($tname);
    if(is_numeric($tid)){
        header('location: ../index.php?page=settings&subpage=products&action=types&id='.$tid);
    }
}
function create_new(){
	$product = new Product();
    $pname= ucwords($_POST['pname']);  
    $desc= ucwords($_POST['desc']);  
    $price= ucwords($_POST['price']);    
    $type= $_POST['ptype'];  
    $pid = $product->new_product($pname,$desc,$price,$type);
    if(is_numeric($pid)){
        header('location: ../index.php?page=settings&subpage=products&action=profile&id='.$pid);
    }
}
function update_product(){
	$product = new Product();
    $pname= ucwords($_POST['pname']);  
    $desc= ucwords($_POST['desc']);   
    $type= $_POST['ptype'];  
    $pid= $_POST['prodid']; 
    $result = $product->update_product($pname,$desc,$type,$pid);
    header('location: ../index.php?page=settings&subpage=products&action=profile&id='.$pid);
}
