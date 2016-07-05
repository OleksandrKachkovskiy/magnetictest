 <?php

 namespace Product\Factory;

 use Product\Controller\AddController;
 use Zend\ServiceManager\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 class AddControllerFactory implements FactoryInterface
 {
     public function createService(ServiceLocatorInterface $serviceLocator)
     {
         $realServiceLocator = $serviceLocator->getServiceLocator();
         $productService = $realServiceLocator->get('Product\Service\ProductServiceInterface');
         $productForm     = $realServiceLocator->get('FormElementManager')->get('Product\Form\ProductForm');

         return new WriteController(
             $productService,
             $productForm
         );
     }
 }