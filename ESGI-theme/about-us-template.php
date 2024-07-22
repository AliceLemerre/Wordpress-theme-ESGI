<?php
/*
Template Name: About Us Template
*/

get_header() ?>

<mainclass="about-us">
    <div>
                <h1 ><?= the_title() ?></h1>

                <div class="homepage-main-image">
                <?php  if ( has_post_thumbnail() ) { //définissez une image dans vos réglages de page pour remplacer celle par défaut
                the_post_thumbnail();
                } else { ?>
                <img src="<?php bloginfo('template_directory'); ?>/images/4.png" alt="<?php the_title(); ?>" />
                <?php } ?>
                </div>

                <div class="page-content about-us-content">
                    <div class="text-content">
                        <?php the_content(); ?>
                    </div> 

                        <?php get_template_part('template-parts/about-us'); ?> 
                </div>

                <div class="page-content about-us-content">
            <?php echo do_shortcode('[esgi_members]');?>
                </div>
         
    </div>

</main>

<?php get_footer() ?>