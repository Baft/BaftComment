<?php

namespace BaftComment\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Response;
use Zend\Stdlib\ArrayStack;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController {

	/**
	 * open a disccussion by creating a comment
	 */
	public function createAction() {

		$comment = $this->getServiceLocator ()->get ( 'BaftComment\Service\Comment' )->createComment ( 'dsd' );
		var_dump ( $comment );
		
		return (new Response ())->setStatusCode ( 200 );
	
	}

	public function listMessageAction() {

		$commentId = $this->params ()->fromQuery ( 'cmnt', false );
		
		$messages = $this->getServiceLocator ()->get ( 'BaftComment\Service\Comment' )->readMessages ( $commentId, 'desc' );
		
		var_dump ( $messages->toArray () );
		return (new Response ())->setStatusCode ( 200 );
		
		$vm = new ViewModel ();
		$vm->setVariable ( 'comment_id', $commentId );
		$vm->setVariable ( 'messages', $messages );
		
		return $vm;
	
	}

	/**
	 * leave a message in comment
	 */
	public function leaveMessageAction() {

		$vm = new JsonModel ();
		
		$messageForm = $this->getServiceLocator ()->get ( 'formelementmanager' )->get ( 'BaftComment\Form\MessageForm' );
		$vm->setVariable ( 'message_form', $messageForm );
		
		$messageData = $this->params ()->FromPost ();
		
		$parentMessageId = $this->params ()->fromQuery ( 'pmsg', false );
		
		$commentId = $this->params ()->fromQuery ( 'cmnt', false );
		if ($commentId)
			$vm = new ViewModel ();
		

		if ($this->getRequest ()->isPost () && isset ( $messageData ['submit'] )) {
			

			// comment id : replace from query to post data (just if post data is empty and _GET is exist)
			if ($commentId)
				$messageData ['cmnt'] = $commentId;
				
				// parent message : replace from query to post data (just if post data is empty and _GET is exist)
				// if($parentMessageId && (!isset($messageData['pmsg']) || empty($messageData['pmsg']) ))
			if ($parentMessageId)
				$messageData ['prnt_msg'] = $parentMessageId;
			
			$commentEvent = $this->getServiceLocator ()->get ( 'BaftComment\Service\Comment' )->createMessage ( $messageData );
			
			if ($commentEvent->hasError ()) {
				// var_dump($commentEvent->getErrorMessages() );
				foreach ( $commentEvent->getErrorMessages () as $exception => $messages )
					foreach ( $messages as $message ) {
						// $this->flashMessenger()->addErrorMessage($message->getMessage());
						$vm->setVariable ( 'content', $message->getMessage () );
					}
				return $vm;
			}
			
			$vm->setVariable ( 'content', "ثبت با موفقیت انجام شد" );
			// $this->flashMessenger()->addSuccessMessage('message succesfully post to comment');
		}
		
		$vm->setVariable ( 'parent_message_id', $parentMessageId );
		$vm->setVariable ( 'comment_id', $commentId );
		

		return $vm;
	
	}

	/**
	 * owner of message can edit message
	 */
	public function editMessageAction() {

	}


}
