<?php
namespace entities\DataOutput;

require_once "headerOutput.php";
require_once "bodyOutput.php";
require_once "errorOutput.php";

/**
 * Descripción de JsonOutput:
 *
 * 
 * 
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   10-oct-2018
 */
class jsonOutput implements \JsonSerializable {
    private $headerOutput;
    private $bodyOutput;
    private $error;
            
    function __construct() {
        $this->headerOutput = new headerOutput();
        $this->bodyOutput = new bodyOutput();
        $this->error = new errorOutput();
   }
   
    public function getHeaderOutput() {
        return $this->headerOutput;
    }
    
    public function setHeaderOutput($value) {
        $this->headerOutput = $value; 
    }
    
    public function getBodyOutput() {
        return $this->bodyOutput;
    }
    
    public function setBodyOutput($value) {
        $this->bodyOutput = $value; 
    }
    
    public function getError() {
        return $this->error;
    }
    
    public function setError($value) {
        $this->error = $value; 
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
