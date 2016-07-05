<?php

 namespace UserDetail\Service;

 use UserDetail\Mapper\UserMapperInterface;

 class UserService implements UserServiceInterface
 {
   
     protected $userMapper;

     public function __construct(UserMapperInterface $userMapper)
     {
         $this->userMapper = $userMapper;
     }

     public function findUsers()
     {
		return $this->userMapper->findAll();
     }

     public function findUser($id)
     {
		return $this->userMapper->find($id);
     } 
 }