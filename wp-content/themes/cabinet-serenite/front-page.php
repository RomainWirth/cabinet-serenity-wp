<?php get_header(); ?>

<main class="container">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <section class="hero">
            <h1><?php the_title(); ?></h1>
            <?php the_excerpt(); ?>
            <?php $contact_page = get_page_by_path('contact'); ?>
            <?php if ( $contact_page ) : ?>
                <a class="hero-button" href="<?php echo esc_url( get_permalink($contact_page->ID) ); ?>">En savoir plus</a>
            <?php endif; ?> 
        </section>
        <div class="prestation-grid">
            <div class="prestation-card">
                <?php $prestations_individuel = new WP_Query( [ 
                    'post_type' => 'prestation',
                    'posts_per_page' => 3,
                    'tax_query' => [
                        [
                            'taxonomy' => 'type_prestation',
                            'field'    => 'slug',
                            'terms'    => 'individuel',
                        ]
                    ]     
                ] ); ?>
                <?php if ( $prestations_individuel->have_posts() ) : ?>
                    <!-- pagination here -->
                    
                    <!-- the loop -->
                    <?php
        	            while ( $prestations_individuel->have_posts() ) :
        		        $prestations_individuel->the_post();
        		    ?>
        		    <?php the_title( '<h2>', '</h2>' ); ?>
                    <?php endwhile; ?>
                    <!-- end of the loop -->
                            
                    <!-- pagination here -->
                            
                    <?php wp_reset_postdata(); ?>
                            
                <?php else : ?>
                    <p><?php esc_html_e( 'Aucune prestation trouvée.' ); ?></p>
                <?php endif; ?> 
            </div>
            <div class="prestation-card">
                <?php $prestations_collectif = new WP_Query( [ 
                    'post_type' => 'prestation',
                    'posts_per_page' => 3,
                    'tax_query' => [
                        [
                            'taxonomy' => 'type_prestation',
                            'field'    => 'slug',
                            'terms'    => 'collectif',
                        ]
                    ]     
                ] ); ?>
                <?php if ( $prestations_collectif->have_posts() ) : ?>
                    <!-- pagination here -->
                
                    <!-- the loop -->
                    <?php
        	            while ( $prestations_collectif->have_posts() ) :
        	            	$prestations_collectif->the_post();
        		    ?>
        		    <?php the_title( '<h2>', '</h2>' ); ?>
                    <?php endwhile; ?>
                    <!-- end of the loop -->
                        
                    <!-- pagination here -->
                        
                    <?php wp_reset_postdata(); ?>
                
                <?php else : ?>
                    <p><?php esc_html_e( 'Aucune prestation trouvée.' ); ?></p>
                <?php endif; ?> 
            </div>
        </div>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>