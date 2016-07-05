<?php
namespace Auth\Form;

use Zend\Form\Form;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;   

class SignupFilter extends InputFilter
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
                array(
                    'name'=>'Zend\Validator\Db\NoRecordExists',
                    'options'=>array(
                        'adapter'=>\Application\DBAdapter\MainDatabaseGetter::get(),
                        'table'=>'client',
                        'field'=>'email'
                    )
                )
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
        
        $this->add($factory->createInput(array(
            'name'     => 'passwordConfirm',
            'required' => true,
            'validators' => array(
                array(
                    'name'=>'identical',
                    'options'=> array(
                        'token' => 'password'
                    ),
                ),
            ),
        )));

       $this->add($factory->createInput(array(
            'name'     => 'ip',
            'required' => true,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 16, //IPv4
                        'max'      => 45, // IPv6
                    ),
                ),
            ),
        )));
    }
}