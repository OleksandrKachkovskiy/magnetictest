<?php

namespace Product\Form;

use Product\Model\Product;
 use Zend\Form\Fieldset;
 use Zend\Stdlib\Hydrator\ClassMethods;

class ProductFields extends Fieldset
{
   public function __construct($name = null, $options = array())
     {
         parent::__construct($name, $options);
		 
		 $this->setHydrator(new ClassMethods(false));
         $this->setObject(new Product());
		 
      $this->add(array(
         'type' => 'hidden',
         'name' => 'id'
      ));

      $this->add(array(
         'type' => 'text',
         'name' => 'description',
         'options' => array(
           'label' => 'Description'
         )
      ));
	  
	  $this->add(array(
         'type' => 'text',
         'name' => 'price',
         'options' => array(
            'label' => 'Product price'
         )
      ));

      $this->add(array(
         'type' => 'text',
         'name' => 'title',
         'options' => array(
            'label' => 'Product title'
         )
      ));
   }
}