<?php
//Thong so ket noi CSDL

$servername = "localhost";

$username = "root";

$password = "";

$dbname = "blogs";

//Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

//Query statement
$query = "SELECT * FROM categories";

//Execute statement
$result = $conn->query($query);

//Create array to store data
$categories = array();

while($row = $result->fetch_assoc()){
    $categories[] = $row;
}

foreach ($categories as $cate){
    echo "<pre>";
        print_r($cate);
    echo "<pre>";
}