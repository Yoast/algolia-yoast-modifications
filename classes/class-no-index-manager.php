<?php

namespace Yoast\YoastCom\AlgoliaModifications;

class No_Index_Manager {

	public function register_hooks() {
		add_filter( 'algolia_should_index_searchable_post', array( $this, 'blacklist_no_index_posts'), 10, 2 );
	}

	public function blacklist_no_index_posts( $should_index, \WP_Post $post ) {
		if ( get_post_meta( $post->ID, '_yoast_wpseo_meta-robots-noindex', true ) == 1 ) {
			return false;
		}

		return $should_index;
	}

}
