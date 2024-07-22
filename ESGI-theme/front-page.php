<?php get_header() ?>

<main id="site-main">
        <div >

        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
        ?>

        <div class="homepage-title content">
            <h1><?php the_title(); ?></h1>
        </div>

        <div class="homepage-main-image">
            <?php  if ( has_post_thumbnail() ) { //définissez une image dans vos réglages de page pour remplacer celle par défaut
        the_post_thumbnail();
        } else { ?>
        <img src="<?php bloginfo('template_directory'); ?>/images/1.png" alt="<?php the_title(); ?>" />
        <?php } ?>
        </div>

       

        <div class="about-us-section content">
            <h2>About Us</h2>
            <p><?php the_content(); ?></p>
        </div>

    <?php
        endwhile;
    endif;
    ?>


            <div>
                <?php
           
                get_template_part('template-parts/about-us');

                get_template_part('template-parts/our-services');

                get_template_part('template-parts/our-partners');

                echo do_shortcode('[esgi_members]');



                ?>
            </div>
        </div>
</main>

<?php get_footer() ?>