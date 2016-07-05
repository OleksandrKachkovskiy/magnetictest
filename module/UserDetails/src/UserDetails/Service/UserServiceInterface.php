<?php

 namespace UserDetail\Service;

 use UserDetail\Model\UserInterface;

 interface UserServiceInterface
 {
     public function findAllUsers();
  
     public function findUser($id); 
 }