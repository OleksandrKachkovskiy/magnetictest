<?php

 namespace Product\Mapper;

 use Product\Model\ProductInterface;
 use Zend\Db\Adapter\AdapterInterface;
 use Zend\Db\Adapter\Driver\ResultInterface;
 use Zend\Db\ResultSet\HydratingResultSet;
 use Zend\Db\Sql\Sql;
 use Zend\Db\Sql\Insert;
 use Zend\Db\Sql\Update;
 use Zend\Stdlib\Hydrator\HydratorInterface;

 class DbMapper implements ProductMapperInterface
 {
     protected $dbAdapter;
	 protected $hydrator;
	 protected $productPrototype;

     public function __construct(
         AdapterInterface $dbAdapter,
         HydratorInterface $hydrator,
         ProductInterface $productPrototype
     ) {
         $this->dbAdapter      = $dbAdapter;
         $this->hydrator       = $hydrator;
         $this->productPrototype  = $productPrototype;
     }

     public function find($id)
     {
         $sql    = new Sql($this->dbAdapter);
         $select = $sql->select('products');
         $select->where(array('id = ?' => $id));

         $stmt   = $sql->prepareStatementForSqlObject($select);
         $result = $stmt->execute();

         if ($result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows()) {
             return $this->hydrator->hydrate($result->current(), $this->productPrototype);
         }

         throw new \InvalidArgumentException("Product with ID:{$id} not found.");
     }

     public function findAll()
     {
         $sql    = new Sql($this->dbAdapter);
         $select = $sql->select('products');

         $stmt   = $sql->prepareStatementForSqlObject($select);
         $result = $stmt->execute();

         if ($result instanceof ResultInterface && $result->isQueryResult()) {
             $resultSet = new HydratingResultSet($this->hydrator, $this->productPrototype);

             return $resultSet->initialize($result);
         }

         return array();
     }
	 
	 public function save(ProductInterface $productObject)
   {
      $productData = $this->hydrator->extract($productObject);
      unset($productData['id']); // Neither Insert nor Update needs the ID in the array

      if ($productObject->getId()) {
         // ID present, it's an Update
         $action = new Update('products');
         $action->set($productData);
         $action->where(array('id = ?' => $productObject->getId()));
      } else {
         // ID NOT present, it's an Insert
         $action = new Insert('products');
         $action->values($productData);
      }

      $sql    = new Sql($this->dbAdapter);
      $stmt   = $sql->prepareStatementForSqlObject($action);
      $result = $stmt->execute();

      if ($result instanceof ResultInterface) {
         if ($newId = $result->getGeneratedValue()) {
            // When a value has been generated, set it on the object
            $productObject->setId($newId);
         }

         return $productObject;
      }

      throw new \Exception("Database error");
   }
   public function delete(ProductInterface $productObject)
     {
         $action = new Delete('products');
         $action->where(array('id = ?' => $productObject->getId()));

         $sql    = new Sql($this->dbAdapter);
         $stmt   = $sql->prepareStatementForSqlObject($action);
         $result = $stmt->execute();

         return (bool)$result->getAffectedRows();
     }
  }
 }