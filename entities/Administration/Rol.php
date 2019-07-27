<?php
namespace entities\Administration;
/**
 * Descripción de Rol:
 *
 * 
 * 
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   10-oct-2018
 */
class Rol implements \JsonSerializable{
    private $idRol;
    private $name;
    private $mnemonic;
    private $description;
    private $means ;
    
    function __construct(){
        $this->means =  array();
    }
    
    public function getIdRol() {
        return $this->idRol;
    }
    
    public function setIdRol($value) {
        return $this->idRol = $value;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($value) {
        return $this->name = $value;
    }
    
    
    public function getMnemonic() {
        return $this->mnemonic;
    }
    
    public function setMnemonic($value) {
        return $this->mnemonic = $value;
    }
    
    
    public function getDescription() {
        return $this->description;
    }
    
    public function setDescription($value) {
        return $this->description = $value;
    }
    
    public function getMeans() {
        return $this->means;
    }
    
    public function setMeans($value) {
        return $this->means[count($this->means)] = $value;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
