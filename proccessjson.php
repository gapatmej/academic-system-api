<?php
require_once 'config/Config.php';
require_once 'config/Sessions.php';
require_once ENTITIES."DataOutPut/jsonOutput.php";
require_once BUSINESS."Administration/NUser.php";
            
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

use entities\DataOutput as EDataOuput;

// Functions for control error_reporting
set_error_handler('exceptions_error_handler');
function exceptions_error_handler($severity, $message, $filename, $lineno) {
  if (error_reporting() == 0) {
    return;
  }
  if (error_reporting() & $severity) {
    throw new ErrorException($message, 0, $severity, $filename, $lineno);
  }
}

// We make a cast of the input Json to verify its correct
try{
    $jsonOuput = new EDataOuput\jsonOutput();
    $jsonString = file_get_contents('php://input');
    $proccessJson = json_decode($jsonString);
    $header = $proccessJson->header;
    $body = $proccessJson->body; 
    
    //Header parameters
    $modulo = $header->module;
    $tipoTransaccion = $header->transaction;
    $fecha = $header->date;
    
    //Body parameters
    $input = $body->dataInput;
    
} catch (Exception $e) {
    
    $jsonOuput->getError()->setCodError("1");
    $jsonOuput->getError()->setMessageError("Input format is wrong");
    echo json_encode($jsonOuput);
    return;
}

// Logical services
//try{
    //Fill the header
    $jsonOuput->getHeaderOutput()->setModulo($header->module); 
    $jsonOuput->getHeaderOutput()->setTransacction($header->transaction);
    $jsonOuput->getHeaderOutput()->setDate($header->date); 
    $jsonOuput->getHeaderOutput()->setIdUser($header->idUser);
    $jsonOuput->getHeaderOutput()->setPassword($header->password);
    
    $codError = null;
    $menError = null;
    $data = null;
    sleep(2);
    if(!verifySession($header->idUser, $header->password) ){
        echo "Usuario Incorrecto";
        return;
    }
    
    switch($tipoTransaccion)
    {
        case 'loginService001':
            require_once ENTITIES."Administration/User.php";
            $user = new entities\Administration\User();
            $user->setIdUser($header->idUser);
            $user->setPassword($header->password);
            $data = business\Administration\NUser::login($user, $codError, $menError);
            break;
        case 'getAllMeansService001':
            require_once BUSINESS."Administration/NMean.php";
            $data = business\Administration\NMean::getAllMeans($codError, $menError);
            break;
        case 'saveMeanService001':
            require_once ENTITIES."Administration/Mean.php";
            require_once BUSINESS."Administration/NMean.php";
            $mean = $input;
            business\Administration\NMean::saveMean($mean, $codError, $menError);
            break;
        case 'updateMeanService001':
            require_once ENTITIES."Administration/Mean.php";
            require_once BUSINESS."Administration/NMean.php";
            $mean = $input;
            business\Administration\NMean::updateMean($mean, $codError, $menError);
            break;
        case 'deleteMeanService001':
            require_once BUSINESS."Administration/NMean.php";
            $idMean = $input->idMean;
            business\Administration\NMean::deleteMean($idMean, $codError, $menError);
            break;
       case 'getAllRolesService001':
            require_once BUSINESS."Administration/NRol.php";
            $data = business\Administration\NRol::getAllRoles($codError, $menError);
            break;
       case 'saveRolService001':
            require_once BUSINESS."Administration/NRol.php";
            $rol = $input;
            business\Administration\NRol::saveRol((array) $rol, $codError, $menError);
            break;
       case 'updateRolService001':
            require_once BUSINESS."Administration/NRol.php";
            $rol = $input;
            business\Administration\NRol::updateRol((array) $rol, $codError, $menError);
            break;
       case 'deleteRolService001':
            require_once BUSINESS."Administration/NRol.php";
            $idRol = $input->idRol;
            business\Administration\NRol::deleteRol($idRol, $codError, $menError);
            break;
       case 'getAllUsersService001':
            require_once BUSINESS."Administration/NUser.php";
            $data = business\Administration\NUser::getAllUsers($codError, $menError);
            break;
       case 'saveUserService001':
            require_once BUSINESS."Administration/NUser.php";
            $user = $input;
            business\Administration\NUser::saveUser((array) $user, $codError, $menError);
            break;
        case 'updateUserService001':
            require_once BUSINESS."Administration/NUser.php";
            $user = $input;
            $data = business\Administration\NUser::updateUser((array) $user, $codError, $menError);
            break;
        case 'deleteUserService001':
            require_once BUSINESS."Administration/NUser.php";
            $idUser = $input->idUser;
            business\Administration\NUser::deleteUser($idUser, $codError, $menError);
            break;
        default:
            $codError = "2";
            $menError = "Transacction not found";
            break;     
    }
    
    $jsonOuput->getBodyOutput()->setDataOutput($data);
    $jsonOuput->getError()->setCodError($codError);
    $jsonOuput->getError()->setMessageError($menError);

    echo json_encode($jsonOuput);
    
/*} catch (Exception $e) {
    $jsonOuput->getError()->setCodError("3");
    $jsonOuput->getError()->setMessageError("Error en la aplicación. Por favor contacte al Administrador del Sitio");
    echo json_encode($jsonOuput);
    return;
}*/
    
    
function verifySession($idUser, $password ) {
    require_once ENTITIES."Administration/User.php";
    $user = new entities\Administration\User();
    $user->setIdUser($idUser);
    $user->setPassword($password);
    return business\Administration\NUser::verifyUser($user); 
}


?>