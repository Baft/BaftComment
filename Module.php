<?php

namespace BaftComment;

use Zend\ModuleManager\ModuleManager;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\FormElementProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\ModuleEvent;
use Zend\Loader\StandardAutoloader;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface, ServiceProviderInterface, FormElementProviderInterface {

	public function getAutoloaderConfig() {

		$moduleNamespaces = include_once (__DIR__ . '/config/namespaces.config.php');
		return array (
				'Zend\Loader\ClassMapAutoloader' => array (
						__DIR__ . '/autoload_classmap.php' 
				),
				'Zend\Loader\StandardAutoloader' => array (
						StandardAutoloader::LOAD_NS => $moduleNamespaces 
				) 
		);
	
	}

	public function getFormElementConfig() {

		$FormConfig = include_once (__DIR__ . '/config/form.config.php');
		return $FormConfig;
	
	}

	/*
	 * (non-PHPdoc)
	 * @see \Zend\ModuleManager\Feature\ServiceProviderInterface::getServiceConfig()
	 */
	public function getServiceConfig() {

		$serviceConfig = include_once (__DIR__ . '/config/service.config.php');
		
		return $serviceConfig;
	
	}

	public function getConfig() {

		return include __DIR__ . '/config/module.config.php';
	
	}


}
