<?php

    include_once('dbaccess.class.php');

    class Replace{

        private $_table = "";
        private $_dbConnect;
        private $_dbSystem;
        private $_dbuser = "";
        private $_dbpassword = "";
        private $_dbhost = "";
        private $_dbport = "";
        private $_dbname = "";
        public $_list = array();

        public $nb_err = 0;
        public $nb_success = 0;
        public $nb_col = 0; 
        public $temps = 0;


        public function __construct(){

            $dbaccess = new DBAccess();
            
            $this->_dbuser = $dbaccess->tab['user'];
            $this->_dbpassword = $dbaccess->tab['password'];
            $this->_dbport = $dbaccess->tab['port'];
            $this->_dbhost = $dbaccess->tab['host'];
            $this->_dbname = $dbaccess->tab['name'];

            try {
                $this->_dbSystem = new PDO('mysql:host='.$this->_dbhost.';port='.$this->_dbport.';dbname=information_schema', $this->_dbuser, $this->_dbpassword);
            } catch (PDOException $e) {
                echo 'Connexion échouée : ' . $e->getMessage();
            }

            try {
                $this->_dbConnect = new PDO('mysql:host='.$this->_dbhost.';port='.$this->_dbport.';dbname='.$this->_dbname, $this->_dbuser, $this->_dbpassword);
            } catch (PDOException $e) {
                echo 'Connexion échouée : ' . $e->getMessage();
            }
    
            $tab = csv_to_tab('../files/list.csv');
    
            $this->nb_col = count($tab);
            $this->_list = $tab;
        }
        

        function test(){
            $nb_success = 0;
            $nb_success2 = 0;
            $start = false;
            $reverse = false;

            for($ind = 0; $ind < $this->nb_col; $ind++){
                $COLUMN_TYPE = "";
        
                $rq_test = "SELECT COLUMN_TYPE FROM COLUMNS WHERE TABLE_SCHEMA='".$this->_dbname."' AND TABLE_NAME = '".$this->_list[$ind]['table']."' AND COLUMN_NAME = '".$this->_list[$ind]['old_name']."';";

                foreach($this->_dbSystem->query($rq_test) as $row){
                    extract($row);
                    $nb_success++;
                    $start = true;
                }
            }

            for($ind = 0; $ind < $this->nb_col; $ind++){
                $COLUMN_TYPE = "";
        
                $rq_test = "SELECT COLUMN_TYPE FROM COLUMNS WHERE TABLE_SCHEMA='".$this->_dbname."' AND TABLE_NAME = '".$this->_list[$ind]['table']."' AND COLUMN_NAME = '".$this->_list[$ind]['new_name']."';";
        
                foreach($this->_dbSystem->query($rq_test) as $row){
                    extract($row);
                    $nb_success2++;
                    $reverse = true;
                }
            }

            if($start && $reverse){
                $res['type'] = "none";
            }
            else if($start){
                $res['type'] = "start";
            }
            else $res['type'] = "reverse";
        
            if($nb_success == $this->nb_col || $nb_success2 == $this->nb_col){
                $res['status'] = 0;
            }
            else if($nb_success == 0 || $nb_success2 == 0){
                $res['status'] = 2;
            }
            else{
                $res['status'] = 1;
            } 

            return $res;
        }

        
        

        function test_col($table, $old, $new){
            $nb_success = 0;
            
            $rq_test = "SELECT COLUMN_TYPE FROM COLUMNS WHERE TABLE_SCHEMA='".$this->_dbname."' AND TABLE_NAME = '".$table."' AND COLUMN_NAME = '".$old."';";

            foreach($this->_dbSystem->query($rq_test) as $row){
                extract($row);
                $nb_success = 1;
            }

            if($nb_success==0){
                $rq_test = "SELECT COLUMN_TYPE FROM COLUMNS WHERE TABLE_SCHEMA='".$this->_dbname."' AND TABLE_NAME = '".$table."' AND COLUMN_NAME = '".$new."';";
                
                foreach($this->_dbSystem->query($rq_test) as $row){
                    extract($row);
                    $nb_success = 2;
                }
            }

            return $nb_success;
        }


        function start(){
            $temps_start = time();
            file_put_contents('../files/logs.txt', ">> Lancement du script de changement de colonnes (".date('d/m/Y - H:i:s').") << \n \n");
            $txt_err = "";
            $rq_rename = "";

            for($ind = 0; $ind < $this->nb_col; $ind++){
                $COLUMN_TYPE = "";
        
                $rq_test = "SELECT COLUMN_TYPE FROM COLUMNS WHERE TABLE_SCHEMA='".$this->_dbname."' AND TABLE_NAME = '".$this->_list[$ind]['table']."' AND COLUMN_NAME = '".$this->_list[$ind]['old_name']."';";
        
                foreach($this->_dbSystem->query($rq_test) as $row){
                    extract($row);
                }
        
                
                if($COLUMN_TYPE != ""){
                    $rq_rename .= "ALTER TABLE ".$this->_list[$ind]['table']." CHANGE ".$this->_list[$ind]['old_name']." ".$this->_list[$ind]['new_name']." ".$COLUMN_TYPE.";";
                    $this->nb_success++;
                    $txt_err .= "Succes ".$this->_list[$ind]['old_name']." -> ".$this->_list[$ind]['new_name']." dans la table ".$this->_list[$ind]['table']." \n \n";
                    $txt_err .= "-----------------------------------\n \n \n";
        
                }else{
        
                    $this->nb_err++;
                    $txt_err .= "Erreur ".$this->nb_err.": \n";
                    $txt_err .= "La colonne ".$this->_list[$ind]['old_name']." dans la table ".$this->_list[$ind]['table']." n'a pas ete modifiee.\n \n";
                    $txt_err .= "-----------------------------------\n \n \n";
        
                }
            }
            
            $this->_dbConnect->exec($rq_rename);
            file_put_contents('../files/logs.txt', $txt_err, FILE_APPEND);
            file_put_contents('../files/logs.txt', ">> Fin du script (".date('d/m/Y - H:i:s').") | Total: ".$this->nb_col." - Succès: ".$this->nb_success." - Erreurs: ".$this->nb_err." << \n \n", FILE_APPEND);
            $temps_fin = time();
            $this->temps = $temps_fin-$temps_start;
        }


        function reverse(){
            $temps_start = time();
            file_put_contents('../files/logs.txt', ">> Lancement du script d'annulation (".date('d/m/Y - H:i:s').") << \n \n");
            $txt_err = "";
            $rq_rename = "";
            
            for($ind = 0; $ind < $this->nb_col; $ind++){
                $COLUMN_TYPE = "";
        
                $rq_test = "SELECT COLUMN_TYPE FROM COLUMNS WHERE TABLE_SCHEMA='".$this->_dbname."' AND TABLE_NAME = '".$this->_list[$ind]['table']."' AND COLUMN_NAME = '".$this->_list[$ind]['new_name']."';";
        
                foreach($this->_dbSystem->query($rq_test) as $row){
                    extract($row);
                }
        
                if($COLUMN_TYPE != ""){
                    $rq_rename .= "ALTER TABLE ".$this->_list[$ind]['table']." CHANGE ".$this->_list[$ind]['new_name']." ".$this->_list[$ind]['old_name']." ".$COLUMN_TYPE.";";
                    $this->nb_success ++;
                    $txt_err .= "Succes ".$this->_list[$ind]['new_name']." -> ".$this->_list[$ind]['old_name']." dans la table ".$this->_list[$ind]['table']." \n \n";
                    $txt_err .= "-----------------------------------\n \n \n";
                }
                else {
        
                    $this->nb_err++;
        
                    $txt_err .= "Erreur $this->nb_err: \n";
                    $txt_err .= "La colonne ".$this->_list[$ind]['new_name']." dans la table ".$this->_list[$ind]['table']." n'a pas ete modifiee.\n \n";
                    $txt_err .= "-----------------------------------\n \n \n";
                }
            }
            
            $this->_dbConnect->exec($rq_rename);
            file_put_contents('../files/logs.txt', $txt_err, FILE_APPEND);
        
            file_put_contents('../files/logs.txt', ">> Fin du script (".date('d/m/Y - H:i:s').") | Total: ".$this->nb_col." - Succès: ".$this->nb_success." - Erreurs: ".$this->nb_err." << \n \n", FILE_APPEND);
            $temps_fin = time();
            $this->temps = $temps_fin-$temps_start;
        }
    }