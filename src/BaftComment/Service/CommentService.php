<?php

namespace BaftComment\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface, Zend\ServiceManager\ServiceManager;
use BaftComment\Entity\BaftcommentComment;
use Zend\EventManager\EventManager;
use BaftComment\Entity\BaftcommentMessage;
use Zend\EventManager\EventManagerAwareInterface;
use BaftComment\Event\CommentEvent;
use BaftComment;
use Zend\Form\Form;
use BaftComment\Exception\CreateMessageException;

class CommentService implements ServiceManagerAwareInterface, EventManagerAwareInterface {

	/**
	 *
	 * @var ServiceManager
	 */
	protected $serviceManager;
	protected $eventManager;

	/**
	 * get comment
	 *
	 * @param int $limit
	 * @param int $offset
	 * @param int $tagId
	 * @return array
	 */
	public function getComment($comment) {

		return $this->threadMapper->getLatestThreads ( $limit, $offset, $tagId );

	}

	public function getCommentMessages($comment, $limit = 25, $offset = 0) {

	}

	/**
	 * createThread
	 *
	 * @param ThreadInterface $thread
	 * @return ThreadInterface
	 */
	public function createComment($slug,$subject) {

		$commentEntity = new BaftcommentComment ();
		$commentEntity->setSlug( $slug );
		$commentEntity->setDiscussSubject ( $subject );
		$commentEntity->setActive ( true );

		$this->getEventManager ()->trigger ( CommentEvent::COMMENT_PRE_EVENT, $this, array (
				'comment' => $commentEntity
		) );

		$commentModel = $this->getServiceManager ()->get ( 'BaftComment\Model\Comment' );
		$commentEntity = $commentModel->create ( $commentEntity );

		$this->getEventManager ()->trigger ( CommentEvent::COMMENT_EVENT, $this, array (
				'comment' => $commentEntity
		) );

		return $commentEntity;

	}

	/**
	 * updateThread
	 *
	 * @param ThreadInterface $thread
	 * @return ThreadInterface
	 */
	public function updateComment($commentEntity) {

		$comment;

		$this->getEventManager ()->trigger ( __FUNCTION__, $this, array (
				'comment' => $commentEntity
		) );

		return $comment;

	}

	/**
	 * createMessage
	 *
	 * @param array $data
	 * @return MessageInterface
	 */
	public function createMessage($messageData) {

		$commentEvent = $this->getServiceManager ()->get ( 'BaftComment\Event\CommentEvent' );
		$commentEvent->setTarget ( $this );
		$commentEvent->setParam ( 'message_form_data', $messageData );

		// @TODO move this to event listener on messagePre
		$form = $this->MessageFormValidate ( $messageData );

		if (! $form->isValid ()) {
			$commentEvent->setError ( true );

			foreach ( $form->getMessages () as $field => $messages ) {
				foreach ( $messages as $validationLabel => $message )
					$commentEvent->addErrorMessages ( new CreateMessageException ( $form->get ( $field )->getLabel () . " : " . $message ) );
			}
			return $commentEvent;
		}

		$messageEntity = $form->getObject ();
		
		$userId=0;
		$authorName="anonymous";
		
		if($this->getServiceManager()->has('zfcuser_auth_service')){
			$authnService=$this->getServiceManager()->get('zfcuser_auth_service');
			if($authnService->hasIdentity()){
				$userId=$authnService->getIdentity()->getId();
				$authorName=$authnService->getIdentity()->getDisplayName();
			}
		}
		// @TODO fill author info by di or adapter that developer provide to be able connect to custome users
		
		$messageEntity->setAuthorName ($authorName );
		$messageEntity->setAuthor ( $userId );

		$eventResult = $this->getEventManager ()->trigger ( $commentEvent::MESSAGE_PRE_EVENT, $commentEvent, function ($response) {
			// var_dump($response);
		} );

		// var_dump($messageEntity);
		// persist message.
		$messageModel = $this->getServiceManager ()->get ( 'BaftComment\Model\Message' );
		$messageModel->create ( $messageEntity );
		$commentEvent->setMessages ( $messageEntity );

		// call other
		$eventResult = $this->getEventManager ()->trigger ( $commentEvent::MESSAGE_EVENT, $commentEvent, function ($response) {} );

		return $commentEvent;

	}

