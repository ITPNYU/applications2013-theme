<?php
/**
 * Template Name: Comment Count
 * The template for displaying comment count for all users.
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
<p>This is a word count of each student's written contribution to the class blog.</p>
<ul>
  <?php 

// The Query
$user_query = new WP_User_Query(array('orderby' => 'display_name'));

// User Loop
if ( ! empty( $user_query->results ) ) {
  foreach ( $user_query->results as $user ) {
    echo '<li><a href="' . $user->url . '">' . $user->display_name . '</a></li>';
  }
} else {
  echo 'No users found.';
}
  ?>
</ul>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
