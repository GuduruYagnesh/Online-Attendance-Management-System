<?php
    @session_start();
    date_default_timezone_set("Asia/Kolkata");
    require("databaseconnect.php");
    
    class Operations extends Database{
        private $my_conn = "";
        private $my_error = 0;

        function __construct(){
            $this->my_conn = new mysqli($this->getHost(), $this->getUserName(), $this->getPassword(), $this->getDBName());
            
            if (mysqli_connect_errno()) {
                $this->my_error = mysqli_connect_errno();
            }
        }

        function checkStaffLogin($username, $password){
            $res = array();
            if($this->my_error==0 && !empty($this->my_conn)){
                if($stmt=$this->my_conn->prepare("SELECT `privilege`, `br_code`, `branch`, `fname` FROM `fac_login` WHERE `fuser`=? AND `fpass`=?;")){
                    $stmt->bind_param("ss", $username, $password);
                    if($stmt->execute()){
                        $stmt->bind_result($priv, $br_code, $branch, $facname);
                        while($stmt->fetch()){
                            $res['privilege']= $priv;
                            $res['br_code']= $br_code;
                            $res['branch']= $branch;
                            $res['user']= $facname;
                            $res['status'] =  "success";
                            return $res;
                        }
                    }
                }
            }
            $res['status'] =  "failure";
            return $res;
        }
        
        function checkStudentLogin($username, $password){
            $res = array();
            if($this->my_error==0 && !empty($this->my_conn)){
                if($stmt=$this->my_conn->prepare("SELECT `privilege`, `regulation`, `br_code`, `email`, `year`, `sem` FROM `st_login` WHERE `sid`=? AND `spass`=?;")){
                    $stmt->bind_param("ss", $username, $password);
                    if($stmt->execute()){
                        $stmt->bind_result($priv, $reg, $br_code, $name, $year, $sem);
                        while($stmt->fetch()){
                            $res['priv'] = $priv;
                            $res['br_code'] = $br_code;
                            $res['user'] = $name;
                            $res['year'] = $year;
                            $res['sem'] = $sem;
                            $res['reg'] = $reg;
                            $res['status'] =  "success";
                            return $res;
                        }
                    }
                }
            }
            $res['status'] =  "failure";
            return $res;
        }
        function checkHodLogin($username, $password){
            $res = array();
            if($this->my_error==0 && !empty($this->my_conn)){
                if($stmt=$this->my_conn->prepare("SELECT `privilege`, `br_code`, `branch`, `fname` FROM `fac_login` WHERE `fuser`=? AND `fpass`=?;")){
                    $stmt->bind_param("ss", $username, $password);
                    if($stmt->execute()){
                        $stmt->bind_result($priv, $br_code, $branch, $facname);
                        while($stmt->fetch()){
                            $res['priv']= $priv;
                            $res['br_code']= $br_code;
                            $res['branch']= $branch;
                            $res['user']= $facname;
                            $res['status'] =  "success";
                            return $res;
                        }
                    }
                }
            }
            $res['status'] =  "failure";
            return $res;
        }

        function changePassword($username, $currentpass, $newpass, $renewpass){
            if($this->my_error==0 && !empty($this->my_conn)){
                if($stmt=$this->my_conn->prepare("SELECT fpass FROM `fac_login` WHERE `fname`=?;")){
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $stmt->bind_result($password);
                    $stmt->fetch();
                    if($password != $currentpass){
                        return 'incorrect';
                    }else if($newpass != $renewpass){
                        return "pwd_mismatch";
                    }else{
                        $stmt->close();
                        if($stmt=$this->my_conn->prepare("UPDATE `fac_login` SET `fpass`=? WHERE `fname`=?;")){
                            $stmt->bind_param("ss", $newpass, $username);
                            if($stmt->execute()){
                                return "pwd_chngd";
                            }
                        }
                    }
                }
            }
        }
}
?>