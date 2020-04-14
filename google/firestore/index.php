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
        public function update($col, $d, $data){
            $field = [];
            foreach($data as $k=>$v){
                $field[] = ["path"=>$k, "value"=>$v];
            }
            $this->doc($col, $d)->update($field);
        }
        public function insert($col, $data){
            $this->db->collection($col)->add($data);
        }
        public function delete($col, $doc){
            $this->doc($col, $doc)->delete();
        }
        public function to_array($arr, $incl = []){
            $data = [];
            foreach($arr as $doc){
                $data[] = ["key"=>$doc->id()];
                foreach($doc->data() as $key=>$val){
                    if(!(array_search("*",$incl) > -1)){
                        if(!(array_search($key, $incl) > -1))
                            continue;
                    }
                    if(is_object($val)){
                        $class = explode("\\", get_class($val));
                        switch($class[count($class)-1]){
                            case "DocumentReference" : 
                                $data[count($data)-1][$key] = $val->id();
                            break;
                            case "Timestamp" : 
                                $data[count($data)-1][$key] = $val->formatAsString();
                            break;
                        }
                    }
                    else{
                        $data[count($data)-1][$key] = $val;
                    }
                }
            }
            return $data;
        }
        public function page($prog, $num = 1, $inc = ["*"]){
            if($num == "")$num = 1;
            return $this->to_array(
                $this->db
                ->collection("course")
                ->where("program", "==", $this->doc("programme", $prog))
                ->offset(10*($num-1))
                ->documents(),
                $inc
            );
        }
    }
?>