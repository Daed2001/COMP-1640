<?php 
class Idea extends Controller {
    public function __construct() {
        
    }
    public function index($type='',$page = ''){
        $data = [
            'title' => 'Idea',
            'user' => $this->model("User")->findUserIdbyideaid(),
            'reaction' => $this->model("Reaction")->read(),
            'comment' => $this->model("Comments")->read(),
            'category' => $this->model("Categories")->readall(),
            'submission' => $this->model("Submissions")->readallsubmit(),

            // 'uservote' =>$this->uservote(),
        ];
        $data['perpage'] = 5;

        if (isset($page) & !empty($page)) {
            $data['curpage'] = $page;
        }
        else {
            $data['curpage'] = 1;
        }
        $data['type'] = $type;
        // echo  $data['curpage'];
        $data['start'] = ($data['curpage'] * $data['perpage']) - $data['perpage'];
        $data['totalres'] = $this->model("Myideas")->pagination();
        $data['endpage'] = ceil($data['totalres'] / $data['perpage']);
        $data['startpage'] = 1;
        $data['nextpage'] = $data['curpage'] + 1;
        $data['previouspage'] = $data['curpage'] - 1;
        if($type==''){
            $data['show'] = $this->model("Myideas")->lastest($data);
            $data['type'] = 'lastest';
    } else 
    $data['show'] = $this->model("Myideas")->$type($data);
        $this->view("pages/idea", $data);
    }
    public function voting(){
        $data = [
			'reaction' => '',
            'ideaId' => '',
            'userId' => '',
            'createAt' => '',
		];
        if($_POST['type']== 'voteup'){
            $data = [
                'reaction' => trim('1'),
                'ideaId' =>  trim($_POST['id']),
                'userId' =>  trim($this->model("User")->getiduser()),
                'createAt' =>  date("Y-m-d H:i:s"),
            ];
            $voting = $this->model("Reaction")->count_vote($_SESSION['user_id'],$data['ideaId'],$data['reaction']);
            $votingif = $this->model("Reaction")->count_vote($_SESSION['user_id'],$data['ideaId'],0);
                    if($voting[0]["COUNT(*)"] >= 1){
                        $this->model("Reaction")->delete_reaction($data['ideaId'],$data['reaction']);
                        echo json_encode([
                            'operation' => "up",
                            'totalvote' => $this->totalvote(),
                            'voting_status' => 'up-black'
                            ]);
                    
                    }elseif($voting[0]["COUNT(*)"] == 0){
                        if($votingif[0]["COUNT(*)"] >= 1){
                            $this->model("Reaction")->delete_reaction($data['ideaId'],0);  
                            $this->model("Reaction")->add($data);
                                echo json_encode([
                                    'operation' => "up",
                                    'totalvote' => $this->totalvote(),
                                    'voting_status' => 'up-green-down-black'
                                    ]);
                        }else{
                            $this->model("Reaction")->add($data);
                            echo json_encode([
                                'operation' => "up",
                                'totalvote' => $this->totalvote(),
                                'voting_status' => 'up-green'
                                ]);
                        }
                        
     
                    }
                    }
                

            
         
         if($_POST['type']== 'votedown'){
            $data = [
                'reaction' => trim('0'),
                'ideaId' =>  trim($_POST['id']),
                'userId' =>  trim($this->model("User")->getiduser()),
                'createAt' =>  date("Y-m-d H:i:s"),
            ];
             $voting = $this->model("Reaction")->count_vote($_SESSION['user_id'],$data['ideaId'],$data['reaction']);
             $votingif = $this->model("Reaction")->count_vote($_SESSION['user_id'],$data['ideaId'],1);
                if($voting[0]["COUNT(*)"] == 0){
                    if($votingif[0]["COUNT(*)"] == 1){
                        $this->model("Reaction")->delete_reaction($data['ideaId'],1);  
                        $this->model("Reaction")->add($data);
                    echo json_encode([
                        'operation' => "down",
                        'totalvote' => $this->totalvote(),
                        'voting_status' => 'down-red-up-black'
                        ]);
                    }else{
                            $this->model("Reaction")->add($data);
                        echo json_encode([
                            'operation' => "down",
                            'totalvote' => $this->totalvote(),
                            'voting_status' => 'down-red'
                            ]);
                    }
                    
                    //  $this->model("Reaction")->delete_reaction($data['ideaId'],$data['reaction']);
             }elseif($voting[0]["COUNT(*)"] >= 1){
               
                    //  $this->model("Reaction")->add($data);
                    $this->model("Reaction")->delete_reaction($data['ideaId'],$data['reaction']);   
                    echo json_encode([
                        'operation' => "down",
                        'totalvote' => $this->totalvote(),
                        'voting_status' => 'down-black',
                        ]);
             }
                
        
            }

    }
    public function totalvote(){
        $row = $this->model("Reaction")->read();
        $totalvote = 0;
        foreach($row as $reaction){
           if ($reaction['ideaId'] == $_POST['id']){
              if($reaction['reaction'] == 1){
                 $totalvote +=1;
              }if ($reaction['reaction'] == 0){
                 $totalvote -=1;
              }
           }
        };
        return $totalvote;
    }

    // public function uservote(){
    //     $row = $this->model("Reaction")->Getreactbyuserid();
    //     $uservote = 0;
    //     foreach($row as $reaction){
    //        if ($reaction['ideaId'] == $_POST['id']){
    //           if($reaction['reaction'] == 1){
    //              $uservote +=1;
    //           }if ($reaction['reaction'] == 0){
    //              $uservote -=1;
    //           }
    //        }
    //     };
    //     if($uservote == 0){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }

    

}
?>
