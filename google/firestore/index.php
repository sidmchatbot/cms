<?php
    use Kreait\Firebase\Factory;

    $GFirestore = new class{
        protected $factory;
        protected $firestore;
        protected $db;

        public function __construct()
        {
            $this->factory = (new Factory())
            ->withServiceAccount("./demonypchatbot.json")
            ->withDatabaseUri("https://demonypchatbot.firebaseio.com/");

            $this->firestore =  $this->factory->createFirestore();
            $this->db = $this->firestore->database();
        }
        public function insert($col, $data){
            $this->db->collection($col)->add($data);
        }
    }
?>