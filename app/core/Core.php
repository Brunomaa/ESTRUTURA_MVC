<?php 

class Core{ 
    private  $controller;
    private  $metodo;
    private  $parametros = array();
    
    public function __construct() {
        $this->verificaUri();
    }

    public function run(){
        
        $controllerCorrente = $this->getController();
        $c = new $controllerCorrente;
        call_user_func_array(array($c, $this->getMetodo()), $this->getParametros());
     
    }

    public function verificaUri(){
         $url = explode("index.php", $_SERVER["PHP_SELF"]);
         $url = end($url);
        
         
         if ($url != "") {
             
             $url = explode('/',$url);    
             array_shift($url);
             
             //Pega o Controller
             $this->controller = ucfirst($url[0])."Controller";
              array_shift($url);
             
             //Pega o Método
             if(isset($url[0])) {
                $this->metodo = $url[0];
                 array_shift($url);
             }
             //Pega os Parametros
              if(isset($url[0])) {
             $this->parametros = array_filter($url);        
             }              
         }  else {
             $this->controller = "IndexController";
         }
                  
       
     }
  
      public function getController() {
          if(class_exists("app\\controllers\\" .$this->controller)) {          
               return "app\\controllers\\" .$this->controller;
          } else {
             
          return "app\\controllers\\indexController";
          } 
     }

     public function getMetodo() {
        
         
         if (method_exists("app\\controllers\\" .$this->controller, $this->metodo)) {
             
           return $this->metodo;
         } else {
         
           return "index";   
         }
         
         
         
         
     }

    public function getParametros() {
         return $this->parametros;
     }

 
     
     
} 