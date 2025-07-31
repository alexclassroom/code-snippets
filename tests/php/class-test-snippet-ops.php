<?php

namespace Code_Snippets\Tests;

use Code_Snippets\Snippet;
use WP_UnitTestCase;
use function Code_Snippets\activate_snippet;
use function Code_Snippets\deactivate_snippet;
use function Code_Snippets\delete_snippet;
use function Code_Snippets\get_snippet;
use function Code_Snippets\get_snippets;
use function Code_Snippets\save_snippet;

/**
 * PHPUnit tests for snippet operations.
 */
class Test_Snippet_Ops extends Test_Case {

	/**
	 * Test creating and retrieving a snippet.
	 *
	 * @return void
	 */
	public function test_save_and_get_snippet() {
		$data = [
			'name'   => 'Test Snippet',
			'desc'   => 'A test snippet',
			'code'   => '<?php echo "Hello";',
			'tags'   => [ 'test' ],
			'scope'  => 'global',
			'active' => 0,
		];

		$snippet = save_snippet( $data );
		$this->assertInstanceOf( Snippet::class, $snippet );
		$this->assertEquals( 'Test Snippet', $snippet->name );

		$fetched = get_snippet( $snippet->id );
		$this->assertSnippet( $fetched );
		$this->assertEquals( $snippet->id, $fetched->id );
	}

	/**
	 * Test retrieving a list of snippets.
	 *
	 * @return void
	 */
	public function test_get_snippets_returns_array() {
		$snippets = get_snippets();
		$this->assertIsArray( $snippets );
		if ( $snippets ) {
			$this->assertSnippet( $snippets[0] );
		}
	}

	/**
	 * Test activating and deactivating a snippet.
	 *
	 * @return void
	 */
	public function test_activate_and_deactivate_snippet() {
		$data = [
			'name'   => 'Active Snippet',
			'desc'   => 'To activate',
			'code'   => '<?php echo "Active";',
			'tags'   => [ 'active' ],
			'scope'  => 'global',
			'active' => 0,
			'type'   => 'php',
		];
		$snippet = save_snippet( $data );
		$activated = activate_snippet( $snippet->id );

		$this->assertInstanceOf( Snippet::class, $activated );
		$this->assertEquals( 1, $activated->active );

		$deactivated = deactivate_snippet( $snippet->id );
		$this->assertInstanceOf( Snippet::class, $deactivated );
		$this->assertEquals( 0, $deactivated->active );
	}

	/**
	 * Test deleting a snippet.
	 *
	 * @return void
	 */
	public function test_delete_snippet() {
		$data = new Snippet();
		$snippet = save_snippet( $data );

		$deleted = delete_snippet( $snippet->id );
		$this->assertTrue( $deleted );

		$fetched = get_snippet( $snippet->id );
		$this->assertEquals( 0, $fetched->id );
	}
}
