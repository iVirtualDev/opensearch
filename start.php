<?php
/**
 * OpenSearch plugin
 *
 * http://www.opensearch.org/Home
 *
 * @author Cash Costello
 * @license http://opensource.org/licenses/gpl-2.0.php GPL 2
 */

register_elgg_event_handler('init', 'system', 'opensearch_init');

function opensearch_init() {
	global $CONFIG;

	register_page_handler('opensearch', 'opensearch_handler');

	elgg_extend_view('metatags', 'opensearch/includes');
}

/**
 * Handles OpenSearch requests
 *
 * @param array $page An array of URL elements
 * @return boolean
 */
function opensearch_handler($page) {
	global $CONFIG;

	// file path to the page scripts
	$base_path = $CONFIG->pluginspath . 'opensearch';

	if (!isset($page[0])) {
		require "$base_path/search.php";
		return TRUE;
	}

	// select page based on first URL element after /pg/hello/
	switch ($page[0]) {
		case 'osd.xml':
			elgg_set_viewtype('xml');
			page_draw('', elgg_view('opensearch/description'));
			return TRUE;
			break;
	}

}