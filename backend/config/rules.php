<?php
return [
	'/admin' => [ 
		'controller' => 'DefaultController', 
		'action' => 'dashboard'
	],
	'/admin/login' => [ 
		'controller' => 'DefaultController', 
		'action' => 'login'
	],
	'/admin/logout' => [ 
		'controller' => 'DefaultController', 
		'action' => 'logout'
	],
	
	
	'/admin/categories' => [ 
		'controller' => 'CategoryController', 
		'action' => 'categories'
	],	
	'/admin/category/view' => [ 
		'controller' => 'CategoryController', 
		'action' => 'view'
	],	
	'/admin/category/update' => [ 
		'controller' => 'CategoryController', 
		'action' => 'update'
	],	
	'/admin/category/create' => [ 
		'controller' => 'CategoryController', 
		'action' => 'create'
	],
	
	
	'/admin/goods' => [ 
		'controller' => 'GoodController', 
		'action' => 'goods'
	],	
	'/admin/good/view' => [ 
		'controller' => 'GoodController', 
		'action' => 'view'
	],	
	'/admin/good/update' => [ 
		'controller' => 'GoodController', 
		'action' => 'update'
	],	
	'/admin/good/create' => [ 
		'controller' => 'GoodController', 
		'action' => 'create'
	]	
	
];