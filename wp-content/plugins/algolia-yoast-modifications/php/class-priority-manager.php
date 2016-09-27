<?php

namespace Yoast\YoastCom\AlgoliaModifications;

class Priority_Manager {

	const DEFAULT_SEARCH_RESULT_PRIORITY = 3;

	public function register_hooks() {
		add_action( 'cmb2_admin_init', array( $this, 'add_result_prio_metabox' ) );
		add_filter( 'algolia_searchable_post_shared_attributes', array( $this, 'add_search_prio_to_post' ), 10, 2 );
	}


	/**
	 * Adds the search result priority to Algolia's index.
	 *
	 * @param array    $shared_attributes The attributes Algolia should index.
	 * @param \WP_Post $post              The post object that is being indexed
	 *
	 * @return mixed
	 */
	public function add_search_prio_to_post( array $shared_attributes, \WP_Post $post ) {
		$priority_meta                 = get_post_meta( $post->ID, '_algolia-result-priority', true );
		$priority_str                  = ( ! empty( $priority_meta ) ) ? $priority_meta : self::DEFAULT_SEARCH_RESULT_PRIORITY;
		$shared_attributes['priority'] = intval( $priority_str );

		return $shared_attributes;
	}

	/**
	 * Adds a metabox to all post_types which are indexed by Algolia in which the user can set the post's priority in the search results.
	 */
	public function add_result_prio_metabox() {
		$cmb = new_cmb2_box( array(
			'id'           => 'algolia-search-results',
			'title'        => __( 'Search results', 'yoastcom' ),
			'object_types' => $this->get_indexed_post_types(),
			'context'      => 'normal',
			'priority'     => 'default',
			'show_names'   => true, // Show field names on the left
		) );

		$cmb->add_field( array(
			'name'             => 'Result priority',
			'desc'             => __( 'Should this post be more likely to end up higher in the search results on kb.yoast.com', 'yoastcom' ),
			'id'               => '_algolia-result-priority',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => self::DEFAULT_SEARCH_RESULT_PRIORITY,
			'options'          => array(
				5 => __( 'Highest', 'yoastcom' ),
				4 => __( 'High', 'yoastcom' ),
				3 => __( 'Normal', 'yoastcom' ),
				2 => __( 'Low', 'yoastcom' ),
				1 => __( 'Lowest', 'yoastcom' ),
			)
		) );
	}

	/**
	 * Gets all by Algolia indexed post_types.
	 *
	 * @return array An array of strings containing the names of the post_types that Algolia has indexed.
	 */
	private function get_indexed_post_types() {
		return get_post_types( array( 'exclude_from_search' => false ), 'names' );
	}

}
