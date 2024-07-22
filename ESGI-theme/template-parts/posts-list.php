<?php
// Get the custom query passed as an argument
$the_query = isset($args['query']) ? $args['query'] : null;

if ($the_query && $the_query->have_posts()) :
?>
    <ul class="posts-list">
        <?php
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $post = get_post();
        ?>
            <li>
                <a href="<?= esc_url(get_permalink($post->ID)) ?>">
                    <?= esc_html($post->post_title) ?><time> <?= wp_date('j F Y', strtotime($post->post_date)) ?></time>
                </a>
            </li>
        <?php
        }
        ?>
    </ul>
    <?php
    $big = 999999999;

    echo paginate_links([
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, $paged),
        'total' => $the_query->max_num_pages
    ]);
    ?>
<?php
endif;

// Restore original Post Data
wp_reset_postdata();
?>
