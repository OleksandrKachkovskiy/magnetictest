<?php

 namespace Product\Model;

 class Product implements ProductInterface
 {
     protected $id;

     protected $title;
     
	 protected $description;
	 
	 protected $price;

     public function getId()
     {
         return $this->id;
     }
     public function setId($id)
     {
         $this->id = $id;
     }
     public function getTitle()
     {
         return $this->title;
     }

     public function setTitle($title)
     {
         $this->title = $title;
     }

     public function getDescription()
     {
         return $this->description;
     }

     public function setDescription($text)
     {
         $this->description = $description;
     }
	 
	 public function getPrice()
     {
         return $this->price;
     }
     public function setPrice($price)
     {
         $this->price = $price;
     }
 }