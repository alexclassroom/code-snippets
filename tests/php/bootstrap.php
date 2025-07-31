<?php
/**
 * PHPUnit bootstrap file.
 *
 * Sets up the testing environment and loads the Code Snippets plugin.
 *
 * @package    Code_Snippets
 * @subpackage Tests
 */

namespace Code_Snippets\Tests;

require_once dirname( __DIR__, 2 ) . '/src/vendor/autoload.php';
require_once getenv( 'WP_PHPUNIT__DIR' ) . '/includes/functions.php';

tests_add_filter(
	'muplugins_loaded',
	function () {
		require dirname( __DIR__, 2 ) . '/src/code-snippets.php';
	}
);

require getenv( 'WP_PHPUNIT__DIR' ) . '/includes/bootstrap.php';
