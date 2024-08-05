<?php
// Query for portfolio posts
$args = array(
  'post_type' => 'portfolio',
  'posts_per_page' => 6, // Adjust the number of posts to display
);
$portfolio_query = new WP_Query( $args );

// Check if there are any posts
if ( $portfolio_query->have_posts() ) : ?>

  <div class="portfolio-list">
    <?php while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>
      <div class="portfolio-item">
        <h2><?php the_title(); ?></h2>
        <?php the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>">View Project</a>
      </div>
    <?php endwhile; ?>
  </div>

<?php wp_reset_postdata(); endif; ?>
