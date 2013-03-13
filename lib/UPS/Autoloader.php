<?php

namespace UPS;

/**
 * Autoloads UPS classes
 *
 * @package ups
 */
class Autoloader {
	/**
	 * Register the autoloader
	 */
	static public function register() {
		spl_autoload_register(array(new self, 'autoload'));
	}

	/**
	 * Autoloader
	 *
	 * @param   string
	 */
	static public function autoload($class) {
		if (0 !== strpos($class, 'UPS\\')) {
			return;
		} else if (file_exists($file = dirname(__FILE__) . '/' . preg_replace('{^UPS\\\}', '', $class) . '.php')) {
			require $file;
		}
	}
}
