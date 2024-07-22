<div class="contact-section">
 
    <ul class="contact-list">
        <?php for ($i = 2; $i <= 3; $i++) : ?>
            <li>
                <h3><?php echo get_theme_mod("contact_{$i}_role", "Manager"); ?></h3>
                <br
                <p><?php echo get_theme_mod("contact_{$i}_contacts", "+33 1 53 31 25 23 <br> info@esgi.com"); ?></p>
                <br
            </li>
        <?php endfor; ?>
    </ul>
</div>
