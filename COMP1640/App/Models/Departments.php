<?php
class Departments extends db {
    public function create($data) {
        
        $this->query('INSERT INTO department (departmentname, createAt, updateAt) VALUES(:departmentname, :createAt, :updateAt)');

        //Bind values
        $this->bind(':departmentname', $data['departmentname']);
        $this->bind(':createAt', $data['createAt']);
        $this->bind(':updateAt', $data['updateAt']);
        $this->execute();
        
        


        }
        //Execute function
        public function getdepartment(){
            $userid = $_SESSION['user_id'];
            $this->query("SELECT department.departmentname FROM department 
            INNER JOIN user ON user.userId = $userid
            AND user.departmentId = department.departmentId");
            $show = $this->result();
            return $show ;
        }
    
        
        public function read($data) {
            $this->query('SELECT * FROM department LIMIT :start, :perpage');
            $this->bind(':start', $data['start']);
            $this->bind(':perpage', $data['perpage']);
            $show = $this->result();
            return $show ;
    
        }

    public function update($data) {
        $this->query('UPDATE department SET departmentname=:departmentname, updateAt=:updateAt WHERE departmentId=:departmentId');
        $this->bind(':departmentId', $data['departmentId']);
        $this->bind(':departmentname', $data['departmentname']);
        $this->bind(':updateAt', $data['updateAt']);
        $this->execute();
        
      
        
    }
    public function delete($data){
        $this->query('DELETE FROM department WHERE departmentId = :departmentId');
        $this->bind(':departmentId', $data['departmentId']);
        $this->execute();
        
    }

    public function deletemultiple($data){
        $this->query('DELETE FROM department WHERE departmentId in (' . implode(', ', $data['departmentId']) . ')');
        $this->bind(':departmentId', $data['']);
        $this->execute();
        }

        public function pagination(){
            $this->query('SELECT COUNT(departmentId) FROM department');
            $totalres = $this->column();
            return $totalres;
    
        }

        public function departmentcheck($data){
            $this->query("SELECT * FROM department WHERE departmentname=:departmentname");
            $this->bind(':departmentname', $data['departmentname']);
            if($this->column() > 0) {
               return true;
           } else {
               return false;
           }
        }

           public function departmentcheckupdate($data){
            $this->query("SELECT * FROM department WHERE (departmentId=:departmentId AND departmentname!=:departmentname)");
             $this->bind(':departmentId', $data['departmentId']);
             $this->bind(':departmentname', $data['departmentname']);
             if($this->column() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

?>