	public function readMessages($commentId, $paginationOptions = []) {
		// @TODO implement pagination
		$commentEntity = $this->isExistComment ( $commentId );
		
		if(!$commentEntity instanceof BaftcommentComment)
			return [new BaftcommentMessage()];
		
		return $commentEntity->getMessages ();

	}

	/**
	 * validate message data by message form before use and return valid data
	 *
	 * @param array $messageData
	 * @return Form
	 */
	public function MessageFormValidate($messageData) {

		// Create new 'message' form and hydrator objects.
		$form = $this->getServiceManager ()->get ( 'formelementmanager' )->get ( 'BaftComment\Form\MessageForm' );
		$form->setHydrator ( new \Zend\Stdlib\Hydrator\ClassMethods () );

		// validate data against form
		$form->bind ( new BaftcommentMessage () );
		$form->setData ( $messageData );
		$form->setBindOnValidate ( $form::BIND_ON_VALIDATE );
		if (! $form->isValid ())
			return $form;

		$formData = $form->getData ( $form::VALUES_AS_ARRAY );

		// @TODO using hydrator to map form fields to entity properties
		$parentMessage = $formData ['prnt_msg'];
		if ($parentMessage instanceof BaftcommentMessage) {
			$parentMessage = $parentMessage->getId ();
		}

		$form->getObject ()->setRefComment ( $formData ['cmnt'] );
		$form->getObject ()->setParentMessageId ( $parentMessage );

		return $form;

	}

	/**
	 *
	 * @param int $commentId
	 * @return boolean|BaftcommentComment
	 */
	public function isExistComment($commentId) {

		$commentEntity = null;
		$commentModel = $this->getServiceManager ()->get ( 'BaftComment\Model\Comment' );
		if (! $commentEntity = $commentModel->find ( $commentId ))
			return false;
		return $commentEntity;

	}

	/**
	 *
	 * @param int $messageId
	 * @return boolean|BaftcommentMessage
	 */
	public function isExistMessage($messageId) {

		$messageEntity = null;
		$messageModel = $this->getServiceManager ()->get ( 'BaftComment\Model\Message' );
		if (! $messageEntity = $messageModel->find ( $messageId ))
			return false;
		return $messageEntity;

	}

	/**
	 * updateMessage
	 *
	 * @param MessageInterface $message
	 * @return MessageInterface
	 */
	public function updateMessage(MessageInterface $message) {

		$message->setPostTime ( new \DateTime () );
		return $this->messageMapper->persist ( $message );

	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \Zend\EventManager\EventManagerAwareInterface::setEventManager()
	 */
	public function setEventManager(\Zend\EventManager\EventManagerInterface $eventManager) {

		$eventManager->setIdentifiers ( [
				__CLASS__,
				get_called_class (),
				'BaftComment'
		] );
		$eventManager->setEventClass ( '\BaftComment\Event\CommentEvent' );
		$this->eventManager = $eventManager;
		return $this;

	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \Zend\EventManager\EventsCapableInterface::getEventManager()
	 */
	public function getEventManager() {

		if (! isset ( $this->eventManager )) {
			$this->setEventManager ( new EventManager () );
		}
		return $this->eventManager;

	}

	/**
	 * Retrieve service manager instance
	 *
	 * @return ServiceManager
	 */
	public function getServiceManager() {

		return $this->serviceManager;

	}

	/**
	 * Set service manager instance
	 *
	 * @param ServiceManager $serviceManager
	 * @return Discuss
	 */
	public function setServiceManager(ServiceManager $serviceManager) {

		$this->serviceManager = $serviceManager;
		return $this;

	}


}
