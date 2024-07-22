<?php
/*
Template Name: Partners Template
*/

get_header() ?>

<main id="site-main" class="our-partners">
   
            <div>
                <h1><?= the_title() ?></h1>
                <div class="page-content our-partners-content">
                <?php get_template_part('template-parts/our-partners'); ?>                </div>

                </div>
            </div>
       

</main>

<?php get_footer() ?>

