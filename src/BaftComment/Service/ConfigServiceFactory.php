<?php

namespace BaftComment\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Factory responsible of retrieving an array containing the BaftComment configuration
 */
class ConfigServiceFactory implements FactoryInterface {

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function createService(ServiceLocatorInterface $serviceLocator) {

		$config = $serviceLocator->get ( 'Config' );
		
		return $config ['baftcomment'];
	
	}


}
