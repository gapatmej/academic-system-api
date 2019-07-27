<?php
namespace business\Administration;
require_once PERSISTENCE.'Administration/PUser.php';
require_once BUSINESS.'Administration/NRol.php';
require_once ENTITIES.'Administration/User.php';

/**
 * Descripción de NUsuario:
 *
 * 
 * 
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   10-oct-2018
 */
class NUser {

    public static function login($user, &$codError, &$menError) {

        //VALIDATE USER
        $pUser = new \persistence\Administration\PUser();
        $rowUser = $pUser->searchByCredentials($user);
        //return $rowUser;
        if($rowUser == null){
            $codError = "5";
            $menError = "Usuario no encontrado";
            return null;
        }else {
            $user->setName($rowUser["name"]);
            $user->setLastName($rowUser["last_name"]);
            $user->setPhone($rowUser["phone"]);
            $user->setAddress($rowUser["address"]);
            $user->setPhoto(base64_encode($rowUser["photo"]));
        }
          
        //GET ROLES
        NRol::getRolesByUser($user, $codError, $menError);

        $codError = $codError;
        return $user;
        
    }
    
    public static function verifyUser($user){
        $pUser = new \persistence\Administration\PUser();
        if($pUser->searchByCredentials($user))
            return true;
        else
            return false;
    }
    
    public static function getAllUsers(&$codError, &$menError) {
        $arrayUsers = array();
        //GET ROLES
        $pUser = new \persistence\Administration\PUser();
        $rowsUsers = $pUser->getAll();

        foreach ($rowsUsers as $u){
            $user = new \entities\Administration\User();
            $user->setIdUser($u["id_user"]);
            $user->setPassword($u["password"]);
            $user->setName($u["name"]);
            $user->setLastName($u["last_name"]);
            $user->setPhone($u["phone"]);
            $user->setAddress($u["address"]);
            $user->setPhoto(base64_encode($u["photo"]));
            NRol::getRolesWhitoutMeasnByUser($user, $codError, $menError);
            array_push($arrayUsers,$user);
        }
        $codError = 0;
        $menError = "OK"; 
        return $arrayUsers;
    }
    
    public static function saveUser( array $user, &$codError, &$menError){
         try{
            $pUser = new \persistence\Administration\PUser();
            $pUser->saveUser($user);

            $pUserRol = new \persistence\Administration\PUserRol();
            foreach ($user["roles"] as $r){
                $r = (array) $r;
                $pUserRol->saveUserRoles($user["idUser"], $r["idRol"]);
            }   
            $codError = 0;
            $menError = "OK";
        } catch (Exception $e) {
            $codError->getErrorOutput()->setCodError("3");
            $menError->getErrorOutput()->setMessageError($e->getMessage());
        }
    }
    
    public static function updateUser(array $user, &$codError, &$menError){
         try{
            $pUser = new \persistence\Administration\PUser();
            $pUser->updateUser($user);

            $pUserRol = new \persistence\Administration\PUserRol();
            
            $pUserRol->deleteUserRoles($user["idUser"]);
            
            foreach ($user["roles"] as $r){
                $r = (array) $r;
                $pUserRol->saveUserRoles($user["idUser"], $r["idRol"]);
            }  
            
            $codError = 0;
            $menError = "OK";
        } catch (Exception $e) {
            $codError->getErrorOutput()->setCodError("3");
            $menError->getErrorOutput()->setMessageError($e->getMessage());
        }
    }
    
    public static function deleteUser($idUser, &$codError, &$menError){
         try{
            $pUser = new \persistence\Administration\PUser();
            $pUser->deleteUser($idUser);
            
            $codError = 0;
            $menError = "OK";
        } catch (Exception $e) {
            $codError->getErrorOutput()->setCodError("3");
            $menError->getErrorOutput()->setMessageError($e->getMessage());
        }
    }
}
