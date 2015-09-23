<?php
/*
Plugin Name: Category Checkbox List Tree
Plugin URI: http://www.thiendo.com/wordpress-category-checkbox-list-tree
Description: Category checkbox list tree indents when editing a Post
Version: 1.0
Author: Thien Do
Author URI: http://www.thiendo.com/
Requires at least: 2.7
Tested up to: 3.4
Tags: wordpress category, indent category, category list, category list tree, category, product category
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

class Category_Tree {

	function init() {
		add_filter( 'wp_terms_checklist_args', array( __CLASS__, 'checklist_args' ) );
	}

	function checklist_args( $args ) {
		add_action( 'admin_footer', array( __CLASS__, 'script' ) );

		$args['checked_ontop'] = false;

		return $args;
	}

	// Scrolls to first checked category
	function script() {
?>
        <script type="text/javascript">
            jQuery(function(){
                jQuery('[id$="-all"] > ul.categorychecklist').each(function() {
                    var $list = jQuery(this);
                    var $firstChecked = $list.find(':checkbox:checked').first();

                    if ( !$firstChecked.length )
                        return;

                    var pos_first = $list.find(':checkbox').position().top;
                    var pos_checked = $firstChecked.position().top;

                    $list.closest('.tabs-panel').scrollTop(pos_checked - pos_first + 5);
                });
            });
        </script>
<?php
    }
}

Category_Tree::init();