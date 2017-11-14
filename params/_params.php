<?php

    if(isset($_POST['hostname'])){
        $hostname = $_POST['hostname'];
    }
    else $hostname = "";

    if(isset($_POST['port'])){
        $port = $_POST['port'];
    }
    else $port = "";

    if(isset($_POST['username'])){
        $username = $_POST['username'];
    }
    else $username = "";

    if(isset($_POST['password'])){
        $password = $_POST['password'];
    }
    else $password = "";

    if(isset($_POST['dbname'])){
        $dbname = $_POST['dbname'];
    }
    else $dbname = "";

    $params = "$hostname;$port;$username;$password;$dbname;";


    file_put_contents('../files/params.txt', $params);

    header('Location: params.php');

?>