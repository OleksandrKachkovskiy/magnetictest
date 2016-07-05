<?php
 
 return array(
      'db' => array(
         'driver'         => 'Pdo',
         'username'       => 'root',
         'password'       => '123', 
         'dsn'            => 'mysql:dbname=test;host=localhost',
         'driver_options' => array(
             \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
         )
     ),
	 'service_manager' => array(
         'factories' => array(
			 'UserDetails\Mapper\UserMapperInterface'   => 'UserDetails\Factory\DbMapperFactory',
             'UserDetails\Service\UserServiceInterface' => 'UserDetails\Factory\UserServiceFactory',
			 'Zend\Db\Adapter\Adapter'           => 'Zend\Db\Adapter\AdapterServiceFactory'
         )
     ),
      'view_manager' => array(
         'template_path_stack' => array(
             __DIR__ . '/../view',
         ),
     ),
     'controllers' => array(
        'factories' => array(
             'UserDetails\Controller\List' => 'UserDetails\Factory\ListControllerFactory'
         )
		 
     ),
     'router' => array(
         'routes' => array(
             'users' => array(
                 'type' => Literal::class,
                 'options' => array(
                     'route'    => '/users',
                     'defaults' => array(
                         'controller' => 'UserDetails\Controller\List',
                         'action'     => 'index',
                     ),
                 ),
                 'may_terminate' => true,
                 'child_routes'  => array(
                     'expand' => array(
                         'type' => 'segment',
                         'options' => array(
                             'route'    => '/:id',
                             'defaults' => array(
                                 'action' => 'expand'
                             ),
                             'constraints' => array(
                                 'id' => '[1-9]\d*'
                             )
                         )
                     )
                 )
             )
         )
     )
 );