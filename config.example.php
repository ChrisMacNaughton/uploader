<?php
/*
* Database settings
* Database is used to store information about uploaded files
*/
$database_host = "";//your database host
$database_name = "";//your database name
$dsn = 'mysql:dbname=$database_name;host=$database_host';
$user = '';//database user
$dbpass = '';//database password

$options = array('certificate_authority'=>true,
                'default_cache_config' => '',
                );
/*
* AWS auth information
* RECOMMENDED: create a user in IAM just fort his app (like any other)
*/
$options['key'] = 'YOUR_AWS_KEY';
$options['secret'] = 'YOUR_AWS_SECRET';

define('MB', 1024 * 1024);

$bucket = '';//bucket name for uploads

/*
* Salt and pepper for user's passwords when creating key
*/
$pass1="pass1";
$pass2="pass2";