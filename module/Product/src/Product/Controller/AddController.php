 <?php

 namespace Product\Controller;

 use Product\Service\ProductServiceInterface;
 use Zend\Form\FormInterface;
 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;

 class AddController extends AbstractActionController
 {
     protected $productService;

     protected $productForm;

     public function __construct(
         ProductServiceInterface $productService,
         FormInterface $productForm
     ) {
         $this->productService = $productService;
         $this->productForm    = $productForm;
     }

     public function addAction()
     {
         $request = $this->getRequest();

         if ($request->isPost()) {
             $this->productForm->setData($request->getPost());

             if ($this->productForm->isValid()) {
                 try {
                     $this->productService->saveProduct($this->productForm->getData());

                     return $this->redirect()->toRoute('products');
                 } catch (\Exception $e) {
                     // echo 'An error occured in AddController.php -> addAction'
                 }
             }
         }

         return new ViewModel(array(
             'form' => $this->productForm
         ));
     }
	 
	 public function editAction()
     {
         $request = $this->getRequest();
         $product    = $this->productService->findProduct($this->params('id'));

         $this->productForm->bind($product);

         if ($request->isPost()) {
             $this->productForm->setData($request->getPost());

             if ($this->productForm->isValid()) {
                 try {
                     $this->productService->saveProduct($product);

                     return $this->redirect()->toRoute('products');
                 } catch (\Exception $e) {
                     die($e->getMessage());
                     // echo 'An error occured in AddController.php -> editAction'
                 }
             }
         }

         return new ViewModel(array(
             'form' => $this->productForm
         ));
     }
 }