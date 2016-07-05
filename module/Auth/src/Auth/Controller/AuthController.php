<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Auth\Controller;


//FORM
//---- SIGNUP
use Auth\Form\SignupForm;
use Auth\Form\SignupFilter;
//---- LOGIN
use Auth\Form\LoginForm;
use Auth\Form\LoginFilter;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController
{
    public function signupAction()
    {
        $form = new SignupForm();
        
        $view=new ViewModel(array(
            'form' => $form,
        ));
        return $view;
    }
    
    public function loginAction()
    {
        $form = new LoginForm();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            
            $form->setInputFilter(new LoginFilter());
            $form->setData($request->getPost());
            //$userIp = $request->getServer('REMOTE_ADDR'); <- can't make it work
            if($form->isValid()){
                $user=new User();
                $user->hydrate($form->getData());
                $user->cryptPassword();
                $user->hydrateByLogin();
                if($user->get("id")>0){
                    $this->getAuthService()->setUser($user);
                }
                var_dump($user->get("id")>0);
            }
        }
        
        $view=new ViewModel(array(
            'form' => $form,
        ));
        return $view;
    }
}
