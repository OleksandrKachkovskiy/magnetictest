<?php

 namespace UserDetails\Factory;

 use UserDetails\Controller\ListController;
 use Zend\ServiceManager\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 class ListControllerFactory implements FactoryInterface
 {
     public function createService(ServiceLocatorInterface $serviceLocator)
     {
         $realServiceLocator = $serviceLocator->getServiceLocator();
         $userService        = $realServiceLocator->get('UserDetails\Service\UserServiceInterface');
         return new ListController($userService);
     }
 }