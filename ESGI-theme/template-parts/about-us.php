<div class="about-us-section">
    <!-- Image -->
    <div class="about-us-image">
        <?php if ($image_url = get_theme_mod('about_us_image')) : ?>
            <img src="<?php echo esc_url($image_url); ?>" alt="About Us Image">
        <?php endif; ?>
    </div>

    <!-- List of items -->
    <ul class="about-us-list">
        <?php for ($i = 1; $i <= 3; $i++) : ?>
            <li>
                <h3><?php echo get_theme_mod("about_us_item_{$i}_title", "Who are we?"); ?></h3>
                <br
                <p>
                    <?php echo get_theme_mod("about_us_item_{$i}_description", "Default description for item {$i}."); ?>
                </p>
                <br
            </li>
        <?php endfor; ?>
    </ul>
</div>
