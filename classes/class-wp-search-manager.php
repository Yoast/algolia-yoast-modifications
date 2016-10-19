<?php

namespace Yoast\YoastCom\AlgoliaModifications;

class WP_Search_Manager {

	public function register_hooks() {
		if ( ! is_admin() ) {
			add_filter( 'posts_pre_query', array( $this, 'disable_wp_search_query' ), 10, 2 );
		}
	}

	public function disable_wp_search_query( $posts, \WP_Query $wp_query ) {
		if ( $wp_query->is_search() ) {
			return array();
		}

		return $posts;
	}

}
