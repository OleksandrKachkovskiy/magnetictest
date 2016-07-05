<?php

 namespace Product\Service;

 use Product\Mapper\ProductMapperInterface;

 class ProductService implements ProductServiceInterface
 {
   
     protected $productMapper;

     public function __construct(ProductMapperInterface $productMapper)
     {
         $this->productMapper = $productMapper;
     }

     public function findAllProducts()
     {
		return $this->productMapper->findAll();
     }

     public function findProduct($id)
     {
		return $this->productMapper->find($id);
     }
	 
	 public function saveProduct(ProductInterface $product)
     {
         return $this->productMapper->save($product);
     }
	 
	 public function deleteProduct(ProductInterface $product)
     {
         return $this->productMapper->delete($product);
     }
 }