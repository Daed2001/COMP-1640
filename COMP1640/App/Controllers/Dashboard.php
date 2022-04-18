<?php
class Dashboard extends Controller {
    public function __construct() {
        
    }

    public function index() {
        
        $data = [
            'title' => 'Dashboard',
            'ideadepartment' => $this->model('Charts')->ideadepartment(),
            'ideacount' => $this->model('Charts')->ideacount(),
            'contributor' => $this->model('Charts')->contributor(),
            'noidea' => $this->model('Charts') ->noidea(),
            'noideacount' => $this->model('Charts') ->noideacount(),
            'anonyidea' => $this->model('Charts') ->anonyidea(),
            'anonyideacount' => $this->model('Charts') ->anonyideacount(),
            'anonycomment' => $this->model('Charts') ->anonycomment(),
            'anonycommentcount' => $this->model('Charts') ->anonycommentcount(),
        ];

        $this->view('pages/dashboard', $data);
    }

    
}