<?php
class Category extends Controller
{
    public function __construct()
    {
        if ($_SESSION['role'] != 1 && $_SESSION['role'] != 3 ) {
            header('location:' . URLROOT . '/dashboard/index');
        }
    }
    public function index($page = '')
    {
        $data = [
            'title' => 'Category',
        ];
        $data['perpage'] = 5;
        
        if(isset($page) & !empty($page)){
            $data['curpage'] = $page;
        }else{
            $data['curpage'] = 1;
        }

        // echo  $data['curpage'];
        $data['start'] = ($data['curpage'] * $data['perpage']) - $data['perpage'];
        $data['totalres'] = $this->model("Categories")->pagination();
        $data['endpage'] = ceil($data['totalres']/$data['perpage']);
        $data['startpage'] = 1;
        $data['nextpage'] = $data['curpage'] + 1;
        $data['previouspage'] = $data['curpage'] - 1;
        $data['show']= $this->model("Categories")->read($data);
        // var_dump($data['show']);
        $this->view("pages/category", $data);
    }
    public function create()
    {
        if (count($_POST) > 0) {
            if ($_POST['type'] == 'create') {

                //Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'categoryname' => trim($_POST['name']),
                    'createAt' => date("Y-m-d H:i:s"),
                    'updateAt' => date("Y-m-d H:i:s"),
                ];

                if (empty($data['categoryname'])) {
                    echo json_encode(array("statusCode" => 201));
                } else if ($this->model("Categories")->categorycheck($data)) {
                    echo json_encode(array("statusCode" => 'categorycheck'));
                } else {
                    $this->model("Categories")->create($data);
                    echo json_encode(array("statusCode" => 200));
                }
                 
                
                }
                


            }
        }
    
    public function update()
    {
        if (count($_POST) > 0) {
            if ($_POST['type'] == 'update') {
                //Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'categoryId' => trim($_POST['id']),
                    'categoryname' => trim($_POST['name']),
                    'updateAt' => date("Y-m-d H:i:s"),
                ];
                if (empty($data['categoryname'])) {
                    echo json_encode(array("statusCode" => 201));
                } else if ($this->model("Categories")->categorycheckupdate($data)) {
                    echo json_encode(array("statusCode" => 'categorycheck'));
                } else {
                    $this->model("Categories")->update($data);
                    echo json_encode(array("statusCode" => 200));
                }

            }

        }}
    public function delete()
    {
        if (count($_POST) > 0) {
            if ($_POST['type'] == 'delete') {
                //Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'categoryId' => trim($_POST['id']),
                ];
                if ($this->model("Categories")->delete($data)) {
                    echo json_encode(array("statusCode" => 200));
                    } else echo json_encode(array("statusCode" => 201));
            }
        }
    }
    public function deletemultiple()
    {
        if (count($_POST) > 0) {
            if ($_POST['type'] == 'deletemultiple') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $id = explode(',', trim($_POST['id']));
                $data = [
                    'categoryId' => $id,
                ];
                if ($this->model("Categories")->deletemultiple($data)) {
                    echo json_encode(array("statusCode" => 200));
                    } else echo json_encode(array("statusCode" => 201));

            }
        }
    }
}
