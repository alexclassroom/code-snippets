<?php
namespace Code_Snippets\Tests;

use WP_REST_Request;
use WP_UnitTestCase;

/**
 * REST API tests for the snippets controller.
 */
class Test_REST_Snippets_Controller extends WP_UnitTestCase {

	protected static $admin_id;

	public static function wpSetUpBeforeClass( $factory ) {
		self::$admin_id = $factory->user->create( [ 'role' => 'administrator' ] );
	}

	/**
	 * Sets up the fixture.
	 *
	 * This method is called before each test.
	 *
	 * @return void
	 */
	public function setUp(): void {
		parent::setUp();
		wp_set_current_user( self::$admin_id );
	}

	public function test_get_items() {
		$request = new WP_REST_Request( 'GET', '/code-snippets/v1/snippets' );
		$response = rest_get_server()->dispatch( $request );
		$this->assertEquals( 200, $response->get_status() );
	}

	public function test_create_and_get_item() {
		$data = [
			'title' => 'REST Test Snippet',
			'code'  => '<?php echo "Hello";',
			'scope' => 'global',
			'tags'  => [],
		];
		$request = new WP_REST_Request( 'POST', '/code-snippets/v1/snippets' );
		$request->set_body_params( $data );
		$response = rest_get_server()->dispatch( $request );
		$this->assertEquals( 200, $response->get_status() );
		$item = $response->get_data();
		$this->assertEquals( $data['title'], $item['title'] );

		// Get the item
		$get_request = new WP_REST_Request( 'GET', '/code-snippets/v1/snippets/' . $item['id'] );
		$get_response = rest_get_server()->dispatch( $get_request );
		$this->assertEquals( 200, $get_response->get_status() );
		$this->assertEquals( $data['title'], $get_response->get_data()['title'] );
	}

	public function test_update_item() {
		// Create first
		$data = [
			'title' => 'To Update',
			'code'  => '<?php echo "Update";',
			'scope' => 'global',
			'tags'  => [],
		];
		$request = new WP_REST_Request( 'POST', '/code-snippets/v1/snippets' );
		$request->set_body_params( $data );
		$response = rest_get_server()->dispatch( $request );
		$item = $response->get_data();

		// Update
		$update = new WP_REST_Request( 'PUT', '/code-snippets/v1/snippets/' . $item['id'] );
		$update->set_body_params( [ 'title' => 'Updated Title' ] );
		$update_response = rest_get_server()->dispatch( $update );
		$this->assertEquals( 200, $update_response->get_status() );
		$this->assertEquals( 'Updated Title', $update_response->get_data()['title'] );
	}

	public function test_delete_item() {
		// Create first
		$data = [
			'title' => 'To Delete',
			'code'  => '<?php echo "Delete";',
			'scope' => 'global',
			'tags'  => [],
		];
		$request = new WP_REST_Request( 'POST', '/code-snippets/v1/snippets' );
		$request->set_body_params( $data );
		$response = rest_get_server()->dispatch( $request );
		$item = $response->get_data();

		// Delete
		$delete = new WP_REST_Request( 'DELETE', '/code-snippets/v1/snippets/' . $item['id'] );
		$delete_response = rest_get_server()->dispatch( $delete );
		$this->assertEquals( 204, $delete_response->get_status() );
	}

	public function test_activate_and_deactivate_item() {
		// Create first
		$data = [
			'title' => 'To Activate',
			'code'  => '<?php echo "Active";',
			'scope' => 'global',
			'tags'  => [],
		];
		$request = new WP_REST_Request( 'POST', '/code-snippets/v1/snippets' );
		$request->set_body_params( $data );
		$response = rest_get_server()->dispatch( $request );
		$item = $response->get_data();

		// Activate
		$activate = new WP_REST_Request( 'POST', '/code-snippets/v1/snippets/' . $item['id'] . '/activate' );
		$activate_response = rest_get_server()->dispatch( $activate );
		$this->assertEquals( 200, $activate_response->get_status() );

		// Deactivate
		$deactivate = new WP_REST_Request( 'POST', '/code-snippets/v1/snippets/' . $item['id'] . '/deactivate' );
		$deactivate_response = rest_get_server()->dispatch( $deactivate );
		$this->assertEquals( 200, $deactivate_response->get_status() );
	}
}
