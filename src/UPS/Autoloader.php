<?php

namespace ups;

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
		spl_autoload_register([new self, 'autoload']);
	}

	/**
	 * Autoloader
	 *
	 * @param   string
	 */
	static public function autoload($class) {
		if (strpos($class, 'ups\\') !== 0) return;
		else {
			if (file_exists($file = dirname(__FILE__) . '/' . strtolower(preg_replace('!^ups\\\!', '', $class)) . '.php')) {
				require $file;
			}
		}
	}
}
