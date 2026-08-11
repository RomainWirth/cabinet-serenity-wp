<?php get_header(); ?>

<main>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <section class="hero" style="width: 100%; background-color: #f2f2f2;">
            <h1><?php the_title(); ?></h1>
            <?php the_excerpt(); ?>
            <?php $contact_page = get_page_by_path('contact'); ?>
            <?php if ( $contact_page ) : ?>
                <a class="hero-button" href="<?php echo esc_url( get_permalink($contact_page->ID) ); ?>">En savoir plus</a>
            <?php endif; ?> 
        </section>
        <?php the_content(); ?>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>