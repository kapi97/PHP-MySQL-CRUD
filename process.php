<?php

session_start();

$mysqli = new mysqli('localhost', 'root', 'root', 'telcrud') or die(mysqli_error($mysqli));

$id = 0;
$update = 'true';
$name = '';
$location = '';

if (isset($_POST['save'])){
    $brandname = $_POST['brand_name'];
    $productname = $_POST['product_name'];
    $clientname = $_POST['client_name'];
    
    $mysqli->query("INSERT INTO telephones (brand_name, product_name, client_name) VALUES('$brandname', '$productname', '$clientname')") or die($mysqli->error);
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*$mysqli->query("INSERT INTO brand (brand_name) VALUES('$brandname')") or die($mysqli->error); // mysqli_query($mysqli);
    $mysqli->query("INSERT INTO product (product_name) VALUES('$productname')") or die($mysqli->error); // mysqli_query($mysqli);
    $mysqli->query("INSERT INTO client (client_name) VALUES('$clientname')") or die($mysqli->error); // mysqli_query($mysqli);*/
    //powyzej dodaje rekordy, ale bez relacji
    /////////////////////////////////////////
    //$mysqli->query("INSERT INTO product (product_name, brand_id) VALUES('$productname', ".mysql_insert_id().")") or die($mysqli->error);
    //$mysqli->query("INSERT INTO client (client_name, product_id) VALUES('$clientname', ".mysql_insert_id().")") or die($mysqli->error);//!!!!!!!
    
    /*$sql1="INSERT INTO brand (brand_name) VALUES('$brandname')";
    $sql2="INSERT INTO product (product_name) VALUES('$productname')";
    $sql3="INSERT INTO client (client_name) VALUES('$clientname')";
    //$sql2="INSERT INTO product (product_name, brand_id) VALUES('$productname', ".mysqli_insert_id().")";
    //$sql3="INSERT INTO client (client_name, product_id) VALUES('$clientname', ".mysqli_insert_id().")";
    mysqli_query($sql1, $mysqli);
    mysqli_query($sql2, $mysqli);
    mysqli_query($sql3, $mysqli);*/
    
 /*   $query="INSERT INTO brand (brand_name) VALUES('$brandname');INSERT INTO product (product_name) VALUES('$productname');INSERT INTO client (client_name) VALUES('$clientname')";
    mysqli_multi_query($link, $query);*///ten fragment nie dziala
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";
    
    header("location: index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM telephones WHERE id=$id") or die($mysqli->error());
    /*$mysqli->query("DELETE FROM brand 
    JOIN product ON brand.brand_id = product.brand_id 
    JOIN client ON product.product_id = client.product_id 
    WHERE id=$id") ;*/
       // or die($mysqli->error());//!!!
    
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    
    header('location: index.php');
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = false;
    $result = $mysqli->query("SELECT * FROM telephones WHERE id=$id") or die($mysqli->error());
    /*$result = $mysqli->query("SELECT * FROM brand 
    JOIN product ON brand.brand_id = product.brand_id 
    JOIN client ON product.product_id = client.product_id 
    WHERE brand_id=$id") ;*/
        //or die($mysqli->error());//!!!
    if (is_array($result) && count($result)==1){
        $row = $result->fetch_array();
    $brandname = $_POST['brand_name'];
    $productname = $_POST['product_name'];
    $clientname = $_POST['client_name'];
    }
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $brandname = $_POST['brand_name'];
    $productname = $_POST['product_name'];
    $clientname = $_POST['client_name'];
    
    $mysqli->query("UPDATE telephones SET brand_name='$brandname', product_name='$productname', client_name='$clientname' WHERE id=$id") or die($mysqli->error);
    /*$mysqli->query("UPDATE brand SET brand_name='$brandname' 
    JOIN product ON 
    product.product_name='$productname'
    JOIN client ON
    client.client_name='$clientname'
    WHERE brand_id=$id") ;*/
        //or die($mysqli->error);//!!!
    
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msq_type'] = "warning";
    
    header('location: index.php');
}