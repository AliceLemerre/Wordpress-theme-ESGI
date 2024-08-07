<?php get_header() ?>

<main id="site-main">
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <h1 class="post-title"><?= the_title() ?></h1>

                <div class="post-thumbnail">
                    <?php the_post_thumbnail(); ?>
                </div>
                <div class="post-content">
                    <?php the_content() ?>
                </div>
            </div>
            <?php if (get_theme_mod('has_sidebar')) {
                echo '<div class="col-2 offset-1">';
                get_sidebar();
                echo '<div>';
            }
            ?>
        </div>
    </div>

</main>

<?php get_footer() ?>