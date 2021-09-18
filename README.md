<h1 align="center">Codeigniter 3 Template Engine</h1>

[![GitHub license](https://img.shields.io/github/license/agoenks29D/Codeigniter-3-Template-Engine?label=License&style=plastic)](https://github.com/agoenks29D/Codeigniter-3-Template-Engine/blob/main/LICENSE) [![GitHub issues](https://img.shields.io/github/issues/agoenks29D/Codeigniter-3-Template-Engine?style=plastic)](https://github.com/agoenks29D/Codeigniter-3-Template-Engine/issues)

![Travis (.org) branch](https://img.shields.io/travis/twigphp/Twig/2.x?label=Twig%20Build&style=plastic)

**Drivers** : 

- [Twig](https://twig.symfony.com)

## Table of Content : 

- Installation

	- source

		- [Zip file](#Zip-file)
		- [Github clone](#github-clone)

	- [Configuration](#configuration)

- [Examples](#examples)

	- [Load Driver](#load-driver)

	- [Load driver with config parameters](#load-driver-with-config-parameters)

	- [Set adapter name](#set-adapter-name)

	- [Custom cache path](#custom-cache-path)

	- [Custom view paths](#custom-view-paths)

	- [Full Example](#full-example)

## Installation

### Zip file

### Github clone

**Enter path of codeigniter libraries**

```bash
cd application/libraries/
```

**Clone with `Template_engine` directory name**

```bash
git clone https://github.com/agoenks29D/Codeigniter-3-Template-Engine.git "Template_engine"
```

**Enter to `Template_engine/` directory**

```bash
cd Template_engine/
```

**Install dependencies**

```bash
composer install
```

## Configuration

**Create new config file with name `template_engine_twig.php` and save code below**

```php
<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage Template Engine Twig
 * @category Config
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

$config['twig.extension'] 	= '.twig';
$config['twig.functions']	= array_merge(get_defined_functions()['internal'],get_defined_functions()['user']);
$config['twig.filters']		= get_defined_functions()['user'];
$config['twig.environment'] = array(
	'cache_status'      => FALSE,
	'auto_reload'       => NULL,
	'debug_mode'        => FALSE,
	'autoescape'        => FALSE,
	'optimizations'     => -1
);
/* End of file template_engine_twig.php */
/* Location : ./application/config/template_engine_twig.php */
```

## Examples

### Load driver

```php
$this->load->driver('template_engine');
```

### Load driver with config parameters

```php
$this->load->driver('template_engine', array(
	'cache_path' => APPPATH.'my-custom-cache-path',
	'view_paths' => array(
		APPPATH.'views' => APPPATH.'views' // initialize view paths
	),
	'adapter' => 'twig' // initialize adapter
)); // load driver
```

### Set adapter name

```php
$this->template_engine->set_adapter('twig'); // set twig adapter
```

### Custom cache path

```php
$this->template_engine->set_cache_path(APPPATH.'my-custom-cache-path'); // set custom cache path
```

### Custom view paths

```php
$this->template_engine->set_view_paths(array(
	APPPATH.'my-custom-view-path' => APPPATH.'my-custom-view-path' // set custom view path
));
```

### Full Example

> Controller

`application/controllers/Welcome.php`

```php
class Welcome extends CI_Controller
{
	/**
	* constructor
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->driver('template_engine', array(
			'cache_path' => APPPATH.'cache',
			'view_paths' => array(
				APPPATH.'views' => APPPATH.'views' // initialize view paths
			),
			'adapter' => 'twig' // initialize adapter
		)); // load driver
	}

	public function index()
	{
		$data['my_page_title'] = 'My Page Title';
		$this->template_engine->render('welcome_message', $data);
	}
}
```

> Views

`application/views/base.twig`

```twig
<!DOCTYPE html>
<html>
<head>
	<title>{% block title %}{% endblock %}</title>
</head>
<body>

{% block body %}
<!-- Content will be here -->
{% endblock %}

</body>
</html>
```

`application/views/welcome_message.twig`

```twig
{% extends 'base.twig' %}

{% block title %}
	{{ my_page_title }}
{% endblock %}

{% block body %}
	<h1>Here body block</h1>
{% endblock %}
```

<p align="center"><b>Made with ❤️ + ☕ ~ Agung Dirgantara</b></p>