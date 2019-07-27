<?php
namespace entities\DataOutput;
/**
 * Descripción de errorOutput:
 *
 * 
 * 
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   10-oct-2018
 */
class errorOutput implements \JsonSerializable {
    private $codError;
    private $messageError;
    
    public function getCodError() {
        return $this->codError;
    }
    
    public function setCodError($value) {
        $this->codError = $value; 
    }
    
    public function getMessageError() {
        return $this->messageError;
    }
    
    public function setMessageError($value) {
        $this->messageError = $value; 
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
