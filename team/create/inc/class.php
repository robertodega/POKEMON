<?php
    class pokeMan{
        private static $dbName = POKEDB;
        private static $dbHost = CONNHOST;
        private static $dbUser = CONNUSR;
        private static $dbPass = CONNPWD;
        private static $dbConnCount = false;

        public function connect(){
            if(!self::$dbConnCount){
                try{
                    $conn = new PDO("mysql:host=".self::$dbHost.";dbname=".self::$dbName."",self::$dbUser,self::$dbPass);
                    self::$dbConnCount = true;
                }
                catch(PDOException $e){
                    die("<div id='errorDiv' class='errorDiv'>".$e->getMessage()."</div>");
                }
            }
            return $conn;
        }

        public function disconnect(){
            self::$dbConnCount = false;
        }

        public function crud($conn,$op,$par){
            $res = array();
            switch($op){
                case'create':{
                    if(count($par)){
                        $fld = isset($par["fld"]) ? $par["fld"] : "";
                        $tbl = isset($par["tbl"]) ? $par["tbl"] : "";
                        $values = isset($par["values"]) ? $par["values"] : "";
                        if($fld && $tbl){
                            $q = "INSERT INTO ".$tbl." (".$fld.") VALUES ('".$values."') ";
                            try{
                                $stmt = $conn->query($q);
                            }
                            catch(Exception $e){
                                die(WRITEEXCEPTION." => ".$e->getMessage());
                            }
                        }
                    }
                }break;
                case'read':{
                    if(count($par)){
                        $fld = isset($par["fld"]) ? $par["fld"] : "";
                        $tbl = isset($par["tbl"]) ? $par["tbl"] : "";
                        $wcond = isset($par["wcond"]) ? $par["wcond"] : "";
                        if($fld && $tbl){
                            $q = "SELECT ".$fld." FROM ".$tbl." ".$wcond."";
                            $stmt = $conn->query($q);
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){$res[] = $row;}
                        }
                    }
                }break;
                case'update':{
                    
                }break;
                case'delete':{
                    if(count($par)){
                        $fld = isset($par["fld"]) ? $par["fld"] : "";
                        $tbl = isset($par["tbl"]) ? $par["tbl"] : "";
                        $values = isset($par["values"]) ? $par["values"] : "";
                        if($fld && $tbl){
                            $q = "DELETE FROM ".$tbl." WHERE ".$fld." = '".$values."' ";
                            $stmt = $conn->query($q);
                        }
                    }
                }break;
            }
            return $res;
        }

        public function tryConn(){
            try{
                $conn = pokeMan::connect();
            }
            catch(Exception $e){
                die(CONNEXCEPTION);
            }
            return $conn;
        }

        public function readTable($conn,$table,$params,$whereCond){
            $paramsVal = implode(',',$params);
            $par = array(
                "fld" => "".$paramsVal.""
                ,"tbl" => $table
                ,"wcond" => " WHERE ".$whereCond." " 
            );
        
            try{
                $res = pokeMan::crud($conn,READOPERATION,$par);
            }
            catch(Exception $e){
                die(READEXCEPTION);
            }
            return $res;
        }

        public function writeTable($conn,$table,$params,$value){
            $paramsVal = implode(',',$params);
            $par = array(
                "fld" => "".$paramsVal.""
                ,"tbl" => $table
                ,"values" => "".$value."" 
            );
            try{
                $write = pokeMan::crud($conn,CREATEOPERATION,$par);
            }
            catch(Exception $e){
                die(WRITEEXCEPTION);
            }
            return $write;
        }

        public function deleteTeam($conn,$table,$params,$value){
            $paramsVal = implode(',',$params);
            $par = array(
                "fld" => "".$paramsVal.""
                ,"tbl" => $table
                ,"values" => "".$value."" 
            );
            try{
                $delete = pokeMan::crud($conn,DELETEOPERATION,$par);
            }
            catch(Exception $e){
                die(WRITEEXCEPTION);
            }
            return $delete;
        }

    }
?>