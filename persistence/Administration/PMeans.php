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
class PMeans extends \config\Base{
    const TABLE = "means";
    
    public function __construct(){
        parent::__construct(self::TABLE);
    }
    
     public function saveMean(array $mean){
        $query = "INSERT INTO ".self::TABLE." (name, mnemonic , component, description) "
                . "values (?,?,?,?)";

        if (!($queryExecute = $this->conn->prepare($query))) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->bind_param("ssss", 
                                    $mean["name"], 
                                    $mean["mnemonic"], 
                                    $mean["component"],
                                    $mean["description"]
                                    )) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
    }
    
    public function updateMean(array $mean){
        $query = "UPDATE ".self::TABLE." "
                . "SET NAME = ?, "
                . "MNEMONIC = ?, "
                . "COMPONENT = ?, "
                . "DESCRIPTION = ? "
                . "WHERE ID_MEAN = ? ";

        if (!($queryExecute = $this->conn->prepare($query))) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->bind_param("sssss", 
                                    $mean["name"], 
                                    $mean["mnemonic"], 
                                    $mean["component"],
                                    $mean["description"],
                                    $mean["idMean"]
                                    )) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        if (!$queryExecute->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
    }
    
    public function deleteMean($idMean){
        $query = "DELETE FROM ".self::TABLE." "
                . "WHERE ID_MEAN = ? ";

        if (!($queryExecute = $this->conn->prepare($query))) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->bind_param("i",$idMean)) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
    }
}
