# Form Fields object class library

This library provides the ability to create form and element objects programatically using OO.

## Getting Started
See the various [examples](https://github.com/alexwyett/aw-form-fields/blob/master/aw/formfields/examples/textfield.php) for implementation methods

## Installing via composer
1. Create a composer.json where you want to install the project
2. Add the following:

```
{
	"repositories": [
		{
			"type": "vcs",
			"url": "git@github.com:CarltonSoftware/tabs-api-client.git"
		}
	],
	"require": {
		"carltonsoftware/tabs-api-client": "dev-master"	
	}
}
```
3: Download composer and install the repo:

```
curl -sS https://getcomposer.org/installer | php
./composer.phar install
```

For more information about composer, please see the [composer quick start guide](https://getcomposer.org/doc/00-intro.md).


### Notes:

If you are using xedbug and have large collections of child objects, you may need to add this into your php.ini:

`
xdebug.max_nesting_level=200
`

This is because of the amount of recursion necessary to render parent/child objects so the amount of function calls may exceed the default amount.
