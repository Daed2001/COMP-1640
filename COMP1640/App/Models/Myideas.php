<?php
class Myideas extends db {
    public function create($data) {
        
        $this->query('INSERT INTO idea (Title, Content, File, Package, Anonymous, createAt, updateAt, categoryId, submissionId, userId) VALUES(:Title, :Content, NULLIF(:File, ""), NULLIF(:Package, ""), :Anonymous, :createAt, :updateAt, :categoryId, :submissionId, :userId)');
       
        //Bind values
        $this->bind(':Title', $data['titlename']);
        $this->bind(':Content', $data['content']);
        $this->bind(':File', $data['img']);
        $this->bind(':Package', $data['package']);
        $this->bind(':Anonymous', $data['anonymous']);
        $this->bind(':createAt', $data['createAt']);
        $this->bind(':updateAt', $data['updateAt']);
        $this->bind(':categoryId', $data['category_id']);
        $this->bind(':submissionId', $data['submissionId']);
        $this->bind(':userId', $data['user_id']);
        $this->execute();
        }


        public function update($data) {
            $this->query('UPDATE idea SET Title=:titlename, File=COALESCE(NULLIF(:File, ""),File), Content=:content, Anonymous=:anonymous, categoryId=:category_id, submissionId=:submissionId, updateAt=:updateAt 
            WHERE ideaId=:ideaId');
            $this->bind(':ideaId', $data['ideaId']);
            $this->bind(':titlename', $data['titlename']);
            $this->bind(':File', $data['img']);
            $this->bind(':content', $data['content']);
            $this->bind(':anonymous', $data['anonymous']);
            $this->bind(':category_id', $data['category_id']);
            $this->bind(':submissionId', $data['submissionId']);
            $this->bind(':updateAt', $data['updateAt']);
            $this->execute();
        }

        public function read() {
            $this->query('SELECT `category`.categoryname, `idea`.*,`submission`.submissionname, `submission`.closure_date, `submission`.final_closure_date
            FROM        `idea`
            INNER JOIN  `category` ON `idea`.categoryId = `category`.categoryId
            INNER JOIN  `submission` ON `idea`.submissionId = `submission`.submissionId 
                ');
          
            $show = $this->result();
            return $show ;
        }
    public function show($data) {
        $id = $_SESSION['user_id'];
        $this->query("SELECT `category`.categoryname, `idea`.*,`submission`.submissionname, `submission`.closure_date, `submission`.final_closure_date
        FROM        `idea`
        INNER JOIN  `category` ON `idea`.categoryId = `category`.categoryId
        INNER JOIN  `submission` ON `idea`.submissionId = `submission`.submissionId 
        WHERE userId = $id
        LIMIT :start, :perpage ");
        $this->bind(':start', $data['start']);
        $this->bind(':perpage', $data['perpage']);
        $show = $this->result();
        return $show ;
    }
    public function showadmin($data) {
        $this->query("SELECT `category`.categoryname, `idea`.*,`submission`.submissionname, `submission`.closure_date, `submission`.final_closure_date
        FROM        `idea`
        INNER JOIN  `category` ON `idea`.categoryId = `category`.categoryId
        INNER JOIN  `submission` ON `idea`.submissionId = `submission`.submissionId 
        LIMIT :start, :perpage ");
        $this->bind(':start', $data['start']);
        $this->bind(':perpage', $data['perpage']);
        $show = $this->result();
        return $show ;
    }
    public function lastest($data) {
        $this->query("SELECT `category`.categoryname, `idea`.*,`submission`.submissionname, `submission`.closure_date, `submission`.final_closure_date
        FROM        `idea`
        INNER JOIN  `category` ON `idea`.categoryId = `category`.categoryId
        INNER JOIN  `submission` ON `idea`.submissionId = `submission`.submissionId ORDER BY ideaId DESC
        LIMIT :start, :perpage ");
        $this->bind(':start', $data['start']);
        $this->bind(':perpage', $data['perpage']);
        $show = $this->result();
        return $show ;
    }


    public function popular($data) {
        $this->query("SELECT `reaction`.reaction,idea.*, COUNT(*) AS cnt FROM reaction LEFT JOIN idea ON reaction.ideaId = idea.ideaId GROUP BY ideaId ORDER BY `reaction`.`reaction` DESC, `cnt` DESC LIMIT :start, :perpage ");
        $this->bind(':start', $data['start']);
        $this->bind(':perpage', $data['perpage']);
        $show = $this->result();
        return $show ;
    }
    public function delete($data){
        $this->query('DELETE FROM idea WHERE ideaId = :ideaId');
        $this->bind(':ideaId', $data['ideaId']);
        $this->execute();
        
    }

    public function deletemultiple($data){
        $this->query('DELETE FROM idea WHERE ideaId in (' . implode(', ', $data['ideaId']) . ')');
        $this->bind(':ideaId', $data['']);
        $this->execute();
        }

        public function pagination(){
            $this->query('SELECT COUNT(ideaId) FROM idea');
            $totalres = $this->column();
            return $totalres;
    
        }


}
?>