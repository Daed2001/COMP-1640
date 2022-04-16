<?php 
class Staff extends Controller {
    public function __construct() {
        if ($_SESSION['role'] != 1) {
            header('location:' . URLROOT . '/dashboard/index');
        }
    }
    public function index($page = ''){
        $data = [
            'title' => 'Staffs',
            'role' => $this->model("Staffs")->role(),
            'department' => $this->model("Staffs")->department(),
        ];
        $data['perpage'] = 5;
        
        if(isset($page) & !empty($page)){
            $data['curpage'] = $page;
        }else{
            $data['curpage'] = 1;
        }

        // echo  $data['curpage'];
        $data['start'] = ($data['curpage'] * $data['perpage']) - $data['perpage'];
        $data['totalres'] = $this->model("Staffs")->pagination();
        $data['endpage'] = ceil($data['totalres']/$data['perpage']);
        $data['startpage'] = 1;
        $data['nextpage'] = $data['curpage'] + 1;
        $data['previouspage'] = $data['curpage'] - 1;
        $data['show']= $this->model("Staffs")->read($data);
        // var_dump($data['show']);
        $this->view("pages/staff", $data);
    }
    
	public function create(){
        if(count($_POST)>0){
            if($_POST['type']=='create'){  
		
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
           
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'email' => trim($_POST['email']),
                'fullname' => $_POST['fullname'],
                'roleId' => trim($_POST['role']),
                'departmentId' => trim($_POST['department']),
                'updateAt' => date("Y-m-d H:i:s"),
                'createAt' => date("Y-m-d H:i:s"),
                
            ];

            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            if (empty($data['username']) || empty($data['password'])) {
                echo json_encode(array("statusCode" => 201));
            } else if ($this->model("Staffs")->staffcheck($data)) {
                echo json_encode(array("statusCode" => 'staffcheck'));
            } else {
                $this->model("Staffs")->create($data);
                echo json_encode(array("statusCode" => 200));
            }
			
            //Validate field
           
	}
    }
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

            if (empty($data['username']) || empty($data['email'])) {
                echo json_encode(array("statusCode" => 201));
            } else if ($this->model("Staffs")->staffcheckupdate($data)) {
                echo json_encode(array("statusCode" => 'staffcheck'));
            } else {
                $this->model("Staffs")->update($data);
                echo json_encode(array("statusCode" => 200));
            }
            
           
	    }




    }}

    public function delete(){
        if(count($_POST)>0){
            if($_POST['type']=='delete'){     
        //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'userId' => trim($_POST['id']) ,
            ];
                $this->model("Staffs")->delete($data);
            
            
           
	    }
    }
    }
    public function deletemultiple(){
    if(count($_POST)>0){
        if($_POST['type']=='deletemultiple'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $id = explode(',', trim($_POST['id']));
            $data = [
                'userId' => $id ,
            ];
            print_r($data);
            $this->model("Staffs")->deletemultiple($data);
            
        }
    }
}

}
?>
