<?php

namespace Yoast\YoastCom\AlgoliaModifications;

class Redirect_Manager {

	public function register_hooks() {
		add_filter( 'algolia_should_index_searchable_post', array( $this, 'blacklist_redirected_posts' ), 10, 2 );
	}

	public function blacklist_redirected_posts( $should_index, \WP_Post $post ) {
		$redirect_manager = new \WPSEO_Redirect_Manager();
		if ( $redirect_manager->get_redirect( get_permalink( $post ) ) !== false ) {
			return false;
		}

		return $should_index;
	}
}
