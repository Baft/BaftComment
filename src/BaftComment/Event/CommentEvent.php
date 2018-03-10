<?php

namespace BaftComment\Event;

use Zend\EventManager\Event;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use BaftComment\Exception\CommentExceptionInterface;
use Zend\Stdlib\ArrayStack;
use BaftComment\Entity\BaftcommentMessage;

class CommentEvent extends Event implements FactoryInterface {

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public function createService(ServiceLocatorInterface $serviceLocator) {

		return new static ();
	
	}
	/**
	 *
	 * @var string comment created event
	 */
	CONST COMMENT_EVENT = 'comment';
	
	/**
	 *
	 * @var string before create comment
	 */
	CONST COMMENT_PRE_EVENT = 'comment.pre';
	
	/**
	 *
	 * @var string message created event
	 */
	CONST MESSAGE_EVENT = 'message';
	
	/**
	 *
	 * @var string before create message
	 */
	CONST MESSAGE_PRE_EVENT = 'message.pre';
	
	/**
	 *
	 * @var string on error occur
	 */
	CONST ERROR_EVENT = 'error';
	

	/**
	 *
	 * @var \BaftComment\Entity\BaftcommentComment
	 */
	private $comment;
	
	/**
	 *
	 * @var \Zend\Stdlib\ArrayStack
	 */
	private $messages;
	
	/**
	 *
	 * @var \BaftComment\Entity\BaftcommentMessageRevision
	 */
	private $messageRevision;
	
	/**
	 *
	 * @var boolean
	 */
	private $error = false;
	
	/**
	 *
	 * @var array
	 */
	private $errorMessages = [ ];

	public function __construct() {

	}

	/**
	 *
	 * @return boolean
	 */
	public function hasError() {

		return $this->error;
	
	}

	/**
	 *
	 * @param boolean $error        	
	 * @return \BaftComment\Event\CommentEvent
	 */
	public function setError($error) {

		$this->error = $error;
		return $this;
	
	}

	/**
	 *
	 * @param array|string $message        	
	 * @return \BaftComment\Event\CommentEvent
	 */
	public function addErrorMessages(CommentExceptionInterface $message) {

		$this->errorMessages [get_class ( $message )] [] = $message;
		return $this;
	
	}

	/**
	 *
	 * @return array
	 */
	public function getErrorMessages() {

		return $this->errorMessages;
	
	}

	
	/**
	 *
	 * @return the BaftcommentComment
	 */
	public function getComment() {

		return $this->comment;
	
	}

	/**
	 *
	 * @param
	 *        	$comment
	 */
	public function setComment($comment) {

		$this->comment = $comment;
		return $this;
	
	}

	/**
	 *
	 * @return the BaftcommentMessage
	 */
	public function getMessages() {

		if (! isset ( $this->messages ))
			$this->setMessages ( [ ] );
		return $this->messages;
	
	}

	/**
	 *
	 * @param
	 *        	$message
	 */
	public function setMessages($message) {

		if ($message instanceof BaftcommentMessage)
			$this->getMessages ()->append ( $message );
		
		if (($message instanceof \Traversable || is_array ( $message )) && ! isset ( $this->messages ))
			$this->messages = new ArrayStack ( $message );
		
		return $this;
	
	}

	public function addMessage($message) {

		if ($message instanceof BaftcommentMessage)
			$this->getMessages ()->append ( $message );
		return $this;
	
	}

	/**
	 *
	 * @return the BaftcommentMessageRevision
	 */
	public function getMessageRevision() {

		return $this->messageRevision;
	
	}

	/**
	 *
	 * @param
	 *        	$messageRevision
	 */
	public function setMessageRevision($messageRevision) {

		$this->messageRevision = $messageRevision;
		return $this;
	
	}


}