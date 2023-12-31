<?php

/**
 * @package Duplicator
 */

defined("ABSPATH") or die("");

/**
 * Variables
 *
 * @var Duplicator\Core\Controllers\ControllersManager $ctrlMng
 * @var Duplicator\Core\Views\TplMng $tplMng
 * @var array<string, mixed> $tplData
 */
?>
<h3><?php esc_html_e('Recovery FAQ', 'duplicator-pro'); ?></h3>

<div>
    <b><?php _e('Where/when would I use the Recovery Point?', 'duplicator-pro'); ?></b><br/>
    <?php _e(
        "The Recovery point is most useful when you are about to perform an operation you know may be risky to the site's proper operation such as:",
        'duplicator-pro'
    ); ?>
</div>
<ul class="margin-bottom-1">
    <li><?php esc_html_e("Before updating plugins or the theme", 'duplicator-pro'); ?></li>
    <li><?php esc_html_e("Before making theme customizations.", 'duplicator-pro'); ?></li>
    <li><?php esc_html_e("Before editing any file that has the potential to disrupt system operation (.php, .js, .htaccess, etc)", 'duplicator-pro'); ?></li>
</ul>


<p>
    <b><?php esc_html_e("How can I set the Recovery Point?", 'duplicator-pro'); ?></b><br/>
    <?php esc_html_e('Go to the Packages page, click the hamburger menu on a package line, and click "Set Recovery Point".', 'duplicator-pro'); ?>
    <i><?php esc_html_e('Only packages stored locally on the server can be Recovery Points.', 'duplicator-pro'); ?></i>
</p>

<p>
    <b><?php esc_html_e('What\'s the relationship between the "Recovery Point" and the "Recovery URL"?', 'duplicator-pro'); ?></b><br/>
    <?php esc_html_e('The Recovery Point is the package that is used to restore the site when the Recovery URL is browsed to.', 'duplicator-pro'); ?>
</p>

<p>

    <b><?php esc_html_e('Should I Save off the Recovery URL?', 'duplicator-pro'); ?></b><br/>
    <?php
    _e(
        'In short, yes. If you are performing a potentially destructive operation you should not only create a Recovery Point, but you should also save the Recovery URL associated with the Recovery Point.', // phpcs:ignore Generic.Files.LineLength
        'duplicator-pro'
    );
    ?>
</p>

<p>
    <b><?php esc_html_e('Where can I find the Recovery URL?', 'duplicator-pro'); ?></b><br/>
    <?php
    _e(
        'The recovery URL can be copied to your clipboard either by going to Tools > Recovery or at the start of the Drag and Drop import process.',
        'duplicator-pro'
    );
    ?>
</p>

<p>
    <b><?php esc_html_e('What\'s an example of using the Recovery Point?', 'duplicator-pro'); ?></b><br/>
    <?php
        esc_html_e('See the "Example Usage" section of the help or the ', 'duplicator-pro');
        echo "<a class='dup-recovery-point-guide-link' href='" . DUPLICATOR_PRO_RECOVERY_GUIDE_URL . "' target='" . DUPLICATOR_PRO_HELP_TARGET . "'>";
        esc_html_e('Recovery Point Guide', 'duplicator-pro');
        echo '</a>.';
    ?>
</p>

<p>
    <b><?php esc_html_e('Is the Recovery Point just a regular package?', 'duplicator-pro'); ?></b><br/>
    <?php esc_html_e(
        "It's true that the Recovery Point is based on a standard package, 
        but it has an advantage in that it has captured essential information about the local system that isn't contained in a standard package, 
        such as database credentials and specific path information about the local host. This extra information allows for a faster-than-normal restore.",
        'duplicator-pro'
    ); ?>
</p>

<p>
    <b><?php esc_html_e("Can I restore the site with a normal package?", 'duplicator-pro'); ?></b><br>
    <?php esc_html_e(
        'You can always restore the site using a normal package just as has always been the case with Duplicator/Pro. 
        The main advantage the Recovery Point is quick and easy restoration of the site - no need to copy an installer and 
        archive nor do you need to enter database credential information or site paths.',
        'duplicator-pro'
    ); ?>
</p>

<p>
    <b><?php esc_html_e('Does the recovery point work even if WordPress stops working?', 'duplicator-pro'); ?></b><br>
    <?php esc_html_e(
        'Yes - the recovery system works if your WordPress site is completely down as long as you have saved the Recovery URL. 
        Obviously the package associated with the Recovery Point must not have been removed from the site.',
        'duplicator-pro'
    ); ?>
</p>

<p>
    <b><?php esc_html_e('Can I have two recovery points at once?', 'duplicator-pro'); ?></b><br>
    <?php esc_html_e(
        'There can only be one Recovery Point in the system. 
        However, you can always switch which package is considered the Recovery Point by using 
        the "Set Recovery Point" option on a row on the Packages screen.',
        'duplicator-pro'
    ); ?>
</p>
