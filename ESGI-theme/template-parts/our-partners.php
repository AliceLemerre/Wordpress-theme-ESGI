<div class="partners-list">
        <?php
        for ($i = 1; $i <= 6; $i++) {
            $logo = get_theme_mod("partner_{$i}_logo");

            if ($logo) {
                echo '<div class="partner">';
                echo '<img src="' . esc_url($logo) . '" alt="Partner ' . $i . ' Logo">';
                echo '</div>';
            }
        }
        ?>
</div>
