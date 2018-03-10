<?php

namespace BaftComment\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Model\ViewModel;

class PostCommentHelper extends AbstractHelper implements ServiceLocatorAwareInterface {
	
	/**
	 *
	 * @var ServiceLocatorInterface
	 */
	protected $serviceLocator;
	private $commentId;
	private $parentMessage;
	private $options = [
			// for $form->setAttributes
			'form_attributes' => [ ],
			// template file to render form
			'template' => '',
			// pass this variable to template file to be render
			'template_variables' => [ ] 
	];

	public function __invoke($commentId, $parentMessage = 0) {

		$this->setParentMessage ( $parentMessage );
		$this->setCommentId ( $commentId );
		return $this;
	
	}

	public function __toString() {

		try {
			return $this->render ();
		}
		catch ( \Exception $e ) {
			$msg = get_class ( $e ) . ': ' . $e->getMessage ();
			trigger_error ( $msg, E_USER_ERROR );
			return '';
		}
	
	}

	public function render() {

		$formHelper = $this->getView ()->plugin ( 'form' );
		$messageForm = $this->provideForm ();
		$options = $this->getOptions ();
		// $messageForm=$this->getView()->getHelperPluginManager()->getServiceLocator()->get('BaftComment\Form\MessageForm');
		
		if (isset ( $options ['template'] ) && ! empty ( $options ['template'] ))
			return $this->renderTemplate ( $messageForm );
		
		$messageForm->prepare ();
		return $formHelper ( $messageForm );
	
	}

	protected function renderTemplate($messageForm) {

		$options = $this->getOptions ();
		$viewModelVariables = array_merge ( [ 
				'message_form' => $messageForm,
				'comment_id' => $this->getCommentId (),
				'parent_message' => $this->getParentMessage () 
		], $options ['template_variables'] );
		$template = $this->getOptions () ['template'];
		
		$viewModel = new ViewModel ();
		$viewModel->setTerminal ( true );
		$viewModel->setTemplate ( $template );
		$viewModel->setVariables ( $viewModelVariables );
		
		// return $this->getView()->getEngine()->setCanRenderTrees(true)->render($viewModel);
		return $this->getView ()->partial ( $viewModel );
	
	}

	protected function provideForm() {

		$messageForm = new ${! ${""} = "BaftComment\Form\MessageForm"} ();
		$attrs = $this->getOptions () ['form_attributes'];
		
		$messageForm->get ( 'cmnt' )->setValue ( $this->getCommentId () );
		$messageForm->get ( 'prnt_msg' )->setValue ( $this->getParentMessage () );
		$messageForm->setAttribute ( 'ACTION', $this->getView ()->url ( 'baftcomment/leave_message' ) );
		$messageForm->setAttributes ( $attrs );
		return $messageForm;
	
	}

	public function getOptions() {

		return $this->options;
	
	}

	public function setOptions($options) {

		$this->options = array_merge ( $this->options, $options );
		
		return $this;
	
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

	/**
	 *
	 * @return the unknown_type
	 */
	public function getCommentId() {

		return $this->commentId;
	
	}

	/**
	 *
	 * @param unknown_type $commentId        	
	 */
	public function setCommentId($commentId) {

		$this->commentId = $commentId;
		return $this;
	
	}

	/**
	 *
	 * @return the unknown_type
	 */
	public function getParentMessage() {

		return $this->parentMessage;
	
	}

	/**
	 *
	 * @param unknown_type $parentMessage        	
	 */
	public function setParentMessage($parentMessage) {

		$this->parentMessage = $parentMessage;
		return $this;
	
	}


}