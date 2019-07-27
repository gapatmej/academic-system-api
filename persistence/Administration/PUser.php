<?php
namespace persistence\Administration;
require_once CONFIG.'Base.php';
require_once PERSISTENCE.'Administration/PUserRol.php';
/**
 * Descripción de PUser:
 *
 * 
 * 
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   10-oct-2018
 */
class PUser extends \config\Base{
    const TABLE = "users";
    
    public function __construct(){
        parent::__construct(self::TABLE);
    }
    /*
    public function searchByCredentials($user) {
        //return $user;
        $query = "SELECT * FROM USERS WHERE id_user = '".$user->getIdUser()
                ."' and password = '".$user->getPassword()."'";
        //return $query;
        $result = $this->conn->query($query);
        //return $query;
        $arrayRows = $result->fetch_assoc();
        return $arrayRows;
      
    }*/
    
     public function searchByCredentials($user) {
        //return $user;
        $query = "SELECT * FROM ". self::TABLE
                . " WHERE id_user = ? and password =?";
        
        if (!($queryExecute = $this->conn->prepare($query))) {
            
            return null;
        }
        
        $a = $user->getIdUser();
        $b = $user->getPassword();
        if (!$queryExecute->bind_param("ss", 
                                    $a, 
                                    $b
                                    )) {
            
            return null;
        }
        
        if (!$queryExecute->execute()) {
            return null;
        }
      
        $data = $queryExecute->get_result();
        $row = $data->fetch_assoc();
        return $row;
    }
    
     public function saveUser(array $user){
        $query = "INSERT INTO ".self::TABLE." (id_user, password , name, last_name, phone, address) "
                . "values (?,?,?,?,?,?)";

        if (!($queryExecute = $this->conn->prepare($query))) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->bind_param("ssssss",
                                    $user["idUser"], 
                                    $user["password"], 
                                    $user["name"], 
                                    $user["lastName"], 
                                    $user["phone"],
                                    $user["address"]
                                    )) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
    }
    
    public function updateUser(array $user){
        $query = "UPDATE ".self::TABLE." "
                . "SET PASSWORD = ?, "
                . "NAME = ?, "
                . "LAST_NAME = ?, "
                . "PHONE = ?, "
                . "ADDRESS = ? "
                . "WHERE ID_USER = ? ";

        if (!($queryExecute = $this->conn->prepare($query))) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->bind_param("ssssss", 
                                    $user["password"], 
                                    $user["name"], 
                                    $user["lastName"],
                                    $user["phone"],
                                    $user["address"],
                                    $user["idUser"]
                                    )) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
    }
    
     public function deleteUser($idUser){
        $pUserRol = new PUserRol();
        
        $pUserRol->deleteUserRoles($idUser);
        
        $query = "DELETE FROM ".self::TABLE." "
                . "WHERE ID_USER = ? ";

        if (!($queryExecute = $this->conn->prepare($query))) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->bind_param("s",$idUser)) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
    }
    
}
