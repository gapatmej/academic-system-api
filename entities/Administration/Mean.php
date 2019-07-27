<?php namespace entities\Administration;
/**
 * Descripción de Mean:
 *
 * 
 * 
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   10-oct-2018
 */
class Mean implements \JsonSerializable{
    private $idMean;
    private $name;
    private $mnemonic;
    private $component;
    private $description;
    
    public function getIdMean() {
        return $this->idMean;
    }
    
    public function setIdMean($value) {
        return $this->idMean = $value;
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
    
    public function getComponent() {
        return $this->component;
    }
    
    public function setComponent($value) {
        return $this->component = $value;
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function setDescription($value) {
        return $this->description = $value;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
