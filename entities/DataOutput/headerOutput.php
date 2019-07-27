<?php
namespace entities\DataOutput;
/**
 * Descripción de Header:
 *
 * 
 * 
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   10-oct-2018
 */
class headerOutput implements \JsonSerializable {
    private $module;
    private $transaction;
    private $date;
    private $idUser;
    private $password;
    
    public function getModulo() {
        return $this->module;
    }
    
    public function setModulo($value) {
        return $this->module = $value;
    }
    
    public function getTransacction() {
        return $this->transaction;
    }
    
    public function setTransacction($value) {
        return $this->transaction = $value;
    }
    
    public function getDate() {
        return $this->date;
    }
    
    public function setDate($value) {
        return $this->date = $value;
    }
    
    public function getIdUser() {
        return $this->idUser;
    }
    
    public function setIdUser($value) {
        return $this->idUser = $value;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function setPassword($value) {
        return $this->password = $value;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
        
}
