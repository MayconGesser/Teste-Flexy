<?php

    function construirJSON($atributos,$registro){
        $elementos = count($atributos);
        $json = '{';
        for($i = 0; $i<$elementos; $i++){            
            $json .= '"' . $atributos[$i] . '" : ' . '"' . $registro[$atributos[$i]] . '"' .
            ($i !== $elementos-1 ? ',' : '');        
        }
        $json .= '}';
        return $json;
    }