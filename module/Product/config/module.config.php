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
		/* 'invokables' => array(
             'Product\Service\ProductServiceInterface' => 'Product\Service\ProductService'
		 ),*/
         'factories' => array(
			 'Product\Mapper\ProductMapperInterface'   => 'Product\Factory\DbMapperFactory',
             'Product\Service\ProductServiceInterface' => 'Product\Factory\ProductServiceFactory',
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
             'Product\Controller\ListController' => 'Product\Factory\ListControllerFactory',
			 'Product\Controller\Add' => 'Product\Factory\AddControllerFactory',
			 'Product\Controller\Delete' => 'Product\Factory\DeleteControllerFactory'
         )
		 
     ),
     'router' => array(
         'routes' => array(
             'products' => array(
                 'type' => Literal::class,
                 'options' => array(
                     'route'    => '/products',
                     'defaults' => array(
                         'controller' => 'Product\Controller\ListController',
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
                     ),
					     'add' => array(
                         'type' => Literal::class,
                         'options' => array(
                             'route'    => '/add',
                             'defaults' => array(
                                 'controller' => 'Product\Controller\Add',
                                 'action'     => 'add'
                             )
                         )
                     ),
					 'edit' => array(
                         'type' => 'segment',
                         'options' => array(
                             'route'    => '/edit/:id',
                             'defaults' => array(
                                 'controller' => 'Product\Controller\Add',
                                 'action'     => 'edit'
                             ),
                             'constraints' => array(
                                 'id' => '\d+'
                             )
                         )
                     ),
					 'delete' => array(
                         'type' => 'segment',
                         'options' => array(
                             'route'    => '/delete/:id',
                             'defaults' => array(
                                 'controller' => 'Product\Controller\Delete',
                                 'action'     => 'delete'
                             ),
                             'constraints' => array(
                                 'id' => '\d+'
                             )
                         )
                     )
                 )
             )
         )
     )
 );