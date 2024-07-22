<?php get_header() ?>
<?php
$term = get_queried_object();
?>
<main id="site-main">
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <h1 class="post-title"><?= $term->name ?></h1>
                <div class="post-content">
                    <?= $term->description ?>
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