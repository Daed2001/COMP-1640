<?php
class Submissions extends db {
    public function create($data) {
        
        $this->query('INSERT INTO submission (submissionname, content, closure_date, final_closure_date, createAt, updateAt)
         VALUES(:name, :content, :closure_date, :final_closure_date, :createAt, :updateAt)');

        //Bind values
        $this->bind(':name', $data['submissionname']);
        $this->bind(':content', $data['content']);
        $this->bind(':closure_date', $data['closuredate']);
        $this->bind(':final_closure_date', $data['finalclosuredate']);
        $this->bind(':createAt', $data['createAt']);
        $this->bind(':updateAt', $data['updateAt']);
        $this->execute();
        
        


        }

        public function readall() {
            $this->query('SELECT * FROM submission');
            $show = $this->result();
            return $show ;
    
        }
        
        public function read($data) {
            $this->query('SELECT * FROM submission LIMIT :start, :perpage');
            $this->bind(':start', $data['start']);
            $this->bind(':perpage', $data['perpage']);
            $show = $this->result();
            return $show ;
    
        }

        public function readallsubmit() {
            $this->query('SELECT * FROM submission');
            $show = $this->result();
            return $show ;
    
        }


    public function update($data) {
        $this->query('UPDATE submission SET submissionname=:name, content=:content, closure_date=:closure_date, final_closure_date=:final_closure_date, updateAt=:updateAt 
        WHERE submissionId=:submissionId');
        $this->bind(':submissionId', $data['submissionId']);
        $this->bind(':name', $data['submissionname']);
        $this->bind(':content', $data['content']);
        $this->bind(':closure_date', $data['closuredate']);
        $this->bind(':final_closure_date', $data['finalclosuredate']);
        $this->bind(':updateAt', $data['updateAt']);
        $this->execute();
        
      
        
    }
    public function delete($data){
        $this->query('DELETE FROM submission WHERE submissionId = :submissionId');
        $this->bind(':submissionId', $data['submissionId']);
        $this->execute();
        
    }

    public function deletemultiple($data){
        $this->query('DELETE FROM submission WHERE submissionId in (' . implode(', ', $data['submissionId']) . ')');
        $this->bind(':submissionId', $data['']);
        $this->execute();
        }

    
        public function pagination(){
            $this->query('SELECT COUNT(submissionId) FROM submission');
            $totalres = $this->column();
            return $totalres;
    
        }

        public function submissioncheck($data){
        $this->query("SELECT * FROM submission WHERE submissionname=:submissionname");
        $this->bind(':submissionname', $data['submissionname']);
        if($this->column() > 0) {
           return true;
       } else {
           return false;
       }
    } 
    public function submissioncheckupdate($data){
        $this->query("SELECT * FROM submission WHERE (submissionId=:submissionId AND submissionname!=:submissionname)");
         $this->bind(':submissionId', $data['submissionId']);
         $this->bind(':submissionname', $data['submissionname']);
         if($this->column() > 0) {
            return true;
        } else {
            return false;
        }
    }
    }

?>