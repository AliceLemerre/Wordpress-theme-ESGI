        <footer id="site-footer" class="footer">

            <div class="footer1">
                <?php
                    if (has_custom_logo()) { ?>
                    <div class="footer-logo">
                        <?=    the_custom_logo();
                    } else {
                        echo '<h1>' . get_bloginfo('name') . '</h1>';
                    }
                ?>
                    </div>

                    <?= date('Y') ?> Figma Template by ESGI
            </div>


            <div class="footer2">
                <?php get_template_part('template-parts/contact');

                get_template_part('template-parts/social-links'); ?>
            </div>

        </footer>
        <?php wp_footer() ?>
        </body>

        </html>