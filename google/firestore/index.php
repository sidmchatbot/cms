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
        public function total($col, $course = ""){
            if($course == "")
                return iterator_count($this->db->collection($col)->documents());
            else
                return iterator_count($this->db->collection($col)->where("program", "==", $this->doc("programme", $course))->documents());
        }
        public function doc($col, $d){
            return $this->db->collection($col)->document($d);
        }
        public function insert($col, $data){
            $this->db->collection($col)->add($data);
        }
        public function to_array($arr){
            $data = [];
            foreach($arr as $doc){
                $data[] = array_merge(["key"=>$doc->id()], $doc->data());
            }
            return $data;
        }
        public function page($prog, $num){
            return $this->to_array(
                $this->db
                ->collection("course")
                ->where("program", "==", $this->doc("programme", $prog))
                ->offset(10*($num*1))
                ->documents()
            );
            // return $this->to_array($this->db
            // ->collection("course")
            // ->where("program", "==", $this->doc("programme", $prog))
            // ->orderBy("date_added", "DESC")
            // ->offset(10*$num)
            // ->documents());
        }
    }
?>