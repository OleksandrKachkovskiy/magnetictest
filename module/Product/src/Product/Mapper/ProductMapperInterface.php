<?php

 namespace Product\Mapper;

 use Product\Model\ProductInterface;

 interface ProductMapperInterface
 {
     public function find($id);

     public function findAll();
	 
	  public function save(ProductInterface $productObject);
	  
	  public function delete(ProductInterface $productObject);
 }