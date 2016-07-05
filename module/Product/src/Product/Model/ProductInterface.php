 <?php

 namespace Product\Model;

 interface ProductInterface
 {
   
     public function getId();
	 
     public function getTitle();

     public function getDescription();
	 
	  public function getPrice();
 }