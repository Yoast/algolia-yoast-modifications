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

	private $no_index_manager;
	private $attribute_manager;
	private $priority_manager;
	private $blacklist_Manager;

	function __construct() {
		$this->init_no_index_blacklist();
		$this->init_attribute_manager();
		$this->init_priority_manager();
		$this->init_post_type_blacklist();
	}

	private function init_no_index_blacklist() {
		$this->no_index_manager = new No_Index_Manager();
		$this->no_index_manager->register_hooks();
	}

	private function init_post_type_blacklist() {
		$this->blacklist_Manager = new Blacklist_Manager();
		$this->blacklist_Manager->register_hooks();
	}

	private function init_attribute_manager() {
		$this->attribute_manager = new Attribute_Manager();
		$this->attribute_manager->register_hooks();
	}

	private function init_priority_manager() {
		$this->priority_manager = new Priority_Manager();
		$this->priority_manager->register_hooks();
	}
}

new Algolia_Yoast_Modifications();
