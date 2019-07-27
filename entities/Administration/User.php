<?php
namespace entities\Administration;
/**
 * Descripción de User:
 *
 * 
 * 
 * @author  :   Andres Peralta
 * @email   :   gapatmej@gmail.com
 * @date    :   10-oct-2018
 */
class User implements \JsonSerializable{
    private $idUser;
    private $password;
    private $name;
    private $lastName;
    private $phone;
    private $address;
    private $photo; 
    private $roles ;
    
    function __construct(){
        $this->roles =  array();
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
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($value) {
        return $this->name = $value;
    }
    
    public function getLastName() {
        return $this->lastName;
    }
    
    public function setLastName($value) {
        return $this->lastName = $value;
    }
    
    public function getPhone() {
        return $this->phone;
    }
    
    public function setPhone($value) {
        return $this->phone = $value;
    }
    
    public function getAddress() {
        return $this->address;
    }
    
    public function setAddress($value) {
        return $this->address = $value;
    }
    
    public function getPhoto() {
        return $this->photo;
    }
    
    public function setPhoto($value) {
        return $this->photo = $value;
    }
    
    public function getRoles() {
        return $this->roles;
    }
    
    public function setRoles($value) {
        return $this->roles[count($this->roles)] = $value;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
