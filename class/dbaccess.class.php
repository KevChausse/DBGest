<?php

    class DBAccess{

        public $tab = array();

        function __construct(){
            $tab = array();

            $file = file_get_contents('../files/params.txt');

            $params = explode(';', $file);

            $tab['host'] = $params[0];
            $tab['port'] = $params[1];
            $tab['user'] = $params[2];
            $tab['password'] = $params[3];
            $tab['name'] = $params[4];

            $this->tab = $tab;
        }
    }