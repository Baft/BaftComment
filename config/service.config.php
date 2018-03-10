<?php
return array (
		'invokables' => array (
				'BaftComment\Service\Comment' => 'BaftComment\Service\CommentService' 
		),
		'factories' => array (
				'BaftComment\Event\CommentEvent' => 'BaftComment\Event\CommentEvent',
				'BaftComment\Config' => 'BaftComment\Service\ConfigServiceFactory',
				'BaftComment\Model\Comment' => function ($sm) {
					$em = $sm->get ( 'Doctrine\ORM\EntityManager' );
					
					// 1 ############## OR
					// $repository = (new DefaultRepositoryFactory())->getRepository($em, 'BaftComment\Entity\BaftcommentMessage');
					
					// 2 ############## OR
					$repository = $em->getRepository ( '\BaftComment\Entity\BaftcommentComment' );
					
					// 3 ##############
					// $metaClass = $em->getClassMetadata('baftFeedback\Entity\BaftfeedbackFeedback');
					// $repository = new baftFeedback\Model\feedbackRepository($em,$metaClass);
					
					return $repository;
				},
				
				'BaftComment\Model\Message' => function ($sm) {
					$em = $sm->get ( 'Doctrine\ORM\EntityManager' );
					$repository = $em->getRepository ( '\BaftComment\Entity\BaftcommentMessage' );
					return $repository;
				} 
		) 
);