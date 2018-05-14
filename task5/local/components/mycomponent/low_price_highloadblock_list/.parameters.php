<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();


$arComponentParameters = array(
	'GROUPS' => array(
	),
	'PARAMETERS' => array(
		'BLOCK_ID' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('HLLIST_COMPONENT_BLOCK_ID_PARAM'),
			'TYPE' => 'TEXT'
		),
		'ROWS_PER_PAGE' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('HLLIST_COMPONENT_ROWS_PER_PAGE_PARAM'),
			'TYPE' => 'TEXT'
		),
		'PAGEN_ID' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('HLLIST_COMPONENT_PAGEN_ID_PARAM'),
			'TYPE' => 'TEXT',
			'DEFAULT' => 'page'
		),
		'FOR_ADMIN' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('HLLIST_COMPONENT_FOR_ADMIN_PARAM'),
			'TYPE' => 'CHECKBOX'
		),
	),
);
