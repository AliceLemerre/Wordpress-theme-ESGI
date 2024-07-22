<?php
/*
Template Name: Services Template
*/

get_header() ?>

<main>
  
            <div>
                <h1><?= the_title() ?></h1>
                <div class="post-content">
                
                <?php
                    get_template_part('template-parts/our-services');

                    the_content() 
                ?>

                </div>

                <div class="services-main-image">
                <?php  if ( has_post_thumbnail() ) { //définissez une image dans vos réglages de page pour remplacer celle par défaut
                the_post_thumbnail();
                } else { ?>
                <img src="<?php bloginfo('template_directory'); ?>/images/4.png" alt="<?php the_title(); ?>" />
                <?php } ?>
                </div>
       
            </div>

</main>

<?php get_footer() ?>

