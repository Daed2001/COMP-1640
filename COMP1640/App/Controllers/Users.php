<?php
class Users extends Controller {
    
    public function index() {
        $data = [
            'title' => 'Login page',
            'username' => '',
            'password' => '',
            'error' => '',
        ];

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
           
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'error' => '',
            ];
            //Validate field
            if (empty($data['username']) || (empty($data['password']))) {
                $data['error'] = 'Please fill in.';
            }

           
            
            //Check if all errors are empty
            if (empty($data['error'])) {
                $loggedInUser = $this->model("User")->login($data['username'], $data['password']);
                
                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['error'] = 'Password or Username is incorrect. Please try again.';
                    $this->view('login', $data);
                }
            }
        } else {
            $data = [
                'username' => '',
                'password' => '',
                'error' => ''
            ];
        }

        $this->view('login', $data);
    }

    public function update() {
        if(count($_POST)>0){
            if($_POST['type']=='update'){     
        //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
           
            $data = [
                'userId' => trim($_POST['id']) ,
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'email' => trim($_POST['email']),
                'fullname' => $_POST['fullname'],
                'roleId' => trim($_POST['role']),
                'departmentId' => trim($_POST['department']),
                'updateAt' => date("Y-m-d H:i:s"),
            ];
            if(!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }
            if(empty($data['email']) || empty($data['fullname'])) {
                echo json_encode(array("statusCode"=>201));
            } else {
                $this->model("Staffs")->update($data);
                echo json_encode(array("statusCode"=>200));
            }
            
           
	    }




    }}

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->userId;
        $_SESSION['username'] = $user->username;
        $_SESSION['email'] = $user->email;
        $_SESSION['fullname'] = $user->fullname;
        $_SESSION['role'] = $user->roleId;
        $_SESSION['departmentid'] = $user->departmentId;

        header('location:' . URLROOT . '/dashboard/index');
    }


    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['fullname']);
        unset($_SESSION['role']);
        

        header('location:' . URLROOT . '/users/index');
    }
}
?>