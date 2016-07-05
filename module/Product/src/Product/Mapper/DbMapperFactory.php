<?php

 namespace Product\Factory;

 use Product\Mapper\DbMapper;
 use Product\Model\Product;
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
             new Product()
         );
     }
 }