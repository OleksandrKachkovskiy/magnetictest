<?php

 namespace Product\Form;

 use Zend\Form\Form;

 class ProductForm extends Form
 {
      public function __construct($name = null, $options = array())
     {
         parent::__construct($name, $options);
		 
         $this->add(array(
             'name' => 'product-fields',
             'type' => 'Product\Form\ProductFields',
			 'options' => array(
                 'use_as_base_fieldset' => true
             )
         ));

         $this->add(array(
             'type' => 'submit',
             'name' => 'submit',
             'attributes' => array(
                 'value' => 'Add new product'
             )
         ));
     }
 }