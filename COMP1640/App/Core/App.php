<?php
class App {
    protected $controller = "Users";
    protected $action = "index";
    protected $params = [];
  
    function __construct() {
      $arr = $this->Urlprocess() ;
      //echo '<pre>';print_r($arr);'</pre>';exit;
      // xu li controller
      if($arr != NULL) {
      if (file_exists("./App/Controllers/".ucwords($arr[0]).".php")) {
        $this->controller = ucwords($arr[0]);
        unset($arr[0]);
      }
      
    } 
   
      require_once ("./App/Controllers/".$this->controller.".php");
      
      $this->controller = new $this->controller;
      // xu li action
      if (isset($arr[1])){
        if (method_exists($this->controller,$arr[1])) {
          $this->action = $arr[1];
        }
        unset($arr[1]);
      }
      // xu li params
      $this->params = $arr?array_values($arr):[];
      call_user_func_array([$this->controller, $this->action],$this->params);

    }
    function Urlprocess() {
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        } 
         
    }
}

?>