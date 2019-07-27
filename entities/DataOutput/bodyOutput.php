<?php

namespace entities\DataOutput;
/**
 * Descripción de Body:
 *
 * 
 * 
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   10-oct-2018
 */
class bodyOutput implements \JsonSerializable {
    
    private $dataOutput;
    
    public function getDataOutput() {
        return $this->dataOutput;
    }
    
    public function setDataOutput($value) {
        return $this->dataOutput = $value;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
    
}
