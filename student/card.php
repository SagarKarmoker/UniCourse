<?php
session_start();
include 'dbconfig.php';
if(isset($_POST['cardnum']) && isset($_POST['date']) && isset($_POST['cvv']) && isset($_POST['name'])){
    $card = $_POST['cardnum'];
    $date = $_POST['date'];
    $cvv = $_POST['cvv'];
    $name = $_POST['name'];

    $user = $_SESSION['username'];

    if(isset($_SESSION['username'])){
        $userid = 'user' . rand(1000, 9999);
        $sql = "insert into bank (userid, name, cardnum, date, cvv, balance) values('$userid', '$name', '$card', '$date', '$cvv', 1000)";
        if($conn->query($sql)){
            $add = "insert into bank_link (uid, userid) values('$user', '$userid')";
            if($conn->query($add)){
                echo 'Card added to your account';
            }
        }
        else{
            echo 'Error';
        }
    }
    else{
        echo 'User not logged in';
    }
}
?>