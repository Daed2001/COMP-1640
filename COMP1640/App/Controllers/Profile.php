<?php
class Profile extends Controller {
    public function __construct() {
        
    }

    public function index() {
       
        $data = [
            'title' => 'Profile',
            'user' => $this->model("User")->read(),
            'role' => $this->model("User")->getrole(),
            'profile' => $this->model("Departments")->getdepartment(),
        ];

        $this->view('pages/profile', $data);
    }


    public function update() {

    }
    
}