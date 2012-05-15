<?php
class knl_ao_request_FrontController {
	private $bean;

	private static $instance;
	
 	private function __construct(){
		$this->bean = new knl_bean_request_FrontController();
		$this->setBeanFromRequest();
		$this->setBeanFromShell();
	}
	
	public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
	}
		
	private function setBeanFromRequest(){
		$this->bean->setApp(knl_lib_Registry::getRequestKey('a'));
		$this->bean->setController(knl_lib_Registry::getRequestKey('c'));
	}
	
	private function setBeanFromShell(){
		if (knl_lib_ShellArgs::getInstance()->isSetShellArgs()){
			$this->bean->setApp(knl_lib_Registry::getShellArg(1));
			$this->bean->setController(knl_lib_Registry::getShellArg(2));
		}
	}
	
	public function getBean(){
		return $this->bean;
	}
}
