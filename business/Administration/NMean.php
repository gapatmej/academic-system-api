<?php
namespace business\Administration;
require_once PERSISTENCE.'Administration/PRolMean.php';
require_once PERSISTENCE.'Administration/PMeans.php';
require_once ENTITIES.'Administration/Mean.php';
/**
 * Descripción de NRol:
 *
 * 
 * 
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   10-oct-2018
 */
class NMean {
    
     public static function getMeansByRol($rol, &$codError, &$menError) {

        //GET MEANS
        $pRolMean = new \persistence\Administration\PRolMean();
        $rowsMeans = $pRolMean->getMeansByRol($rol);
        //$rowsMeans = "";
        foreach ($rowsMeans as $m){
            $mean = new \entities\Administration\Mean();
            $mean->setIdMean($m["id_mean"]);
            $mean->setName($m["name"]);
            $mean->setMnemonic($m["mnemonic"]);
            $mean->setComponent($m["component"]);
            $mean->setDescription($m["description"]);
            $rol->setMeans($mean);
        }
        
        $codError = 0;
        $menError = "OK";
    }
    
    public static function getAllMeans(&$codError, &$menError) {

        //GET MEANS
        $pMean = new \persistence\Administration\PMeans();
        $rowsMeans = $pMean->getAll();
        $arrayMeans = array();
        foreach ($rowsMeans as $m){
            $mean = new \entities\Administration\Mean();
            $mean->setIdMean($m["id_mean"]);
            $mean->setName($m["name"]);
            $mean->setMnemonic($m["mnemonic"]);
            $mean->setComponent($m["component"]);
            $mean->setDescription($m["description"]);
            $arrayMeans[count($arrayMeans)] = $mean;
        }
        
        $codError = 0;
        $menError = "OK";
        return $arrayMeans;
    }
    
    public static function saveMean($mean, &$codError, &$menError) {

        try{
            $pMean = new \persistence\Administration\PMeans();
            $pMean->saveMean((array)$mean);
            $codError = 0;
            $menError = "OK";
        } catch (Exception $e) {
            $codError->getErrorOutput()->setCodError("3");
            $menError->getErrorOutput()->setMessageError($e->getMessage());
        }
    }
    
    public static function updateMean($mean, &$codError, &$menError) {

        try{
            $pMean = new \persistence\Administration\PMeans();
            $pMean->updateMean((array)$mean);
            $codError = 0;
            $menError = "OK";
        } catch (Exception $e) {
            $codError->getErrorOutput()->setCodError("3");
            $menError->getErrorOutput()->setMessageError($e->getMessage());
        }
    }
    
    public static function deleteMean($idMean, &$codError, &$menError) {

        try{
            $pMean = new \persistence\Administration\PMeans();
            $pMean->deleteMean($idMean);
            $codError = 0;
            $menError = "OK";
        } catch (Exception $e) {
            $codError->getErrorOutput()->setCodError("3");
            $menError->getErrorOutput()->setMessageError($e->getMessage());
        }
    }
    
}
