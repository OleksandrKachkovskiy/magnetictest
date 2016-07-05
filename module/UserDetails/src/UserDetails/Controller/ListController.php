<?php
 
 namespace UserDetails\Controller;

 use UserDetails\Service\UserServiceInterface;
 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;

 class ListController extends AbstractActionController
 {

     protected $userService;

     public function __construct(UserServiceInterface $userService)
     {
         $this->userService = $userService;
     }

     public function indexAction()
     {
         return new ViewModel(array(
             'users' => $this->userService->findAllUsers()
         ));
     }

     public function expandAction()
     {
         return new ViewModel();
     }
 }