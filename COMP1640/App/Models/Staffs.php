<?php
class Staffs extends db {
    public function create($data) {
        
        $this->query('INSERT INTO user (username, password, email, fullname, createAt, updateAt, roleId, departmentId)
         VALUES(:username, :password, :email, :fullname, :createAt, :updateAt, :roleId, :departmentId)');

        //Bind values
        $this->bind(':username', $data['username']);
        $this->bind(':password', $data['password']);
        $this->bind(':email', $data['email']);
        $this->bind(':fullname', $data['fullname']);
        $this->bind(':createAt', $data['createAt']);
        $this->bind(':updateAt', $data['updateAt']);
        $this->bind(':roleId', $data['roleId']);
        $this->bind(':departmentId', $data['departmentId']);
        $this->execute();
        
        


        }
        //Execute function

    
        
    public function read($data) {
        $this->query('SELECT `role`.rolename, `user`.*,`department`.departmentname
        FROM        `user`
        INNER JOIN  `role` ON `user`.roleId = `role`.roleId
        INNER JOIN  `department` ON `user`.departmentId = `department`.departmentId 
        LIMIT :start, :perpage');
        $this->bind(':start', $data['start']);
        $this->bind(':perpage', $data['perpage']);
        $show = $this->result();
        return $show ;

    }
    public function role() {
        $this->query('SELECT * FROM role');
        $role = $this->result();
        return $role ;

    }

    public function department() {
        $this->query('SELECT * FROM department');
        $department = $this->result();
        return $department ;

    }

   

    public function update($data) {
        $this->query('UPDATE user SET username=COALESCE(NULLIF(:username, ""),username), password=COALESCE(NULLIF(:password, ""),password), email=:email, fullname=:fullname, updateAt=:updateAt, roleId=COALESCE(NULLIF(:roleId, ""),roleId), departmentId=COALESCE(NULLIF(:departmentId, ""),departmentId) 
        WHERE userId=:userId');
        $this->bind(':userId', $data['userId']);
        $this->bind(':username', $data['username']);
        $this->bind(':password', $data['password']);
        $this->bind(':email', $data['email']);
        $this->bind(':fullname', $data['fullname']);
        $this->bind(':updateAt', $data['updateAt']);
        $this->bind(':roleId', $data['roleId']);
        $this->bind(':departmentId', $data['departmentId']);
        $this->execute();
        
        

      
        
    }
    public function delete($data){
        $this->query('DELETE FROM user WHERE userId = :userId');
        $this->bind(':userId', $data['userId']);
        $this->execute();
        
    }

    public function deletemultiple($data){
        $this->query('DELETE FROM user WHERE userId in (' . implode(', ', $data['userId']) . ')');
        $this->bind(':userId', $data['']);
        $this->execute();
        }

        public function pagination(){
            $this->query('SELECT COUNT(userId) FROM user');
            $totalres = $this->column();
            return $totalres;
    
        }

        public function staffcheck($data){
            $this->query("SELECT * FROM user WHERE username=:username OR email=:email");
            $this->bind(':username', $data['username']);
            $this->bind(':email', $data['email']);
            if($this->column() > 0) {
               return true;
           } else {
               return false;
           }
        } 
        public function staffcheckupdate($data){
            $this->query("SELECT * FROM user WHERE (username=:username AND email!=:email)");
            $this->bind(':username', $data['username']);
            $this->bind(':email', $data['email']);
             if($this->column() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

?>