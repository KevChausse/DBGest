<?php

include('dbaccess.class.php');

class Column {

    private $_table = "";
    private $_dbConnect;
    private $_dbuser = "";
    private $_dbpassword = "";
    private $_dbhost = "";
    private $_dbport = "";
    private $_dbname = "";


    public function __construct(){

        $dbaccess = new DBAccess();
        
        $this->_dbuser = $dbaccess->tab['user'];
        $this->_dbpassword = $dbaccess->tab['password'];
        $this->_dbport = $dbaccess->tab['port'];
        $this->_dbhost = $dbaccess->tab['host'];
        $this->_dbname = $dbaccess->tab['name'];

        try {
            $this->_dbConnect = new PDO('mysql:host='.$this->_dbhost.';port='.$this->_dbport.';dbname=information_schema', $this->_dbuser, $this->_dbpassword);
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
        }
    }

    public function getColumn($id = null){

        $query = "SELECT COLUMN_NAME, TABLE_NAME FROM COLUMNS";
        if($id !== null){
            $query .= " WHERE COLUMN_NAME LIKE '%".$id."%' AND TABLE_SCHEMA='".$this->_dbname."'";
        }
        foreach( $this->_dbConnect->query($query) as $row ){
            $this->_table .= "<tr> \n";
            $this->_table .= "<td>".$row['COLUMN_NAME']."</td> \n";
            $this->_table .= "<td><a href=\"#\" onclick=\"load_table('".$row['TABLE_NAME']."')\">".$row['TABLE_NAME']."</a></td> \n";
            $this->_table .= "</tr> \n";
        }
        if($this->_table==""){
            $this->_table = "<i>Aucun résultat</i>";
        }
        echo $this->_table;
    }
}



class Table {
    
    private $_table = "";
    private $_tableName = "";
    private $_dbConnect;
    private $_dbuser = "";
    private $_dbpassword = "";
    private $_dbhost = "";
    private $_dbport = "";
    private $_dbname = "";


    public function __construct(){

        $dbaccess = new DBAccess();
        $this->_dbuser = $dbaccess->tab['user'];
        $this->_dbpassword = $dbaccess->tab['password'];
        $this->_dbport = $dbaccess->tab['port'];
        $this->_dbhost = $dbaccess->tab['host'];
        $this->_dbname = $dbaccess->tab['name'];

        try {
            $this->_dbConnect = new PDO('mysql:host='.$this->_dbhost.';port='.$this->_dbport.';dbname='.$this->_dbname, $this->_dbuser, $this->_dbpassword);
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
        }
    }


    public function getTable($id = null){
        $query = "";
        if($id !== null){
            $query .= "DESCRIBE ";
            $query .= $id;
        }
        if($this->_dbConnect->query($query)){
            foreach( $this->_dbConnect->query($query) as $row ){
                $this->_table .= "<tr> \n";
                $this->_table .= "<td>".$row['Field']."</td> \n";
                $this->_table .= "<td>".$row['Type']."</td> \n";
                $this->_table .= "</tr> \n";
            }
        }
        if($this->_table==""){
            $this->_table = "<i>Aucun résultat</i>";
        }
        echo $this->_table;
    }
}

?>