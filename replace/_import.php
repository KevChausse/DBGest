<?php

    $err = 0;
    chmod("../files/list2.csv", 0733);

    if($_FILES['newfile']['error'] > 0) header('location: import.php?err=1');

    $extensions_valides = array('csv');

    $extension_upload = strtolower(  substr(  strrchr($_FILES['newfile']['name'], '.')  ,1)  );
    if ( in_array($extension_upload,$extensions_valides) ) header('location: import.php?err=2');


    $nom = "../files/list2.csv";
    $resultat = move_uploaded_file($_FILES['newfile']['tmp_name'],$nom);
    if ($resultat) header('location: import.php?err=0');
    else echo "err";

?>