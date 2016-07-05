<?php
namespace Auth\Form;

use Zend\Form\Form;

class SignupForm extends Form
{
    public function __construct()
    {
        parent::__construct('signup');
        $this->setAttribute('method', 'post');
        
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'text',
            ),
        ));
        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type'  => 'password',
            ),
        ));
        $this->add(array(
            'name' => 'passwordConfirm',
            'attributes' => array(
                'type'  => 'password',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Sign Up',
                'id' => 'submitbutton',
            ),
        ));
        
    }
}