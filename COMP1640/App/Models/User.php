<?php
class User extends db {
    public function login($username, $password) {
        
        $this->query('SELECT `role`.rolename, `user`.*,`department`.departmentname
        FROM        `user`
        INNER JOIN  `role` ON `user`.roleId = `role`.roleId
        INNER JOIN  `department` ON `user`.departmentId = `department`.departmentId WHERE username = :username');

        //Bind value
        $this->bind(':username', $username);
        
        $row = $this->single();
        if(isset($row->username)) {
            // $hashedPassword = $row->password;
            if (password_verify($password, $row->password)) { 
                return $row;
            } else {
                return false;
            }
        }
    }
    public function read() {
        $userid = $_SESSION['user_id'];
        $this->query("SELECT `role`.rolename, `user`.*,`department`.departmentname
        FROM        `user`
        INNER JOIN  `role` ON `user`.roleId = `role`.roleId
        INNER JOIN  `department` ON `user`.departmentId = `department`.departmentId WHERE userId = $userid");
        $show = $this->single();
        return $show ;

    }

    public function getiduser(){
        $loggeduserid = $_SESSION['user_id'];
        return $loggeduserid;
    }

    public function getuser(){
        $userid = $_SESSION['user_id'];
        $this->query("SELECT * FROM user WHERE userId  = $userid ");
        $show = $this->result();
        return $show ;
    }

    public function getall(){
        $userid = $_SESSION['user_id'];
        $this->query("SELECT * FROM user");
        $show = $this->result();
        return $show ;
    }
    public function getrole(){
        $userid = $_SESSION['user_id'];
        $this->query("SELECT role.rolename FROM user INNER JOIN role WHERE role.roleId = user.roleId AND user.userId = $userid");
        $show = $this->result();
        return $show ;
    }

    public function findUserIdbyideaid() {
        $this->query("SELECT * FROM user");

        $show = $this->result();
        return $show ;

    }
    
    public function userprofile(){
        
    }
    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email) {
        //Prepared statement
        $this->query('SELECT * FROM user WHERE email = :email');

        //Email param will be binded with the email variable
        $this->bind(':email', $email);

        //Check if email is already registered
        if($this->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function GetQAforuser(){
        $userdepartmentid = $_SESSION['departmentid'];
        $this->query("SELECT email, fullname FROM `user` WHERE `roleId` = 2 AND `departmentId` = $userdepartmentid");
        $show = $this->result();
        return $show;
    }
}

?>