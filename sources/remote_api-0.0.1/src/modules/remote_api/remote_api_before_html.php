<?php


if(isModuleInstalled("IXR_Library") and getconfig("remote_api_enabled")
   and isset($_GET["remote"])){
   include_once(getModulePath("IXR_Library").'IXR_Library.php');

class SimpleServer extends IXR_Server {
    function SimpleServer() {
        $this->user = null;
        $this->IXR_Server(array(
            'demo.sayHello' => 'this:sayHello',
            'demo.addTwoNumbers' => 'this:addTwoNumbers',
            'demo.fortune' => 'this:fortune',
            'version.release' => 'this:getRelease',
            'version.internal' => 'this:getInternalVersion',
            'version.development' => 'this:isDevelopmentVersion',
            'auth.login' => 'this:checkLogin',
            'cache.clear' => 'this:clear_cache',
            'users.onlinenow' => 'this:onlineUsers',
            'modules.list' => 'this:listModules'
        ));
    }
    
    function fortune(){
      if(!isModuleInstalled("fortune"))    
          return null;
          
      if(!function_exists("getRandomFortune"))
          include_once getModulePath("fortune")."fortune_lib.php";
      
      return getRandomFortune();        
    
    }    
    
    function sayHello($args) {
        return 'Hello World!';
    }
    
    function onlineUsers($args){
           if(!$this->checkLogin(array($args[0], $args[1])))
          return null;
       
          return array_values(getOnlineUsers());
    }
    
    function listModules($args){
       if(!$this->checkLogin(array($args[0], $args[1])))
          return null;
       
          return array_values(getAllModules());
    }
    
    function clear_cache($args){
       if(!$this->checkLogin(array($args[0], $args[1])))
          return false;
          
       clearCache();    
       return true;
    }

    function getRelease(){
       $version = new ulicms_version();
       return $version->getVersion();    
    }
    
    
     function isDevelopmentVersion(){
       $version = new ulicms_version();
       return $version->getDevelopmentVersion();   
    }

    function getInternalVersion(){
       $version = new ulicms_version();
       return $version->getInternalVersion();
    }    
    
    function checkLogin($args){
        $data = validate_login($args[0], $args[1]);
        if($data){
          $this->user = $data;
          return true;
        } else{
          $this->user = null;
          return false;        
        }
    
    }
    
    function addTwoNumbers($args) {
        $number1 = $args[0];
        $number2 = $args[1];
        return $number1 + $number2;
    }
}

$server = new SimpleServer();
   
   
} else if(isModuleInstalled("IXR_Library") and !getconfig("remote_api_enabled")
   and isset($_GET["remote"])){
   header("Content-Type: text/plain;");
   die("Remote API is disabled.");
}
   
?>