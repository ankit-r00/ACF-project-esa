<?php

$cookie_value = date('F j, Y g:i a');
if ( !$_COOKIE['popup'] ) {
	setcookie('popup', $cookie_value, time()+86400, '/', 'esaweb.org');
}
