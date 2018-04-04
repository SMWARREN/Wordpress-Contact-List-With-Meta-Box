<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header style="border-bottom: 2px solid lightgrey;height: 100px;">
	<div class="navbar">
		<div class="left-gutter"></div>
		<div class="name">
			<div class="userContainer">
			<div class="userUX">USER EXPERIENCE DEPARTMENT</div>
			<div>Fresenius Medical Care North America</div></div></div>
		<div class="middle-gutter"></div>
		<div class="home">Home</div>
		<div class="right-gutter"></div>
	</div>
</header>
</div>

	<?php

    /*
     * If a regular post or page, and not the front page, show the featured image.
     * Using get_queried_object_id() here since the $post global may not be set before a call to the_post().
     */
    if ((is_single() || (is_page() && ! twentyseventeen_is_frontpage())) && has_post_thumbnail(get_queried_object_id())) :
        echo '<div class="single-featured-image-header">';
        echo get_the_post_thumbnail(get_queried_object_id(), 'twentyseventeen-featured-image');
        echo '</div><!-- .single-featured-image-header -->';
    endif;
    ?>

	<div class="site-content-contain">
		<div id="content" class="site-content">
<div class="wrap">

	<?php if (have_posts()) : ?>
	<?php endif; ?>

	<div class="content-area">
      <center>
				<h1>
					<u>My Contact List</u>
				</h1>
			</center>
		<main id="main" class="site-main" role="main">
			<table class="contactListTable">
			<tr>
				<th>Full Name</th>
				<th>Phone Number</th>
				<th>Email</th>
			</tr>
			<tr>
		<?php
        if (have_posts()) : ?>

			<?php
            /* Start the Loop */
            while (have_posts()) : the_post();
      $details = get_post_meta($post->ID, '_contactsList_key', true);

      ?>
			<tr>
				<td>
					<input
								type="text"
								name='contacts_meta_box[full_name]'
								autocomplete='name'
								id="contacts_meta_box"
								value="<?php echo esc_attr($details['full_name']); ?>"
								placeholder="Enter Full Name Here">
							</td>
				<td>
					<input
								type="text"
								name="contacts_meta_box[phone_number]"
								autocomplete='tel'
								id="contacts_meta_box"
								value="<?php echo esc_attr($details['phone_number']); ?>"
								placeholder="Enter Phone Number Here">
						</td>
				<td><input
								type="text"
								name="contacts_meta_box[email]"
								autocomplete='email'
								id="contacts_meta_box"
								value="<?php echo esc_attr($details['email']); ?>"
								placeholder="Enter Email Here"></td>
						</tr>
			<?php

            endwhile;

            the_posts_pagination(array(
                'prev_text' => twentyseventeen_get_svg(array( 'icon' => 'arrow-left' )) . '<span class="screen-reader-text">' . __('Previous page', 'twentyseventeen') . '</span>',
                'next_text' => '<span class="screen-reader-text">' . __('Next page', 'twentyseventeen') . '</span>' . twentyseventeen_get_svg(array( 'icon' => 'arrow-right' )),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'twentyseventeen') . ' </span>',
            ));

        else :

            get_template_part('template-parts/post/content', 'none');

        endif; ?>
  </table>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->


		</div><!-- #content -->

		<footer>
			<div class="left-gutter"></div>
			<div class="name">USER EXPERIENCE DEPARTMENT</div>
			<div class="right-gutter"></div>
		</footer>
	</div><!-- .site-content-contain -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
