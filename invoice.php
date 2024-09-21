<?php
// var_dump($_POST);
// exit;
session_start();
include('connection.php');
if(isset($_POST['submit'])){
    $invoice_number=mt_rand(11111,99999);
    foreach($_POST['item_name'] as $key=>$value){
        $sql="INSERT INTO invoice ( item_name,quatity,price,subtotal,invoice_number,invoice_date,client_name) VALUES(
        '{$_POST["item_name"][$key]}','{$_POST["quantity"][$key]}','{$_POST["price"][$key]}',
        '{$_POST["subtotal"][$key]}','$invoice_number','{$_POST["date"][$key]}','{$_POST["name"][$key]}')";
        $query=mysqli_query($conn,$sql);
            }
            if($query){
                $_SESSION['msg']= "Data Inserted Successful";
                header('location:newinvoice.php');
            }else{
                $_SESSION['msg']= "Something Went Wrong";
                echo mysqli_error($conn);
            }
            
}else{
    echo "data is not found";
}

?>
