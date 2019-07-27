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
class PRolMean extends \config\Base{
    const TABLE = "roles_means";
    const TABLE_R1 = "roles";
    const TABLE_R2 = "means";
    
    public function __construct(){
        parent::__construct(self::TABLE);
    }
    
    public function getMeansByRol($rol) {
        
        $query = "select * from ".self::TABLE. " rm , ".self::TABLE_R2. " m where 
                    rm.id_mean = m.id_mean and rm.id_rol = ? ";
        
        if (!($queryExecute = $this->conn->prepare($query))) {
            return null;
        }
        
        $a = $rol->getIdRol();
        //$a = "100";
        if (!$queryExecute->bind_param("s", 
                                    $a
                                    )) {
            return null;
        }
        
        if (!$queryExecute->execute()) {
            return null;
        }
        
        $data = $queryExecute->get_result();
        
        $rows = array();
        while ($row = $data->fetch_array(MYSQLI_ASSOC)) {
            $rows[] = $row;
        }
        
        return $rows;
    }
    
     public function saveRolMeans($idRol, $idMean){
         
        $query = "INSERT INTO ".self::TABLE." (id_rol, id_mean) "
                . "values (?,?)";

        if (!($queryExecute = $this->conn->prepare($query))) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->bind_param("ii", 
                                    $idRol, 
                                    $idMean 
                                    )) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
    }
    
    public function deleteRolMeans($idRol){
         
        $query = "DELETE FROM ".self::TABLE." "
                . "WHERE ID_ROL = ?";

        if (!($queryExecute = $this->conn->prepare($query))) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->bind_param("i", 
                                    $idRol
                                    )) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
        
        if (!$queryExecute->execute()) {
            throw new \Exception($this->conn->error, $this->conn->errno);
        }
    }
}
