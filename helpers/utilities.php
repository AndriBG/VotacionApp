<?php

    class Utilities{

        // Verifica si hay por lo menos un objeto activo.
    // sirve para cualquier array de objetos que tengan la propiedad "Estado".
    public function isActive($List){

        // Saber si hay una elección activa
        $isThere = false;
        foreach($List as $ele){
            if($ele->Estado==1){
                return $isThere=true;
            }
        }
        return $isThere;
    }

    public function getLastElement($list){

        $countList = count($list);
        $lastElement = $list[$countList -1];

        return $lastElement;

    }

    public function searchProperty($list,$property,$value){

        $filters = [];

        foreach($list as $item){

            if($item->$property == $value){
                array_push($filters, $item);
            }
        }
        return $filters;
    }

    public function getIndexElement($list,$property,$value){

        foreach($list as $key => $item){

            if($item->$property == $value){             
                return $key;              
               
            }
        }
    }

}
