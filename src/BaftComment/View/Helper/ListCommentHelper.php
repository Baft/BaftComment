<?php

namespace BaftComment\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Model\ViewModel;

class ListCommentHelper extends AbstractHelper implements ServiceLocatorAwareInterface {
	
	/**
	 *
	 * @var ServiceLocatorInterface
	 */
	protected $serviceLocator;
	private $commentId;
	private $options = [
			// options for pagination
			'pagination_options' => [ ],
			'wrapper_template' => "<div>%s</div>",
			'comment_template' => 'baft-comment/partial/view-comment.phtml' 
	];

	public function __invoke($commentId) {

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

		$wrapperTemplate = $this->getOptions () ['wrapper_template'];
		$template = $this->getOptions () ['comment_template'];
		$messages = $this->getView ()
			->getHelperPluginManager ()
			->getServiceLocator ()
			->get ( 'BaftComment\Service\Comment' )
			->readMessages ( $this->getCommentId (), $this->getOptions () ['pagination_options'] );
		
		$content = '';
		if (! empty ( $template ))
			$content .= $this->renderTemplate ( $messages );
		else
			// we need to have default/replacement render
			foreach ( $messages as $message ) {
				$content .= '<pre>' . $message->getContent () . '</pre>';
			}
		
		return sprintf ( $wrapperTemplate, $content );
	
	}

	protected function renderTemplate($messages) {

		$template = $this->getOptions () ['comment_template'];
		
		// return $this->getView()->getEngine()->setCanRenderTrees(true)->render($viewModel);
		return $this->getView ()->partialLoop ( $template, $messages );
	
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
	 */
	public function getServiceLocator() {

		return $this->serviceLocator;
	
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
	 */
	public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {

		$this->serviceLocator = $serviceLocator;
		return $this;
	
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
	public function getOptions() {

		return $this->options;
	
	}

	/**
	 *
	 * @param unknown_type $options        	
	 */
	public function setOptions($options) {

		$this->options = $options;
		return $this;
	
	}


}