<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
?>
<!DOCTYPE html>
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

<div class="wrap">
	<div class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
            /* Start the Loop */
            while (have_posts()) : the_post();
      ?> <h1> <?php the_title(); ?> </h1> <?php
            $details = get_post_meta($post->ID, '_contactsList_key', true);
            ?>
						<table class="contactListTable">
						<tr>
							<th>Full Name</th>
							<th>Phone Number</th>
							<th>Email</th>
						</tr>
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
						</table>
			<?php

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;



                the_post_navigation(array(
                    'prev_text' => '<span class="screen-reader-text">' . __('Previous Post', 'twentyseventeen') . '</span><span aria-hidden="true" class="nav-subtitle">' . __('Previous', 'twentyseventeen') . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg(array( 'icon' => 'arrow-left' )) . '</span>%title</span>',
                    'next_text' => '<span class="screen-reader-text">' . __('Next Post', 'twentyseventeen') . '</span><span aria-hidden="true" class="nav-subtitle">' . __('Next', 'twentyseventeen') . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg(array( 'icon' => 'arrow-right' )) . '</span></span>',
                ));

            endwhile; // End of the loop.
            ?>

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
