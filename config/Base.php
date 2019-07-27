<?php
namespace config;

require_once CONFIG.'Conexion.php';
/**
 * Descripción de Conecction:
 *
 * Clase que maneja la conexion hacia la base de datos MYSQL
 * 
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   29-jun-2018
 */
class Base extends Conexion {
    
    private $table;
    public $conn;
    
    public function __construct($value) {
        $this->table = (string) $value;
        $this->conn = Conexion::conect();
    }

    public function getConn() {
        return $this->conn;
    }
    
    public function getAll() {
        $rows = array();
        $query = "SELECT * FROM $this->table ";

        if ($result = $this->conn->query($query)) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
    
    public function getById($datatype, $id, $value) {
        $rows = array();
        
        $query = "SELECT * FROM $this->table "
                . " WHERE $id = ? ";

        if (!($queryExecute = $this->conn->prepare($query))) {

            return null;
        }

        if (!$queryExecute->bind_param("$datatype", $value)) {

            return null;
        }

        if (!$queryExecute->execute()) {

            return null;
        }

        $response = $queryExecute->get_result();
                
        while ($row = $response->fetch_array(MYSQLI_ASSOC)) {
               $rows[] = $row;
            }
        return $rows;
    }
    
}
