<?php

Validator::extend('alphanumeric_spaces', function($attribute, $value)
{
	return preg_match('/^[a-zñÑÁÉÍÓÚáéíóú\d\-_\s]+$/i', $value);
});

Validator::extend('alpha_spaces', function($attribute, $value)
{
    return preg_match('/^[a-zñÑÁÉÍÓÚáéíóú\s]+$/i', $value);
});

Validator::extend('alphanumeric_spaces_dots', function($attribute, $value)
{
	return preg_match('/^[a-zñÑÁÉÍÓÚáéíóú\d\-\s\.]+$/i', $value);
});

Validator::extend('allow_all', function($attribute, $value)
{
	return preg_match('/.*/i', $value);
});

Validator::extend('alphanumeric_script', function($attribute, $value)
{
	return preg_match('/^[a-z\d\-\s\.]+$/i', $value);
});
?>
