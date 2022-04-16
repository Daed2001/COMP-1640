<?php 
class Reaction extends db {
    public function read(){
        $this->query("SELECT * FROM reaction");
        $show = $this->result();
        return $show;
    }
    public function ideaid($id){
        $this->query("SELECT ideaId FROM reaction WHERE ideaId = $id");
        $show = $this->result();
        return $show;
    }

    public function count_vote($user,$idea,$reaction){
        $this->query("SELECT COUNT(*) FROM reaction WHERE ideaId = $idea AND  userId=$user AND reaction = $reaction");
        $show = $this->result();
        return $show;
    }

    public function delete_reaction($idea,$reaction){
        $this->query("DELETE FROM `reaction` WHERE ideaId = $idea AND reaction = $reaction");
        $this->execute();
    }



    public function add($data){
        $this->query('INSERT INTO reaction (reaction, ideaId, userId, createAt) VALUES(:reaction, :ideaId, :userId, :createAt)');
        $this->bind(':reaction', $data['reaction']);
        $this->bind(':ideaId', $data['ideaId']);
        $this->bind(':userId', $data['userId']);
        $this->bind(':createAt', $data['createAt']);
        $this->execute();
    }
}

?>