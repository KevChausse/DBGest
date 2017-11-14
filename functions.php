<?php

    function csv_to_tab($file){
        $tab = array();
        $ind = 0;
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $i = 0;
                $tab[$ind]['table'] = $data[$i];
                $i++;
                $tab[$ind]['old_name'] = $data[$i];
                $i++;
                $tab[$ind]['new_name'] = $data[$i];
                $ind++;
            }
        }

        return $tab;
    }

?>