<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter 3
 * @subpackage Template Engine
 * @category Library
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

require ('vendor/autoload.php');

class Template_engine extends CI_Driver_Library
{
	public $adapter;

	public $view_paths;

	public $cache_path;

	public $valid_drivers = array('twig');

	/**
	 * constructor
	 */
	public function __construct($config = array())
	{
		get_instance()->load->helper('url');

		$this->adapter = 'twig'; // default adapter

		$this->view_paths = array(APPPATH.'views' => APPPATH.'views'); // default view paths

		$this->cache_path = (!empty(config_item('cache_path')))?config_item('cache_path'):APPPATH.'cache'; // default cache path

		$this->initialize($config);
	}

	/**
	 * load child class
	 * 
	 * @param  string $child
	 * @return \Template_engine
	 */
	public function __get($child)
	{
		if (in_array($child, $this->valid_drivers))
		{
			return $this->load_driver($child);
		}
	}

	/**
	 * Initialize
	 * 
	 * @param  array  $params
	 * @return Template_engine
	 */
	public function initialize(array $params = array())
	{
		foreach ($params as $key => $value)
		{
			if (isset($this->$key))
			{
				$method = 'set_'.$key;

				if (method_exists($this, $method))
				{
					$this->$method($value);
				}
				else
				{
					$this->$key = $value;
				}
			}
		}

		return $this;
	}

	/**
	 * Reset driver
	 * 
	 * @return Template_engine
	 */
	public function clear()
	{
		$this->adapter = ''; // clear adapter

		$this->view_paths = array(APPPATH.'views' => APPPATH.'views'); // default view paths

		$this->cache_path = APPPATH.'cache';

		return $this;
	}

	/**
	 * Set adapter
	 * 
	 * @param string $adapter
	 */
	public function set_adapter($adapter)
	{
		if (in_array($adapter, $this->valid_drivers))
		{
			$this->adapter = $adapter;
		}

		return $this;
	}

	/**
	 * Get adapter
	 * 
	 * @return object
	 */
	public function get_adapter()
	{
		return $this->{$this->adapter};
	}

	/**
	 * Get engine
	 * 
	 * @return object
	 */
	public function get_engine()
	{
		return $this->{$this->adapter}->get_engine();
	}

	/**
	 * Set view paths
	 * 
	 * @param array $view_paths
	 */
	public function set_view_paths(array $view_paths)
	{
		$this->view_paths = $view_paths;

		return $this;
	}

	/**
	 * Add view paths
	 * 
	 * @param array $view_paths
	 */
	public function add_view_paths(array $view_paths)
	{
		array_merge($this->view_paths, $view_paths);

		return $this;
	}

	/**
	 * Set cache path
	 * 
	 * @param string $cache_path
	 */
	public function set_cache_path(string $cache_path)
	{
		$this->cache_path = $cache_path;

		return $this;
	}

	/**
	 * Render template
	 * 
	 * @param  string  $page   page name
	 * @param  array   $data   an associative array of variables
	 * @return mixed
	 */
	public function render($page, $data = array())
	{
		$this->{$this->adapter}->render($page, $data);
	}
}

/* End of file Template_engine.php */
/* Location : ./application/libraries/Template_engine/Template_engine.php */