<?php

 namespace Product\Service;

 use Product\Model\ProductInterface;

 interface ProductServiceInterface
 {
   
     public function findAllProducts();
  
     public function findProduct($id);
	 
	 public function saveProduct(ProductInterface $product);
	 
	 public function deleteProduct(ProductInterface $product);
 }