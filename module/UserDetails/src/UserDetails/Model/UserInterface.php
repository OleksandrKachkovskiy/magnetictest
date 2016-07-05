 <?php

 namespace UserDetails\Model;

 interface UserInterface
 {
   
     public function getId();
	 
     public function getName();

     public function getEmail();
	 
	  public function getPassword();
	  
	  public function getIp();
 }