<?php

 namespace Product\Controller;

 use Product\Service\ProductServiceInterface;
 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\Mvc\Controller\AbstractActionController;
 
 use Zend\Stdlib\DispatchableInterface;
 use Zend\Stdlib\RequestInterface as Request;
 use Zend\Stdlib\ResponseInterface as Response;

 
 class ListController extends AbstractActionController implements DispatchableInterface
 {
	public function dispatch(Request $request, Response $response = null)
    {
        return $response;
    }
     protected $productService;

     public function __construct(ProductServiceInterface $productService)
     {
         $this->productService = $productService;
     }
	 
	  public function indexAction()
     {
         return new ViewModel(array(
             'products' => $this->productService->findAllProducts()
         ));
     }

	 public function expandAction()
     {
         $id = $this->params()->fromRoute('id');

         try {
             $product = $this->productService->findProduct($id);
         } catch (\InvalidArgumentException $ex) {
             return $this->redirect()->toRoute('products');
         }

         return new ViewModel(array(
             'product' => $product
         ));
     }
 }