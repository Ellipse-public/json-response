<?php

require_once __DIR__."/vendor/autoload.php";

Use EllipseOnline\ResponseClass\jsonResponse;

$student = array(
	'name' => 'John Doe',
	'course' => 'Software Engineering',
	'level' => '200',
	'collections' => ['books' => 'Intro to UML', 'music' => 'rap']
);

new jsonResponse('unauthorized','',$student)

?>