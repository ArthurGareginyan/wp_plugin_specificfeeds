<?php

/**
 * Prevent Direct Access
 */
defined( 'ABSPATH' ) or die( "Restricted access!" );

/**
 * Render Sidebar
 */
?>
    <div class="inner-sidebar">
        <div id="side-sortables" class="meta-box-sortabless ui-sortable">

            <div class="postbox banner">
                <h3 class="title"><?php _e( 'We are «Space X-Chimp»', $text ); ?></h3>
                <div class="inside">
                    <a href="https://www.spacexchimp.com/" target="_blank">
                        <img src="<?php echo SPACEXCHIMP_P002_URL . 'inc/img/spacexchimp-logo.png'; ?>" alt="Space X-Chimp">
                    </a>
                </div>
            </div>

            <div class="postbox about">
                <h3 class="title"><?php _e( 'About', $text ); ?></h3>
                <div class="inside">
                    <p><?php _e( 'This plugin allows you to easily add the RSS feed icon by SpecificFeeds.com in any place on your website.', $text ); ?></p>
                    <p><?php printf(
                                     __( '%s allows your visitors to receive messages from your Blog/RSS Feed by email. It\'s 100&percnt; free and also has several other benefits.', $text ),
                                     '<a href="https://www.specificfeeds.com/" target="_blank" rel="nofollow">SpecificFeeds.com</a>'
                                    );
                       ?></p>
                </div>
            </div>

            <div class="postbox help">
                <h3 class="title"><?php _e( 'Help', $text ); ?></h3>
                <div class="inside">
                    <p><?php _e( 'If you have a question, please read the information in the FAQ section.', $text ); ?></p>
                </div>
            </div>

            <div class="postbox support">
                <h3 class="title"><?php _e( 'Support', $text ); ?></h3>
                <div class="inside">
                    <p><?php _e( 'Every little contribution helps to cover our costs and allows us to spend more time creating things for awesome people like you to enjoy.', $text ); ?></p>
                    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8A88KC7TFF6CS" target="_blank" class="btn btn-default button-labeled">
                            <span class="btn-label">
                                <img src="<?php echo SPACEXCHIMP_P002_URL . 'inc/img/paypal.svg'; ?>" alt="PayPal">
                            </span>
                            <?php _e( 'Donate with PayPal', $text ); ?>
                    </a>
                    <p><?php _e( 'Thanks for your support!', $text ); ?></p>
                </div>
            </div>

        </div>
    </div>
<?php
