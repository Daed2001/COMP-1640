<?php
class Comment extends Controller
{
    public function add(){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'Content' => trim($_POST['comment_content']),
                'Anonymous' =>  trim($_POST['anonymouss']),
                'ideaId' =>  trim($_POST['idea_id']),
                'userId' =>  trim($this->model("User")->getiduser()),
                'createAt' =>  date("Y-m-d H:i:s"),
            ];
            if(empty($data['Content'])){
                $response['status'] = "Comment is empty";

                echo json_encode($response);
    
            }else{
                $this->model("Comments")->add($data);
                $response['status'] = "Add comment success fully";
                $response['comment'] = 
                 '<div class="media mb-4" style="color:black">
                    <img class="rounded-circle border align-self-start mr-3" style="width: 40px; height: 40px;" id="img-user"  src="/App/Views/dist/img/user2-160x160.jpg" alt="">
                    <div class="media-body">
                       <h5 class="mt-0">'.$this->showcomment($data).'</h5>
                       <p>'.$data['Content'].'</p>
                       
                    </div>
                    </div>
                 ';
                $this->sendmailscmt($data);
                echo json_encode($response);
            
    }
    }

    // public function sendmailscmts($data){
    //   include("./App/Views/plugins/PHPMailer/sendmail.php");
    //   $subject = 'Hello Your idea '.$data['titlename'].' has just received a new comment';
    //   $body = 'Your idea '.$data['titlename'].' has just received a new comment by Anonymous';
    //   // $data = [
    //   //   'ideaId' => 46
    //   // ];
    //   $receive= $this->model("Idea")->userbyideaID($data['ideaId'])[0];
    //   // print_r($receive);
    //   return sendmails($subject,$body,$receive);
    // }

    public function sendmailscmt($data)
    {
        include("./App/Views/plugins/PHPMailer/sendmail.php");
        $subject = 'Hello Your idea '.$data['titlename'].' has just received a new comment';
        $body = 'Your idea '.$data['titlename'].' has just received a new comment by Anonymous';
        $receive= $this->model("Idea")->userbyideaID($data['ideaId']);
        sendmails($subject,$body,$receive);
    }
    public function showcomment($data){
      if($data['Anonymous'] == 1){
            return "Anonymous";
      }else{
          $result = $this->model('Comments')->getusername($data['userId']);
        return $result[0]['username'];
      }; 
    }

}

?>