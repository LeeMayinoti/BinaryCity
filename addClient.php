<?php include('database.php')?>
<?php 
include('database.php');  
$ClientName =  $_POST['Client_names'];
$ClientCode= $_POST['ClientCode'];
$LinkContact =  $_POST['LinkedContacts'];

$sql = "INSERT INTO clients
(ClientCode,ClientCode,LinkedContacts)
VALUES('$ClientName','$ClientCode','$LinkContact');";

mysqli_query($conn,$sql)
?>