<?php get_header(); ?>

<div class="prestations-grid">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="prestation-card">
        <a href="<?php the_permalink(); ?>">
            <h3><?php the_title(); ?></h3>
        </a>
        <h4><?php echo esc_html( get_field('description_courte') ); ?></h4>
        <div><?php echo esc_html( get_field('prix') ); ?> €</div>
        <div><?php echo esc_html( get_field('duree') ); ?></div>
    </div>
    <?php endwhile; ?> 
    <?php else: ?>
        <p>Pas de prestations</p>
    <?php endif; ?>
</div>
<?php get_footer(); ?>