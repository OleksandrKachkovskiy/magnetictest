<?php

 namespace Product\Factory;

 use Product\Service\ProductService;
 use Zend\ServiceManager\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 class ProductServiceFactory implements FactoryInterface
 {
     public function createService(ServiceLocatorInterface $serviceLocator)
     {
         return new ProductService(
             $serviceLocator->get('Product\Mapper\ProductMapperInterface')
         );
     }
 }