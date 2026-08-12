<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<div>
    <h1><?php the_title(); ?></h1>
    <h2><?php echo esc_html( get_field('description_courte') ); ?></h2>
    <div><?php echo esc_html( get_field('prix') ); ?> €</div>
    <div><?php echo esc_html( get_field('duree') ); ?></div>
    <div><?php echo wp_kses_post( get_field('description_longue') ); ?></div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>