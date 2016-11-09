<?php

namespace Yoast\YoastCom\AlgoliaModifications;

class Blacklist_Manager {

	public function register_hooks() {
		add_filter( 'algolia_post_types_blacklist', array( $this, 'blacklist_internal_kb_posts' ) );
	}

	public function blacklist_internal_kb_posts( $blacklist ) {
		$blacklist[] = 'internal-kb';

		return $blacklist;
	}

}
