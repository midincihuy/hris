<?php


return [

	'user-management' =>
[
		'title' => 'User Management',
		'created_at' => 'Time',
		'fields' => [
		],
	],

'permissions' =>
[
		'title' => 'Permissions',
		'created_at' => 'Time',
		'fields' => [
			'name' => 'Name',
		],
	],

'roles' => [
		'title' => 'Roles',
		'created_at' => 'Time',
		'fields' => [
			'name' => 'Name',
			'permission' => 'Permissions',
		],
	],

'users' => [
		'title' => 'Users',
		'created_at' => 'Time',
		'fields' => [
			'name' => 'Name',
			'email' => 'Email',
			'password' => 'Password',
			'roles' => 'Roles',
			'remember-token' => 'Remember token',
		],
	],
'app_create' => 'Create',
'app_save' => 'Save',
'app_edit' => 'Edit',
'app_view' => 'View',
'app_update' => 'Update',
'app_list' => 'List',
'app_no_entries_in_table' => 'No entries in table',
'custom_controller_index' => 'Custom controller index.',
'app_logout' => 'Logout',
'app_add_new' => 'Add new',
'app_are_you_sure' => 'Are you sure?',
'app_back_to_list' => 'Back to list',
'app_dashboard' => 'Dashboard',
'app_delete' => 'Delete',
'global_title' => 'Roles-Permissions Manager',

'contracts' =>
[
	'title' => 'Contracts',
	'created_at' => 'Time',
	'fields' => [
		'name' => 'Name',
	],
],
'employee' =>
[
	'title' => 'Employee',
	'created_at' => 'Time',
	'fields' => [
		'name' => 'Name',
	],
],

'applicants' =>
[
	'title' => 'Applicants',
	'created_at' => 'Time',
	'fields' => [
		'name' => 'Name',
	],
],

'recruitments' =>
[
	'title' => 'Recruitments',
	'created_at' => 'Time',
	'fields' => [
		'name' => 'Name',
	],
],
'schedulers' =>
[
	'title' => 'Schedulers',
	'created_at' => 'Time',
	'fields' => [
		'name' => 'Name',
	],
],
'references' =>
[
	'title' => 'References',
	'created_at' => 'Time',
	'fields' => [
		'name' => 'Name',
	],
],

'draft_contracts' =>
[
	'title' => 'Draft Contracts',
	'created_at' => 'Time',
	'fields' => [
		'name' => 'Name',
	],
],

];
