<?php
/**
 * BP Follow Display Top User Widgets
 *
 * @package BP-Follow
 * @subpackage Widgets
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Add a "Most followed user" widget for the logged-in user
 *
 * @subpackage Widgets
 */
class BP_Top_Follower_Widget extends WP_Widget {
	function bp_top_follower_widget() {
		parent::WP_Widget( false, $name = __( "Most Followed User", 'bp-follow' ) );
	}

	function widget( $args, $instance ) {

		extract( $args );
		if( !$q = BP_Follow::get_top_user() ) {
			return false;
		}
		
		if( !empty( $q ) == true ) {

			do_action( 'bp_before_following_widget' );

			echo $before_widget;
			echo $before_title
			   . __( 'Most followed user', 'bp-follow' )
			   . $after_title; ?>

			<div class="avatar-block">
				<?php foreach( $q as $k ): ?>
					<?php foreach( $k as $top_user ): ?>
						<div class="item-avatar">
							<a href="<?php echo get_bloginfo('url') . '/members/' . $top_user->user_nicename . '/profile'; ?>">
								<?php echo get_avatar( $top_user->leader_id, 50 ); ?>
							</a>
						</div>
					<?php endforeach; ?>
				<?php endforeach; ?>
			</div>

			<?php echo $after_widget; ?>

			<?php do_action( 'bp_after_following_widget' ); ?>
	
	<?php }
	}

}
add_action( 'widgets_init', create_function( '', 'return register_widget("BP_Top_Follower_Widget");' ) );

?>