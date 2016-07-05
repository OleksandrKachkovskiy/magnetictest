<?php

 namespace UserDetail\Mapper;

 use UserDetails\Model\UserInterface;

 interface UserMapperInterface
 {
     public function find($id);

     public function findAll();
	 
 }