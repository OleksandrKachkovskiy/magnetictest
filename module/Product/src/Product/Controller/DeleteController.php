<?php
 // Filename: /module/Blog/src/Blog/Controller/DeleteController.php
 namespace Product\Controller;

 use Product\Service\ProductServiceInterface;
 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;

 class DeleteController extends AbstractActionController
 {
     /**
      * @var \Blog\Service\PostServiceInterface
      */
     protected $productService;

     public function __construct(ProductServiceInterface $productService)
     {
         $this->productService = $productService;
     }

     public function deleteAction()
     {
         try {
             $post = $this->roductService->findProduct($this->params('id'));
         } catch (\InvalidArgumentException $e) {
             return $this->redirect()->toRoute('products');
         }

         $request = $this->getRequest();

         if ($request->isPost()) {
             $delete = $request->getPost('delete_confirmation', 'no');

             if ($delete === 'yes') {
                 $this->productService->deleteProduct($product);
             }

             return $this->redirect()->toRoute('products');
         }

         return new ViewModel(array(
             'product' => $product
         ));
     }
 }