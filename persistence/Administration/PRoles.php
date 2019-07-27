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
class PRoles extends \config\Base{
    const TABLE = "roles";
    
    public function __construct(){
        parent::__construct(self::TABLE);
    }
    
    public function saveRol(array $rol){
        $query = "INSERT INTO ".self::TABLE." (name, mnemonic , description) "
                . "values (?,?,?)";

        if (!($queryExecute = $this->conn->prepare($query))) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->bind_param("sss", 
                                    $rol["name"], 
                                    $rol["mnemonic"], 
                                    $rol["description"]
                                    )) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        return $queryExecute->insert_id;
    }

    public function updateRol(array $rol){
        $query = "UPDATE ".self::TABLE." "
                . "SET NAME = ?, "
                . "MNEMONIC = ?, "
                . "DESCRIPTION = ? "
                . "WHERE ID_ROL = ? ";

        if (!($queryExecute = $this->conn->prepare($query))) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->bind_param("sssi", 
                                    $rol["name"], 
                                    $rol["mnemonic"], 
                                    $rol["description"],
                                    $rol["idRol"]
                                    )) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
    }
    
    
    public function deleteRol($idRol){
        $pRolMean = new PRolMean();
        
        $pRolMean->deleteRolMeans($idRol);
        
        $query = "DELETE FROM ".self::TABLE." "
                . "WHERE ID_ROL = ? ";

        if (!($queryExecute = $this->conn->prepare($query))) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->bind_param("i",$idRol)) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
    }
}
