<?php 
    class Categories extends db {
        public function create($data) {
        $this->query('INSERT INTO category (categoryname, createAt, updateAt) VALUES(:categoryname, :createAt, :updateAt)');

        //Bind values
        $this->bind(':categoryname', $data['categoryname']);
        $this->bind(':createAt', $data['createAt']);
        $this->bind(':updateAt', $data['updateAt']);
        $this->execute();
        
        


        }
        //Execute function

    
        public function readall() {
            $this->query('SELECT * FROM category');
            $show = $this->result();
            return $show ;
    
        }
        
    public function read($data) {
        $this->query('SELECT * FROM category LIMIT :start, :perpage');
        $this->bind(':start', $data['start']);
        $this->bind(':perpage', $data['perpage']);
        $show = $this->result();
        return $show ;

    }
   

    public function update($data) {
        $this->query('UPDATE category SET categoryname=:categoryname, updateAt=:updateAt WHERE categoryId=:categoryId');
        $this->bind(':categoryId', $data['categoryId']);
        $this->bind(':categoryname', $data['categoryname']);
        $this->bind(':updateAt', $data['updateAt']);
        $this->execute();
        
      
        
    }
    public function delete($data){
        $this->query("SELECT * FROM category WHERE categoryId NOT IN (SELECT DISTINCT(categoryId) FROM idea) AND categoryId=:categoryId");
        $this->bind(':categoryId', $data['categoryId']);
        if ($this->column() > 0) {
        $this->query("DELETE FROM category WHERE categoryId NOT IN (SELECT DISTINCT(categoryId) FROM idea)  AND categoryId=:categoryId");
        $this->bind(':categoryId', $data['categoryId']);
        $this->execute(); 
        return true;
        } else return false;
        
    }
    

    public function deletemultiple($data){
        $this->query('SELECT * FROM category WHERE categoryId NOT IN (SELECT DISTINCT(categoryId) FROM idea) AND categoryId in (' . implode(', ', $data['categoryId']) . ') ');
        $this->bind(':categoryId', $data['']);
        if ($this->column() > 0) {
        $this->query('DELETE FROM category WHERE categoryId NOT IN (SELECT DISTINCT(categoryId) FROM idea) AND categoryId in (' . implode(', ', $data['categoryId']) . ')');
        $this->bind(':categoryId', $data['']);
        $this->execute();
        return true;
    } else return false;
}

        public function categorycheck($data){
            $this->query("SELECT * FROM category WHERE categoryname=:categoryname");
             $this->bind(':categoryname', $data['categoryname']);
             if($this->column() > 0) {
                return true;
            } else {
                return false;
            }
        }
        
        public function categorycheckupdate($data){     
            $this->query("SELECT * FROM category WHERE (categoryId!=:categoryId AND categoryname=:categoryname)");
             $this->bind(':categoryId', $data['categoryId']);
             $this->bind(':categoryname', $data['categoryname']);
             if($this->column() > 0) {
                return true;
            } else {
                return false;
            }
        }


            


    public function pagination(){
        $this->query('SELECT COUNT(categoryId) FROM category');
        $totalres = $this->column();
        return $totalres;

    }
    }

    




?>