<?php

namespace Code_Snippets\Tests;

use Code_Snippets\Snippet;
use WP_UnitTestCase;

/**
 * Base class for unit tests in the Code Snippets plugin.
 */
abstract class Test_Case extends WP_UnitTestCase {
	/**
	 * Asserts that the given value is an instance of Snippet.
	 *
	 * @param mixed  $actual  The value to check.
	 * @param string $message Optional. Message to display when the assertion fails.
	 */
	public function assertSnippet( $actual, string $message = '' ) {
		$this->assertInstanceOf( Snippet::class, $actual, $message );
	}
}
