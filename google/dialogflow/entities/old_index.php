<?php

use Google\Cloud\Dialogflow\V2\EntityType\Entity;
use Google\Cloud\Dialogflow\V2\EntityTypesClient;

    $DialogflowEntities = new class{
        protected $entityclients;
        protected $serviceAccount = "demonypchatbot"; // or projectid
        public function __construct()
        {
            $this->entityclients = new EntityTypesClient(["credentials"=>$this->serviceAccount.".json"]);
        }
        public function delete($id, $tag){
            $name = $this->entityclients->entityTypeName($this->serviceAccount, $id);
            $entityType = $this->entityclients->getEntityType($name);
            $entities = $entityType->getEntities();
            $data = [];
            foreach($entities as $entity){
                if($tag !== $entity->getValue()){
                    $data[] = $entity;
                }
            }
            $entityType->setEntities($data);
            $this->entityclients->updateEntityType($entityType);
        }
        public function entity($id, $tag, $val = []){
            if(!isset($tag)){throw new Exception("missing tag in argument"); }
            $name = $this->entityclients->entityTypeName($this->serviceAccount, $id);
            $entitytype = $this->entityclients->getEntityType($name);
            $entities = $entitytype->getEntities();
            $data = [];
            $match = false;

            foreach($entities as $entity){
                $data[] = $entity;
                if($tag == $entity->getValue()){
                    $entity->setSynonyms($val);
                    $match = true;
                }
            }
            if(!$match){
                $entity = new Entity();
                $entity->setValue($tag);
                $entity->setSynonyms($val);
                $data[] = $entity;
                $entitytype->setEntities($data);
            }
            $this->entityclients->updateEntityType($entitytype);
        }

    }
?>