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
    <?php
        get_template_part('posts-list', null, ['query' => $the_query]);
    ?>
  </div>
<?php else : ?>
    <p>No search result found for the term "<?php echo esc_html($search_query); ?>".</p>
<?php endif;

get_footer();
?>
