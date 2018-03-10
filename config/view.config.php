<?php
return [ 
		
		'view_helpers' => array (
				'factories' => array (
						'baftComment' => 'BaftComment\View\Helper\CommentHelperFactory' 
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
						'message_close_string' => '</span></div></div>',
						'message_separator_string' => '</span></div><div %s ><button type="button" class="close small-margin-top" data-dismiss="alert" aria-hidden="true" ></button><i class="fa-lg fa fa-warning small-padding-left"></i><span>' 
				) 
		) 
]
;