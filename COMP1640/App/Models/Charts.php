<?php

class Charts extends db
{

    public function ideadepartment()
    {
        $this->query('SELECT departmentId, departmentname, COUNT(*) as cnt FROM (SELECT department.departmentId, department.departmentname, idea.userId, idea.ideaId FROM department JOIN user ON department.departmentId = user.departmentId JOIN idea ON idea.userId = user.userId) as tmp GROUP BY departmentId, departmentname');
        $show = $this->result();
        return $show;

    }

    public function ideacount()
    {
        $this->query('SELECT COUNT(`ideaId`) as ideacount FROM idea');
        $show = $this->column();
        return $show;
    }

    public function contributor()
    {
        $this->query('SELECT departmentId, departmentname, COUNT(DISTINCT(userId)) as cnt FROM (SELECT department.departmentId, department.departmentname, idea.userId, idea.ideaId FROM department JOIN user ON department.departmentId = user.departmentId JOIN idea ON idea.userId = user.userId) as tmp GROUP BY departmentId, departmentname');
        $show = $this->result();
        return $show;
    }

}
