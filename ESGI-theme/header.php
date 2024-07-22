<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
    <title><?php bloginfo('name'); ?></title>
    

</head>

<body 
<?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header id="header" class="header">
        <div class="menu-closed">
            <?php if (has_custom_logo()) { ?>
                <div class="header-logo">
                    <?=    the_custom_logo();
                } else {
                    echo '<h1>' . get_bloginfo('name') . '</h1>';
                }
                ?>
                </div>

            <button id="open-button" class="toggle-button">
                <div class="burger-line"></div>
                <div class="burger-line"></div>
            </button>
        </div>

        <div id="menu-open" class="menu-open">
            <div class="logo-search">
                <?php if (has_custom_logo()) { ?>
                <div class="logo-white">
                    <?=    the_custom_logo();
                } else {
                    echo '<h1>' . get_bloginfo('name') . '</h1>';
                }
                ?>
                </div>

                <div class="search-link">
                    <a href="/search">Or try search</a>
                </div>
            </div>

          <div class="menu-right">
            <button id="close-button" class="close-button">
                    <div class="line line-1"></div>
                    <div class="line line-2"></div>
                </button>
            
                <?php
                if (has_nav_menu('primary_menu')) { ?>

                <?php wp_nav_menu(array(
                        'menu' => 'primary_menu',
                        'container' => 'nav',
                        'container_class' => 'main-menu'
                ));
                }
                ?>
            </div>

        </div>
    </header>