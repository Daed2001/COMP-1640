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
        ];

        $this->view('pages/dashboard', $data);
    }

    
}