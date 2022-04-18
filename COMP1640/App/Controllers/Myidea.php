<?php

use PHPMailer\PHPMailer\PHPMailer;
class Myidea extends Controller
{
    public function __construct()
    {
       
    }
    public function index($page = '')
    {
        $data = [
            'title' => 'My idea',
            'category' => $this->model("Categories")->readall(),
            'submissions' => $this->model("Submissions")->readall(),
            'submiss' => $this->model("Submissions")->readall(),
            'user' => $this->model("User")->getall(),
            'reaction' => $this->model("Reaction")->read(),
            'comment' => $this->model("Comments")->read(),
            'show' => $this->model("Myideas")->read(),

        ];
        $data['perpage'] = 5;

        if (isset($page) & !empty($page)) {
            $data['curpage'] = $page;
        }
        else {
            $data['curpage'] = 1;
        }

        // echo  $data['curpage'];
        $data['start'] = ($data['curpage'] * $data['perpage']) - $data['perpage'];
        $data['totalres'] = $this->model("Myideas")->pagination();
        $data['endpage'] = ceil($data['totalres'] / $data['perpage']);
        $data['startpage'] = 1;
        $data['nextpage'] = $data['curpage'] + 1;
        $data['previouspage'] = $data['curpage'] - 1;
        $data['showadmin'] = $this->model("Myideas")->showadmin($data);
        $data['show'] = $this->model("Myideas")->show($data);
        
        // var_dump($data['show']);

        $this->view('pages/myidea', $data);
    }
    public function create()
    {
        if (count($_POST) > 0) {
            if ($_POST['type'] == 'create') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Sanitize post data
                $folderimg = "/www/wwwroot/206.189.84.57/App/Views/dist/img/";
                $image = $_FILES['imgpost']['name'];
                $pathimg = $folderimg . $image;

                $folderfile = "/www/wwwroot/206.189.84.57/App/Views/dist/file/";
                $file = $_FILES['package']['name'];
                $pathfile = $folderfile . $file;
              
                $data = [
                    'titlename' => trim($_POST['titlepost']),
                    'img' => trim($_FILES['imgpost']['name']),
                    'content' => trim($_POST['textpost']),
                    'anonymous' => trim($_POST['anonymouss']),
                    'term' => trim($_POST['term']),
                    'category_id' => trim($_POST['category']),
                    'createAt' => date("Y-m-d H:i:s"),
                    'updateAt' => date("Y-m-d H:i:s"),
                    'submissionId' => trim($_POST['submission']),
                    'user_id' => trim($_SESSION["user_id"]),
                    'email' =>trim($this->model("User")->getuser()[0]['email']),
                    'closure_date' => $_POST['closure_date'],
                    'package' =>trim($_FILES['package']['name']),
                ];
              
                // add img 
                $today = date("Y-m-d H:i:s");
                

                if (empty($data['titlename']) || empty($data['content'])) {
                    echo json_encode(array("statusCode" => 201));
                }
                else if ($data['term'] != '1') {
                    echo json_encode(array("statusCode" => 'tos'));
                }else if($today > $data['closure_date'])   {
                    echo json_encode(array("statusCode" => 'closuredate'));
                }
                else if (isset($_FILES['imgpost']['name'])) {
                        // image
                        $allowed = array('jpeg', 'png', 'jpg','gif');
                        $ext = pathinfo($image, PATHINFO_EXTENSION);
                        //file
                        $extfile = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        $valid_ext = array("zip","rar","docx","pdf","doc");
                        if (!in_array($ext, $allowed)) {
                            echo json_encode(array("statusCode" =>  "errimage"));
                        }elseif(isset($_FILES['package']['name']))
                        { if(!in_array($extfile, $valid_ext)){
                            echo json_encode(array("statusCode" => "errfile"));
                        }}else{
                            if (file_exists($pathimg)) {
                                if(file_exists($pathfile)){
                                    $this->model("Myideas")->create($data);
                                    $this->sendmailctrl($data);
                                    echo json_encode(array("statusCode" => 200));
                                }
                                elseif(!file_exists($pathfile)){
                                    move_uploaded_file($_FILES['package']['tmp_name'], $pathfile);
                                    $this->model("Myideas")->create($data);
                                    $this->sendmailctrl($data);
                                    echo json_encode(array("statusCode" => 200));
                                }
                            }elseif(!file_exists($pathimg)){
                                if(file_exists($pathfile)){
                                    move_uploaded_file($_FILES['imgpost']['tmp_name'], $pathimg);
                                    $this->model("Myideas")->create($data);
                                    $this->sendmailctrl($data);
                                    echo json_encode(array("statusCode" => 200));
                                }
                                elseif(!file_exists($pathfile)){
                                    move_uploaded_file($_FILES['imgpost']['tmp_name'], $pathimg);
                                    move_uploaded_file($_FILES['package']['tmp_name'], $pathfile);
                                    $this->model("Myideas")->create($data);
                                    $this->sendmailctrl($data);
                                    echo json_encode(array("statusCode" => 200));
                                }
                            }
                        }
                        
                      
                }elseif(isset($_FILES['package']['name'])){
                    $extfile = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $valid_ext = array("zip","rar","docx","pdf","doc");
                    if(!in_array($extfile, $valid_ext)){
                        echo json_encode(array("statusCode" => "errfile"));
                    }else{
                            if(file_exists($pathfile)){
                                $this->model("Myideas")->create($data);
                                $this->sendmailctrl($data);
                                echo json_encode(array("statusCode" => 200));
                            }
                            elseif(!file_exists($pathfile)){
                                move_uploaded_file($_FILES['package']['tmp_name'], $pathfile);
                                $this->model("Myideas")->create($data);
                                $this->sendmailctrl($data);
                                echo json_encode(array("statusCode" => 200));
                            }
                        }
                        }
                    else{
                            $this->model("Myideas")->create($data);
                            echo json_encode(array("statusCode" => 200));
                            $this->sendmailctrl($data);
                        }

            }
        }
    }



    function uploadfile ($countfiles,$folderfile){
        $files_arr = array();
        for($index = 0;$index < $countfiles;$index++){
            if(isset($_FILES['package']['name'][$index]) && $_FILES['package']['name'][$index] != ''){
                /* File name */
                $filename = $_FILES['package']['name'][$index];
        
                /* Get extension */
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
                /* Valid image extension */
                $valid_ext = array("zip","rar","docx","pdf","docx");
        
                /* Check extension */
                if(in_array($ext, $valid_ext)){
        
                    /* File path */
                    $path = $folderfile.$filename;
        
                    /* Upload file */
                    if(move_uploaded_file($_FILES['package']['tmp_name'][$index],$path)){
                    $files_arr[] = $path;
                    }
                }
            }
        }
        }
    public function update()
    {
        if (count($_POST) > 0) {
            if ($_POST['type'] == 'update') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Sanitize post data
                $folder = "/www/wwwroot/206.189.84.57/App/Views/dist/img/";
                $image = $_FILES['imgpost']['name'];
                $path = $folder . $image;
                $data = [
                    'ideaId' => trim($_POST['ideaId']),
                    'titlename' => trim($_POST['titlepost']),
                    'img' => trim($_FILES['imgpost']['name']),
                    'content' => trim($_POST['textpost']),
                    'anonymous' => trim($_POST['anonymouss']),
                    'category_id' => trim($_POST['category']),
                    'updateAt' => date("Y-m-d H:i:s"),
                    'submissionId' => trim($_POST['submission']),
                    'user_id' => trim($_SESSION["user_id"]),
                ];

                // add img 
                if (empty($data['titlename']) || empty($data['content'])) {
                    echo json_encode(array("statusCode" => 201));
                }
                else
                    if (isset($_FILES['imgpost']['name'])) {

                        $allowed = array('jpeg', 'png', 'jpg');
                        $ext = pathinfo($image, PATHINFO_EXTENSION);
                        if (!in_array($ext, $allowed)) {
                            return "Sorry, only JPG, JPEG, PNG & GIF  files are allowed.";
                        }
                        if (file_exists($path)) {
                            $this->model("Myideas")->update($data);
                            echo json_encode(array("statusCode" => 200));
                        }
                        else {
                            move_uploaded_file($_FILES['imgpost']['tmp_name'], $path);
                            $this->model("Myideas")->update($data);
                            echo json_encode(array("statusCode" => 200));
                        }

                    }
                    else {
                        $this->model("Myideas")->update($data);
                        echo json_encode(array("statusCode" => 200));
                    }


            }

        }
    }
    public function delete()
    {
        if (count($_POST) > 0) {
            if ($_POST['type'] == 'delete') {
                //Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'ideaId' => trim($_POST['id']),
                ];
                $this->model("Myideas")->delete($data);



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
                    'ideaId' => $id,
                ];
                print_r($data);
                $this->model("Myideas")->deletemultiple($data);

            }
        }    }

    public function sendmailctrl($data)
    {
        include("./App/Views/plugins/PHPMailer/sendmail.php");
        $subject = "Hello user ".$_SESSION['username']." has post a new idea: ".$data['titlename'];
        $body = "New ideal create success <br>
                Content: ".$data['content']."<br>
                Create at: ".$data['createAt']."<br>";
        $receive= $this->model("User")->GetQAforuser();
        sendmails($subject,$body,$receive);
       
       
    }

}
?>