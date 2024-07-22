<div class="our-members">
    <?php for ($i = 1; $i <= 4; $i++): ?>
        <?php
        $photo = get_theme_mod("member_{$i}_photo", get_template_directory_uri() . "/assets/images/dummy/member_{$i}.jpg");
        $job_title = get_theme_mod("member_{$i}_job_title", __("Role of Member #{$i}", 'ESGI'));
        $contact_info = get_theme_mod("member_{$i}_contact_info", __("Contact information for Member #{$i}", 'ESGI'));
        ?>
        <div class="members-list">
            <img src="<?php echo esc_url($photo); ?>" alt="<?php echo esc_attr($job_title); ?>">
            <h3><?php echo esc_html($job_title); ?></h3>
            <br>
            <p><?php echo esc_html($contact_info); ?></p>
        </div>
    <?php endfor; ?>
</div>
