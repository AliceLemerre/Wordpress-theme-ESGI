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
       
            </div>

</main>

<?php get_footer() ?>

