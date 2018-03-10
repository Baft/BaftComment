<?php

namespace BaftComment\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository implements ServiceLocatorAwareInterface {
	public $serviceLocator;

	/**
	 * Set service locator
	 *
	 * @param ServiceLocatorInterface $serviceLocator        	
	 */
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {

		$this->serviceLocator = $serviceLocator;
	
	}

	/**
	 * override : find by id or slug
	 * 
	 * {@inheritDoc}
	 *
	 * @see \Doctrine\ORM\EntityRepository::find()
	 */
	public function find($id, $lockMode = null, $lockVersion = null) {

		if (is_string ( $id ) && ( string ) $id === $id)
			return $this->findOneBySlug ( $id );
		
		return parent::find ( $id, $lockMode, $lockVersion );
	
	}

	/**
	 * Get service locator
	 *
	 * @return ServiceLocatorInterface
	 */
	public function getServiceLocator() {

		return $this->serviceLocator;
	
	}

	public function create($commentEntity) {

		$this->getEntityManager ()->persist ( $commentEntity );
		$this->getEntityManager ()->flush ();
		return $commentEntity;
	
	}


}