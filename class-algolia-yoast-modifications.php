<?php
/*
Plugin Name: Algolia Yoast modifications
Description: Add more data to Algolia indices.
Version: 1.0
Author: Team Yoast
Author URI: https://Yoast.com
Depends: Algolia Search
*/

namespace Yoast\YoastCom\AlgoliaModifications;

include_once 'autoloader.php';

/**
 * Class Alogia_Prepare_data
 *
 * Adds data to the Algolia indices.
 */
class Algolia_Yoast_Modifications {

	function __construct() {
		/** @var Manager[] $managers */
		$managers = [
			new No_Index_Manager(),
			new Blacklist_Manager(),
			new Attribute_Manager(),
			new Priority_Manager(),
			new WP_Search_Manager(),
			new Redirect_Manager(),
		];

		foreach ( $managers as $manager ) {
			$manager->register_hooks();
		}
	}
}

new Algolia_Yoast_Modifications();
