<?php
if(isModuleInstalled("IXR_Library") and getconfig("remote_api_enabled")
   and isset($_GET["remote"])){
   include_once(getModulePath("IXR_Library").'IXR_Library.php');

class SimpleServer extends IXR_Server {
    function SimpleServer() {
        $this->IXR_Server(array(
            'demo.sayHello' => 'this:sayHello',
            'demo.addTwoNumbers' => 'this:addTwoNumbers',
            'version.release' => 'this:getRelease',
            'version.internal' => 'this:getInternalVersion',
            'version.development' => 'this:isDevelopmentVersion'
        ));
    }
    function sayHello($args) {
        return 'Hello World!';
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
    
    function addTwoNumbers($args) {
        $number1 = $args[0];
        $number2 = $args[1];
        return $number1 + $number2;
    }
}

$server = new SimpleServer();
   
   
   }
   
?>