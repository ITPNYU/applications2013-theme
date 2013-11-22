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
    // find all posts owned by this user
    $posts = $wpdb->get_results($wpdb->prepare('SELECT post_content FROM wp_posts WHERE post_author = %d AND post_status = "publish"', $user->ID), OBJECT);
    $post_count = 0;
    $post_wordcount = 0;
    foreach ( $posts as $p) {
      $post_count++; // count number of posts
      $post_wordcount += str_word_count($p->post_content, 0); // count words in all posts 
    }

    // find all comments owned by this user
    $comments = $wpdb->get_results($wpdb->prepare('SELECT comment_content FROM wp_comments WHERE user_id = %d', $user->ID), OBJECT);
    $comment_count = 0;
    $comment_wordcount = 0;
    foreach ( $comments as $c) {
      $comment_count++; // count number of posts
      $comment_wordcount += str_word_count($c->comment_content, 0); // count words in all comments
    }

    echo '<li><a href="' . site_url() . "/author/" . $user->user_login . '">' . $user->display_name . '</a>: ';
    echo $post_count . ' posts of ' . $post_wordcount . ' words, ';
    echo $comment_count . ' comments of ' . $comment_wordcount . ' words';
    echo '</li>';
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
