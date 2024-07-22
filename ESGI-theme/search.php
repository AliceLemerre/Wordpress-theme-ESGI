<?php
get_header();

$search_query = get_search_query();

if (!isset($paged)) {
    $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1; 
}

$args = [
    's' => $search_query,
    'paged' => $paged,
    'orderby' => 'date',
    'order' => 'DESC'
];
$the_query = new WP_Query($args);
?>

<h1>Search results for: <span class="underline">"<?php echo esc_html($search_query); ?>"</span></h1>

<?php if ($the_query->have_posts()) : ?>
  <div class="search-results">
    <div class="posts-list">
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <div class="post-item">
                <a href="<?= esc_url(get_permalink()) ?>">
                    <h3><?= esc_html(get_the_title()) ?></h3>
                    <time><?= esc_html(get_the_date('j F Y')) ?></time>
                </a>
                <p><?= esc_html(get_the_excerpt()) ?></p>
            </div>
        <?php endwhile; ?>
    </div>
    <?php
    $big = 999999999; 

    echo paginate_links([
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged', 1)),
        'total' => $the_query->max_num_pages
    ]);
    ?>
  </div>
<?php else : ?>
    <p>No search result found for the term "<?php echo esc_html($search_query); ?>".</p>
<?php endif;

// Restore original Post Data
wp_reset_postdata();

get_footer();
?>
