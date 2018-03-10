<?php

namespace BaftComment\Form;

use Zend\Form\Form;
use Zend\Form\Element\Csrf;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MessageForm extends Form implements InputFilterProviderInterface, ServiceLocatorAwareInterface {
	
	/**
	 *
	 * @var ServiceLocatorInterface
	 */
	protected $serviceLocator;
	protected $comment;

	public function init() {

	}

	public function __construct() {

		parent::__construct ();
		
		// comment id
		$this->add ( array (
				'type' => 'hidden',
				'name' => 'cmnt',
				'options' => array (
						'label' => '' 
				),
				'attributes' => array () 
		) );
		
		// parent message
		$this->add ( array (
				'type' => 'hidden',
				'name' => 'prnt_msg',
				'options' => array (
						'label' => '' 
				),
				'attributes' => array () 
		) );
		
		$this->add ( array (
				'type' => 'csrf',
				'name' => 'message_csrf',
				'options' => array (
						'label' => '' 
				),
				'attributes' => array (
						'type' => 'csrf' 
				) 
		) );
		
		$this->add ( array (
				'name' => 'author_name',
				'options' => array (
						'label' => 'author name' 
				),
				'attributes' => array (
						'type' => 'text' 
				) 
		) );
		
		$this->add ( array (
				'name' => 'author_email',
				'options' => array (
						'label' => 'author email' 
				),
				'attributes' => array (
						'type' => 'text' 
				) 
		) );
		
		$this->add ( array (
				'name' => 'message_subject',
				'options' => array (
						'label' => 'Subject' 
				),
				'attributes' => array (
						'type' => 'text' 
				) 
		) );
		
		$this->add ( array (
				'type' => 'textarea',
				'name' => 'content',
				'options' => array (
						'label' => 'Message' 
				),
				'attributes' => array () 
		) );
		
		// Submit button.
		$this->add ( array (
				'name' => 'submit',
				'attributes' => array (
						'type' => 'submit',
						'value' => 'Post',
						'id' => 'submitbutton',
						'class' => 'btn btn-primary' 
				) 
		) );
	
	}

	
	/**
	 * comment id, to check exist in db
	 * 
	 * @param int $commentId        	
	 * @return boolean
	 */
	public function ConvertToCommentEntity($commentId) {

		$parentLocator = $this->getServiceLocator ()->getServiceLocator ();
		$commentEntity = $parentLocator->get ( 'BaftComment\Service\Comment' )->isExistComment ( $commentId );
		
		return $commentEntity;
	
	}

	/**
	 *
	 * @param int $messageId        	
	 * @return boolean
	 */
	public function ConvertToMessageEntity($messageId) {

		$parentLocator = $this->getServiceLocator ()->getServiceLocator ();
		$messageEntity = $parentLocator->get ( 'BaftComment\Service\Comment' )->isExistMessage ( $messageId );
		
		if (! $messageEntity)
			return 0;
		
		return $messageEntity;
	
	}

	/**
	 * Should return an array specification compatible with
	 * {@link Zend\InputFilter\Factory::createInputFilter()}.
	 *
	 * @return array
	 */
	public function getInputFilterSpecification() {

		return array (
				'cmnt' => array (
						'required' => true,
						'allow_empty' => false,
						'continue_if_empty' => false,
						'filters' => array (
								new \Zend\Filter\Callback ( [ 
										'callback' => array (
												$this,
												'ConvertToCommentEntity' 
										) 
								] ) 
						),
						'validators' => array (
								new \Zend\Validator\Callback ( [ 
										'callback' => function ($value) {
											return ( boolean ) $value;
										},
										'messages' => [ 
												\Zend\Validator\Callback::INVALID_VALUE => 'comment dose not found' 
										] 
								] ) 
						) 
				),
				'content' => array (
						'required' => true,
						'allow_empty' => false,
						'continue_if_empty' => false,
						'filters' => array (
								new \Zend\Filter\StringTrim () 
						),
						'validators' => array () 
				),
				
				'prnt_msg' => array (
						'required' => false,
						'allow_empty' => true,
						'filters' => array (
								new \Zend\Filter\Callback ( [ 
										'callback' => array (
												$this,
												'ConvertToMessageEntity' 
										) 
								] ) 
						) 
				),
				
				'message_csrf' => [ 
						'required' => true,
						'allow_empty' => false,
						'continue_if_empty' => false,
						'filters' => array (),
						'validators' => array (
								new \Zend\Validator\Csrf ( [ 
										'name' => 'message_csrf' 
								] ) 
						) 
				] 
		);
	
	}

	/**
	 * Set the service locator.
	 *
	 * @param ServiceLocatorInterface $serviceLocator        	
	 * @return AbstractHelper
	 */
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {

		$this->serviceLocator = $serviceLocator;
		return $this;
	
	}

	/**
	 * Get the service locator.
	 *
	 * @return ServiceLocatorInterface
	 */
	public function getServiceLocator() {

		return $this->serviceLocator;
	
	}


}
