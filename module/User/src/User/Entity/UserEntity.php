<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace User\Entity;

use Zend\Filter\StaticFilter;
use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class UserEntity implements UserEntityInterface{

    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;
    /** @ORM\Column(type="string") */
    protected $username;
    /** @ORM\Column(type="string") */
    protected $password;
    /** @ORM\Column(type="string") */
    protected $salt;
    
     /**
     * @ORM\ManyToOne(targetEntity="RoleEntity")
     * @ORM\JoinColumn(name="roleID", referencedColumnName="roleID", nullable=false)
     **/
    protected $role;
    
    public function exchangeArray(array $array) {
        foreach ($array as $key => $value) {
            if (empty($value)) {
                continue;
            }
            $method = 'set' . StaticFilter::execute(
                $key, 'wordunderscoretocamelcase'
            );
            if (!method_exists($this, $method)) {
                continue;
            }
            $this->$method($value);
        }
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

    public function getPassword() {
        return $this->password;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    
    public function setSalt($salt){
        $this->salt = $salt;
        return $this;
    }
    
    public function getSalt(){
        return $this->salt;
    }
    
    public function setRole($role){
        $this->role = $role;
        return $this;
    }
    
    public function getRole(){
        return $this->role;
    }

}
