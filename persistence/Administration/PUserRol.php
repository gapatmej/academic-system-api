<?php
namespace persistence\Administration;
require_once CONFIG.'Base.php';
/**
 * Descripción de PRol:
 *
 * 
 * 
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   11-oct-2018
 */
class PUserRol extends \config\Base{
    const TABLE = "users_roles";
    const TABLE_R1 = "users";
    const TABLE_R2 = "roles";
    
    public function __construct(){
        parent::__construct(self::TABLE);
    }
    
    public function getRolesByUser($user) {
        $rows = array();
        $query = "select * from ".self::TABLE. " ur , ".self::TABLE_R2. " r where 
                    r.id_rol = ur.id_rol and id_user = ? ";
        if (!($queryExecute = $this->conn->prepare($query))) {
            return null;
        }
        
        $a = $user->getIdUser();
        if (!$queryExecute->bind_param("s", 
                                    $a
                                    )) {
            return null;
        }
        
        if (!$queryExecute->execute()) {
            return null;
        }
        
        $data = $queryExecute->get_result();
        
        while ($row = $data->fetch_array(MYSQLI_ASSOC)) {
            $rows[] = $row;
        }
        
        return $rows;
    }
    
    public function saveUserRoles($idUser, $idRol){
         
        $query = "INSERT INTO ".self::TABLE." (id_user, id_rol) "
                . "values (?,?)";

        if (!($queryExecute = $this->conn->prepare($query))) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->bind_param("si", 
                                    $idUser, 
                                    $idRol 
                                    )) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
    }
    
    public function deleteUserRoles($idUser){
         
        $query = "DELETE FROM ".self::TABLE." "
                . "WHERE ID_USER = ?";

        if (!($queryExecute = $this->conn->prepare($query))) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->bind_param("s", 
                                    $idUser
                                    )) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
    }

}
