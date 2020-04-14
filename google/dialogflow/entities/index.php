<?php
    use Google\Cloud\Dialogflow\V2\EntityTypesClient;
    use Google\Cloud\Dialogflow\V2\EntityType\Entity;
    $DialogflowEntities = new class{
        protected $entityclients;
        protected $serviceAccount = "demonypchatbot";

        public function __construct()
        {
            $this->entityclients = new EntityTypesClient(["credentials"=>$this->serviceAccount.".json"]);
        }
        public function entities($entity_name = ""){
            $agent_name =$this->entityclients->projectAgentName($this->serviceAccount);
            $list = $this->entityclients->listEntityTypes($agent_name)->iterateAllElements();
            $filter = array_values(array_filter(iterator_to_array($list), function($e) use($entity_name){
                return $entity_name == "" ? $e : $entity_name == $e->getDisplayName() ? $e : false;
            }));
            return count($filter) > 1 ? $filter : $filter[0];
        }
        public function val($entityType, $key, $val){
            $match = false;
            $data = [];
            $entities = $entityType->getEntities();

            foreach($entities as $entity){
                $data[] = $entity;
                echo $entity->getValue();
                if($key == $entity->getValue()){
                    $match = true;
                    $entity->setSynonyms($val);
                }
            }
            $entityType->setEntities($data);

            if(!$match){
                $entity = new Entity();
                $entity = $entity->setValue($key);
                $entity->setSynonyms($val);
                $data[] = $entity;
                $entityType->setEntities($data);
            }
            $this->entityclients->updateEntityType($entityType);
        }
        public function changeKeyName($entityType, $old, $new, $val = ""){
            $entities = $entityType->getEntities();
            $data = [];
            $match = false;

            foreach($entities as $entity){
                $data[] = $entity;
                
                if($old == $entity->getValue()){
                    $match = true;
                    $entity->setValue($new);

                    if($val == ""){
                        continue;
                    }
                    else{
                        $entity->setSynonyms($val);
                    }
                }
            }
            $entityType->setEntities($data);

            if(!$match){
                $entity = new Entity();
                $entity = $entity->setValue($new);
                $entity->setSynonyms($val);
                $data[] = $entity;
                $entityType->setEntities($data);
            }
            $this->entityclients->updateEntityType($entityType);
        }
        public function delete($entityType, $name){
            $entities = $entityType->getEntities();
            $data = [];

            foreach($entities as $entity){
                if($name !== $entity->getValue()){
                    $data[] = $entity;
                }
            }
            $entityType->setEntities($data);
            $this->entityclients->updateEntityType($entityType);

        }
    }
?>