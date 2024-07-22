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
                    <?php
                    // Affichage des projets utilisant ce skill
                    $args = [
                        'post_type' => 'project',
                        'tax_query' => [
                            [
                                'taxonomy' => 'skill',
                                'field' => 'term_id',
                                'terms' => $term->term_id
                            ]
                        ]
                    ];
                    $projects = get_posts($args);

                    if (!empty($projects)) {
                        echo '<h3>Projets utilisant ce skill</h3>';
                        echo '<ul>';
                        foreach ($projects as $p) {
                            echo '<li><a href="' . get_permalink($p) . '">' . $p->post_title . '</a></li>';
                        }
                        echo '</ul>';
                    }
                    ?>
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