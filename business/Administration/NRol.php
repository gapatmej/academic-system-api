<?php
namespace business\Administration;
require_once PERSISTENCE.'Administration/PUserRol.php';
require_once PERSISTENCE.'Administration/PRoles.php';
require_once PERSISTENCE.'Administration/PRolMean.php';
require_once ENTITIES.'Administration/Rol.php';
require_once ENTITIES.'Administration/Mean.php';
require_once BUSINESS.'Administration/NMean.php';
/**
 * Descripción de NRol:
 *
 * 
 * 
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   10-oct-2018
 */
class NRol {
    
    public static function getRolesWhitoutMeasnByUser($user, &$codError, &$menError) {

        //GET ROLES
        $pUserRol = new \persistence\Administration\PUserRol();
        $rowsRoles = $pUserRol->getRolesByUser($user);
        
        foreach ($rowsRoles as $r){
            $rol = new \entities\Administration\Rol();
            $rol->setIdRol($r["id_rol"]);
            $rol->setDescription($r["description"]);
            $rol->setName($r["name"]);
            $rol->setMnemonic($r["mnemonic"]);
            $user->setRoles($rol);
        }
        
        $codError = $codError;
        $menError = "OK"; 
    }
    
    public static function getRolesByUser($user, &$codError, &$menError) {

        //GET ROLES
        $pUserRol = new \persistence\Administration\PUserRol();
        $rowsRoles = $pUserRol->getRolesByUser($user);
        
        foreach ($rowsRoles as $r){
            $rol = new \entities\Administration\Rol();
            $rol->setIdRol($r["id_rol"]);
            $rol->setDescription($r["description"]);
            $rol->setName($r["name"]);
            $rol->setMnemonic($r["mnemonic"]);
            NMean::getMeansByRol($rol, $codError, $menError);
            $user->setRoles($rol);
        }
        
        $codError = $codError;
        $menError = "OK"; 
    }
    
    public static function getAllRoles( &$codError, &$menError) {
        $arrayRoles = array();
        //GET ROLES
        $pRoles = new \persistence\Administration\PRoles();
        $rowsRoles = $pRoles->getAll();
        
        foreach ($rowsRoles as $r){
            $rol = new \entities\Administration\Rol();
            $rol->setIdRol($r["id_rol"]);
            $rol->setDescription($r["description"]);
            $rol->setName($r["name"]);
            $rol->setMnemonic($r["mnemonic"]);
            NMean::getMeansByRol($rol, $codError, $menError);
            array_push($arrayRoles,$rol);
        }
        $codError = 0;
        $menError = "OK"; 
        return $arrayRoles;
    }
    
    public static function saveRol( array $rol, &$codError, &$menError){
         try{
            $pRol = new \persistence\Administration\PRoles();
            $idRol = $pRol->saveRol($rol);

            $pRolMean = new \persistence\Administration\PRolMean();
            foreach ($rol["means"] as $m){
                $m = (array) $m;
                $pRolMean->saveRolMeans($idRol, $m["idMean"]);
            }       
            $codError = 0;
            $menError = "OK";
        } catch (Exception $e) {
            $codError->getErrorOutput()->setCodError("3");
            $menError->getErrorOutput()->setMessageError($e->getMessage());
        }
    }
    
    public static function updateRol(array $rol, &$codError, &$menError){
         try{
            $pRol = new \persistence\Administration\PRoles();
            $pRol->updateRol($rol);

            $pRolMean = new \persistence\Administration\PRolMean();
            $pRolMean->deleteRolMeans($rol["idRol"]);
            
            foreach ($rol["means"] as $m){
                $m = (array) $m;
                $pRolMean->saveRolMeans($rol["idRol"], $m["idMean"]);
            }   
            
            $codError = 0;
            $menError = "OK";
        } catch (Exception $e) {
            $codError->getErrorOutput()->setCodError("3");
            $menError->getErrorOutput()->setMessageError($e->getMessage());
        }
    }
    
    public static function deleteRol($idRol, &$codError, &$menError){
         try{
            $pRol = new \persistence\Administration\PRoles();
            $pRol->deleteRol($idRol);
            
            $codError = 0;
            $menError = "OK";
        } catch (Exception $e) {
            $codError->getErrorOutput()->setCodError("3");
            $menError->getErrorOutput()->setMessageError($e->getMessage());
        }
    }
    
}
