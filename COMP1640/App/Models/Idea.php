<?php 
class Idea extends db{
    public function showIdea() {
        $this->query('SELECT * FROM idea');
        $show = $this->result();
        return $show ;
    }
    public function userbyideaID($ideaID){
        $this->query("SELECT user.username, user.fullname, user.email FROM idea 
        INNER JOIN user ON idea.ideaId  = $ideaID 
        AND idea.userId = user.userId");
        $show = $this->result();
        return $show;
    }


}



?>