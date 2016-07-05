<?php

 namespace UserDetails\Factory;

 use UserDetails\Mapper\DbMapper;
 use UserDetails\Model\User;
 use Zend\ServiceManager\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;
 use Zend\Stdlib\Hydrator\ClassMethods;

 class DbMapperFactory implements FactoryInterface
 {

     public function createService(ServiceLocatorInterface $serviceLocator)
     {
         return new DbMapper(
             $serviceLocator->get('Zend\Db\Adapter\Adapter'),
             new ClassMethods(false),
             new User()
         );
     }
 }