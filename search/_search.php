<?php


include_once('../class/search.class.php');

$column = new Column();
$table = new Table();


if(isset($_POST['col']) && $_POST['col']!=""){
    $column->getColumn($_POST['col']);
}



if(isset($_POST['table']) && $_POST['table']!=""){
    $table->getTable($_POST['table']);
}



?>