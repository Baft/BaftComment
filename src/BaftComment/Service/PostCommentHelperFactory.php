<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace BaftComment\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Helper\FlashMessenger;
use BaftComment\View\Helper\PostCommentHelper;

class PostCommentHelperFactory implements FactoryInterface {

	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator        	
	 * @return FlashMessenger
	 */
	public function createService(ServiceLocatorInterface $serviceLocator) {

		$serviceLocator = $serviceLocator->getServiceLocator ();
		$helper = new PostCommentHelper ();
		// $controllerPluginManager = $serviceLocator->get('ControllerPluginManager');
		// $baftComment = $controllerPluginManager->get('baftComment');
		$config = $serviceLocator->get ( 'Config' );
		if (isset ( $config ['view_helper_config'] ['baftComment'] )) {
			$configHelper = $config ['view_helper_config'] ['baftComment'];
			$helper->setOptions ( $configHelper );
		}
		
		return $helper;
	
	}


}