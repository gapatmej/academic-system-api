<?php

/**
 * Descripción de Sessions:
 *
 * 
 * 
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   29-oct-2018
 */
class Sessions {
    private static $arraySessions;
    
    public static function setSession($u, $t ){
        self::$arraySessions[$u] = "asdadasdasdasd";
    }
    
    public static function getSession($u){
        //return self::$arraySessions[$u];
        return self::$arraySessions;
    }
    
    public static function removeSession($u ){
        unset(self::$arraySessions[$u]);
    }
}
