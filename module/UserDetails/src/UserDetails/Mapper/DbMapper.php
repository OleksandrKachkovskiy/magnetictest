<?php

 namespace User\Mapper;

 use User\Model\UserInterface;
 use Zend\Db\Adapter\AdapterInterface;
 use Zend\Db\Adapter\Driver\ResultInterface;
 use Zend\Db\ResultSet\HydratingResultSet;
 use Zend\Db\Sql\Sql;
 use Zend\Db\Sql\Insert;
 use Zend\Db\Sql\Update;
 use Zend\Stdlib\Hydrator\HydratorInterface;

 class DbMapper implements UserMapperInterface
 {
     protected $dbAdapter;
	 protected $hydrator;
	 protected $userPrototype;

     public function __construct(
         AdapterInterface $dbAdapter,
         HydratorInterface $hydrator,
         UserInterface $userPrototype
     ) {
         $this->dbAdapter      = $dbAdapter;
         $this->hydrator       = $hydrator;
         $this->userPrototype  = $userPrototype;
     }

     public function find($id)
     {
         $sql    = new Sql($this->dbAdapter);
         $select = $sql->select('users');
         $select->where(array('id = ?' => $id));

         $stmt   = $sql->prepareStatementForSqlObject($select);
         $result = $stmt->execute();

         if ($result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows()) {
             return $this->hydrator->hydrate($result->current(), $this->userPrototype);
         }

         throw new \InvalidArgumentException("User with ID:{$id} not found.");
     }

     public function findAll()
     {
         $sql    = new Sql($this->dbAdapter);
         $select = $sql->select('users');

         $stmt   = $sql->prepareStatementForSqlObject($select);
         $result = $stmt->execute();

         if ($result instanceof ResultInterface && $result->isQueryResult()) {
             $resultSet = new HydratingResultSet($this->hydrator, $this->userPrototype);

             return $resultSet->initialize($result);
         }

         return array();
     }
  }
 }