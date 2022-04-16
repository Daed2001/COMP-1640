<?php
class Submission extends Controller
{
    public function __construct()
    {
        if ($_SESSION['role'] != 1) {
            header('location:' . URLROOT . '/dashboard/index');
        }
    }
    public function index($page = '')
    {
        $data = [
            'title' => 'Submission',
        ];
        $data['perpage'] = 5;
        
        if(isset($page) & !empty($page)){
            $data['curpage'] = $page;
        }else{
            $data['curpage'] = 1;
        }

        // echo  $data['curpage'];
        $data['start'] = ($data['curpage'] * $data['perpage']) - $data['perpage'];
        $data['totalres'] = $this->model("Submissions")->pagination();
        $data['endpage'] = ceil($data['totalres']/$data['perpage']);
        $data['startpage'] = 1;
        $data['nextpage'] = $data['curpage'] + 1;
        $data['previouspage'] = $data['curpage'] - 1;
        $data['show']= $this->model("Submissions")->read($data);
        // var_dump($data['show']);
        $this->view("pages/submission", $data);
    }

    public function create()
    {
        if (count($_POST) > 0) {
            if ($_POST['type'] == 'create') {

                //Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'submissionname' => trim($_POST['name']),
                    'content' => trim($_POST['content']),
                    'closuredate' => date("Y-m-d H:i:s", strtotime($_POST['closuredate'])),
                    'finalclosuredate' => date("Y-m-d H:i:s", strtotime($_POST['finalclosuredate'])),
                    'updateAt' => date("Y-m-d H:i:s"),
                    'createAt' => date("Y-m-d H:i:s"),

                ];
                
                if (empty($data['submissionname']) || empty($data['content'])) {
                    echo json_encode(array("statusCode" => 201));
                } else if ($this->model("Submissions")->submissioncheck($data)) {
                    echo json_encode(array("statusCode" => 'submissioncheck'));
                } else {
                    $this->model("Submissions")->create($data);
                    echo json_encode(array("statusCode" => 200));
                }

                //Validate field

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
                    'submissionId' => trim($_POST['id']),
                    'submissionname' => trim($_POST['name']),
                    'content' => trim($_POST['content']),
                    'closuredate' => date("Y-m-d H:i:s", strtotime($_POST['closuredate'])),
                    'finalclosuredate' => date("Y-m-d H:i:s", strtotime($_POST['finalclosuredate'])),
                    'updateAt' => date("Y-m-d H:i:s"),
                ];

                if (empty($data['submissionname']) || empty($data['content'])) {
                    echo json_encode(array("statusCode" => 201));
                } else if ($this->model("Submissions")->submissioncheckupdate($data)) {
                    echo json_encode(array("statusCode" => 'submissioncheck'));
                } else {
                    $this->model("Submissions")->update($data);
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
                    'submissionId' => trim($_POST['id']),
                ];
                $this->model("Submissions")->delete($data);

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
                    'submissionId' => $id,
                ];
                print_r($data);
                $this->model("Submissions")->deletemultiple($data);

            }
        }
    }
}
