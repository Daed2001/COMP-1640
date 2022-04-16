<?php 
class Department extends Controller {
    public function __construct() {
        if ($_SESSION['role'] != 1 && $_SESSION['role'] != 2 ) {
            header('location:' . URLROOT . '/dashboard/index');
        }
    }
    public function index($page = '')
    {
        $data = [
            'title' => 'Department',
        ];
        $data['perpage'] = 5;
        
        if(isset($page) & !empty($page)){
            $data['curpage'] = $page;
        }else{
            $data['curpage'] = 1;
        }

        // echo  $data['curpage'];
        $data['start'] = ($data['curpage'] * $data['perpage']) - $data['perpage'];
        $data['totalres'] = $this->model("Departments")->pagination();
        $data['endpage'] = ceil($data['totalres']/$data['perpage']);
        $data['startpage'] = 1;
        $data['nextpage'] = $data['curpage'] + 1;
        $data['previouspage'] = $data['curpage'] - 1;
        $data['show']= $this->model("Departments")->read($data);
        // var_dump($data['show']);
        $this->view("pages/department", $data);
    }
    
	public function create(){
        if(count($_POST)>0){
            if($_POST['type']=='create'){  
		
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
           
            $data = [
                'departmentname' => trim($_POST['name']),
                'createAt' => date("Y-m-d H:i:s"),
                'updateAt' => date("Y-m-d H:i:s"),
            ];

            if (empty($data['departmentname'])) {
                echo json_encode(array("statusCode" => 201));
            } else if ($this->model("Departments")->departmentcheck($data)) {
                echo json_encode(array("statusCode" => 'departmentcheck'));
            } else {
                $this->model("Departments")->create($data);
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
                'departmentId' => trim($_POST['id']) ,
                'departmentname' => trim($_POST['name']),
                'updateAt' => date("Y-m-d H:i:s"),
            ];
            if (empty($data['departmentname'])) {
                echo json_encode(array("statusCode" => 201));
            } else if ($this->model("Departments")->departmentcheckupdate($data)) {
                echo json_encode(array("statusCode" => 'departmentcheck'));
            } else {
                $this->model("Departments")->update($data);
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
                'departmentId' => trim($_POST['id']) ,
            ];
                $this->model("Departments")->delete($data);
            
            
           
	    }
    }
    }
    public function deletemultiple(){
    if(count($_POST)>0){
        if($_POST['type']=='deletemultiple'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $id = explode(',', trim($_POST['id']));
            $data = [
                'departmentId' => $id ,
            ];
            print_r($data);
            $this->model("Departments")->deletemultiple($data);
            
        }
    }
}
}
?>
