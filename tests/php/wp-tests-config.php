<?php
/**
 * WordPress Unit Test Configuration File
 *
 * @package    Code_Snippets
 * @subpackage Tests
 */

/* Path to the WordPress codebase you'd like to test. Add a forward slash in the end. */
define( 'ABSPATH', dirname( __DIR__, 2 ) . '/src/' );

/*
 * Path to the theme to test with.
 *
 * The 'default' theme is symlinked from test/phpunit/data/themedir1/default into
 * the themes directory of the WordPress installation defined above.
 */
const WP_DEFAULT_THEME = 'default';

/*
 * Test with multisite enabled.
 * Alternatively, use the tests/phpunit/multisite.xml configuration file.
 */
const WP_TESTS_MULTISITE = true;

// Test with WordPress debug mode (default).
const WP_DEBUG = true;

// ** MySQL settings ** //

/*
 * This configuration file will be used by the copy of WordPress being tested.
 * wordpress/wp-config.php will be ignored.
 *
 * WARNING WARNING WARNING!
 * These tests will DROP ALL TABLES in the database with the prefix named below.
 * DO NOT use a production database or one that is shared with something else.
 */

define( 'DB_NAME', getenv( 'WP_DB_NAME' ) ?? 'wp_phpunit_tests' );
define( 'DB_USER', getenv( 'WP_DB_USER' ) ?? 'root' );
define( 'DB_PASSWORD', getenv( 'WP_DB_PASS' ) ?? '' );
const DB_HOST = 'localhost';
const DB_CHARSET = 'utf8';
const DB_COLLATE = '';

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 */
const AUTH_KEY = 'put your unique phrase here';
const SECURE_AUTH_KEY = 'put your unique phrase here';
const LOGGED_IN_KEY = 'put your unique phrase here';
const NONCE_KEY = 'put your unique phrase here';
const AUTH_SALT = 'put your unique phrase here';
const SECURE_AUTH_SALT = 'put your unique phrase here';
const LOGGED_IN_SALT = 'put your unique phrase here';
const NONCE_SALT = 'put your unique phrase here';

/* @phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited */
$table_prefix = 'wp_tests_';

const WP_TESTS_DOMAIN = 'example.org';
const WP_TESTS_EMAIL = 'admin@example.org';
const WP_TESTS_TITLE = 'Test Blog';

const WP_PHP_BINARY = 'php';

const WPLANG = '';
