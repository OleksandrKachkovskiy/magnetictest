<?php
namespace Auth\Form;

use Zend\Form\Form;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;   

class LoginFilter extends InputFilter
{
    public function __construct()
    {
       
        $factory=new InputFactory();

        $this->add($factory->createInput(array(
            'name'     => 'email',
            'required' => true,
            'filters'  => array(
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name'=>'EmailAddress'),
            ),
        )));

        $this->add($factory->createInput(array(
            'name'     => 'password',
            'required' => true,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 5,
                        'max'      => 30,
                    ),
                ),
            ),
        )));
		
    }
}