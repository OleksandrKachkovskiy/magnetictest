<?php
 // Filename: /module/Blog/src/Blog/Factory/DeleteControllerFactory.php
 namespace Product\Factory;

 use Product\Controller\DeleteController;
 use Zend\ServiceManager\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 class DeleteControllerFactory implements FactoryInterface
 {

     public function createService(ServiceLocatorInterface $serviceLocator)
     {
         $realServiceLocator = $serviceLocator->getServiceLocator();
         $productService        = $realServiceLocator->get('Product\Service\ProductServiceInterface');

         return new DeleteController($productService);
     }
 }