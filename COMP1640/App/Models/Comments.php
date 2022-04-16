<?php
class Comments extends db {
    public function add($data){
        $this->query('INSERT INTO comment (Content, Anonymous, ideaId, userId, createAt) VALUES(:Content, :Anonymous, :ideaId, :userId, :createAt)');

        //Bind values
        $this->bind(':Content', $data['Content']);
        $this->bind(':Anonymous', $data['Anonymous']);
        $this->bind(':ideaId', $data['ideaId']);
        $this->bind(':userId', $data['userId']);
        $this->bind(':createAt', $data['createAt']);
        $this->execute();
    }

    public function read(){
        $this->query("SELECT comment.Anonymous, comment.Content, user.username,comment.userId, comment.ideaId, comment.createAt
        FROM ((comment 
        INNER JOIN user ON comment.userId  = user.userId)
        INNER JOIN idea ON comment.ideaId = idea.ideaId)
        ORDER BY comment.createAt DESC");
        $show = $this->result();
        return $show;
    }

    public function getusername($userId){
        $this->query("SELECT username FROM user WHERE userId = $userId");
        $show = $this->result();
        return $show;
    }

  
    

}

?>