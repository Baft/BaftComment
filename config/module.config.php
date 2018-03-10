<?php
return array (
		'view_helpers' => array (
				'invokables' => array (
						'baftListComment' => 'BaftComment\View\Helper\ListCommentHelper' 
				),
				'factories' => array (
						'baftPostComment' => 'BaftComment\Service\PostCommentHelperFactory' 
				) 
		),
		'view_manager' => array (
				'template_path_stack' => array (
						'BaftComment' => __DIR__ . '/../view' 
				) 
		),
		'view_helper_config' => array (
				'baftComment' => array (
						'form_attribtutes' => [ 
								'method' => 'post' 
						],
						'template' => 'baft-comment/index/leave-message.phtml' 
				) 
		),
		
		'router' => array (
				'routes' => array (
						"baftcomment" => array (
								'type' => 'Literal',
								'options' => array (
										'route' => '/comment',
										'defaults' => array (
												'__NAMESPACE__' => 'BaftComment',
												'controller' => 'index',
												'action' => 'index' 
										) 
								),
								'may_terminate' => true,
								'child_routes' => array (
										
										'create' => array (
												'type' => 'Literal',
												'options' => array (
														'route' => '/create',
														'defaults' => array (
																'action' => 'create' 
														) 
												) 
										),
										
										'edit_message' => array (
												'type' => 'Literal',
												'options' => array (
														'route' => '/editMessage',
														'defaults' => array (
																'action' => 'editMessage' 
														) 
												) 
										),
										
										'remove_message' => array (
												'type' => 'Literal',
												'options' => array (
														'route' => '/removeMessage',
														'defaults' => array (
																'action' => 'removeMessage' 
														) 
												) 
										),
										
										'list_message' => array (
												'type' => 'Literal',
												'options' => array (
														'route' => '/listMessage',
														'defaults' => array (
																'action' => 'listMessage' 
														) 
												) 
										),
										
										'score_message' => array (
												'type' => 'Segment',
												'options' => array (
														'route' => '/scoreMessage/:message/:opinion',
														'constrains' => [ 
																'message' => '[0-9]+',
																'opinion' => 'plus|minus' 
														],
														'defaults' => array (
																'action' => 'scoreMessage' 
														) 
												) 
										),
										
										'leave_message' => array (
												'type' => 'Literal',
												'options' => array (
														'route' => '/message',
														'defaults' => array (
																'action' => 'leaveMessage' 
														) 
												) 
										) 
								) 
						) 
				)
				 
		),
		
		'controllers' => array (
				'invokables' => array (
						'BaftComment\Index' => 'BaftComment\Controller\IndexController' 
				) 
		),
		
		'doctrine' => array (
				'driver' => array (
						'orm_default' => array (
								'drivers' => array (
										'BaftComment\Entity' => 'baftComment_annotation' 
								) 
						),
						
						'baftComment_annotation' => array (
								'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
								'cache' => 'array',
								'paths' => array (
										APP_ROOT . DS . 'BaftComment' . DS . 'src' . DS . 'BaftComment' . DS . 'Entity' 
								) 
						) 
				) 
		),
		
		'baftcomment' => [ ] 
);
