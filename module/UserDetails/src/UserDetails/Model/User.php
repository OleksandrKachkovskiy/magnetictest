<?php

 namespace UserDetails\Model;

 class User implements UserInterface
 {
     protected $id;

     protected $name;
     
	 protected $email;
	 
	 protected $password;
	 
	 protected $ip;

     public function getId()
     {
         return $this->id;
     }
     public function setId($id)
     {
         $this->id = $id;
     }
     public function getName()
     {
         return $this->name;
     }

     public function setName($name)
     {
         $this->name = $name;
     }

     public function getEmail()
     {
         return $this->email;
     }

     public function setEmail($text)
     {
         $this->email = $email;
     }
	 
	 public function getPassword()
     {
         return $this->password;
     }
     public function setPassword($password)
     {
         $this->password = $password;
     }
	 
	 public function getIp()
     {
         return $this->ip;
     }
     public function setIp($ip)
     {
         $this->ip = $ip;
     }
 }