<div class="our-services-section">
    <ul class="services-list">
        <?php 
        for ($i = 1; $i <= 4; $i++) {
            $title = get_theme_mod("service_{$i}_title");
            $description = get_theme_mod("service_{$i}_description");
            $image = get_theme_mod("service_{$i}_image");

            if ($title || $description || $image) : ?>
                <li class="service-item">
                    <?php if (!empty($image)) : ?>                
                            <img class="service-image" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
                    <?php endif; ?>

                    <?php if (!empty($title)) : ?>
                       <div class="service-title-containers"> <h3 class="service-title underline"><?php echo esc_html($title); ?></h3></div>
                    <?php endif; ?>

                    <?php if (!empty($description)) : ?>
                        <p class="service-description"><?php echo esc_html($description); ?></p>
                    <?php endif; ?>
                </li>
            <?php endif;
        }
        ?>
    </ul>
</div>