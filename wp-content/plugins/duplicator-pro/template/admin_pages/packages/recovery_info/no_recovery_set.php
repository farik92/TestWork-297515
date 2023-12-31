<?php

/**
 * Duplicator package row in table packages list
 *
 * @package   Duplicator
 * @copyright (c) 2022, Snap Creek LLC
 */

use Duplicator\Views\ViewHelper;

defined("ABSPATH") or die("");

/**
 * Variables
 *
 * @var \Duplicator\Core\Controllers\ControllersManager $ctrlMng
 * @var \Duplicator\Core\Views\TplMng  $tplMng
 * @var array<string, mixed> $tplData
 */
?>
<h3 class="dup-title maroon">
    <?php ViewHelper::disasterIcon(); ?>&nbsp;<?php _e('Disaster Recovery - None Set', 'duplicator-pro'); ?>
</h3>
<?php
    _e('The recovery point can quickly restore a site to a prior state for any reason. To activate a recovery point follow these steps:', 'duplicator-pro');
?>
<ol>
    <li>
        <?php
            printf(
                __('Select a recovery package with the icon %s displayed*.', 'duplicator-pro'),
                ViewHelper::disasterIcon(false)
            );
            ?>
    </li>
    <li>
        <?php _e('Open details area <i class="fas fa-chevron-left fa-sm fa-fw"></i> and click the "Recover Package..." buttton.', 'duplicator-pro'); ?>
    </li>
    <li>
        <?php _e('Follow the prompts and choose the action to perform.', 'duplicator-pro'); ?>
    </li>
</ol>
<hr/>
<p>
    <b><?php _e('Additional Details:', 'duplicator-pro'); ?></b>
    <?php
    echo __(
        'Once a recovery point is set you can save the "Recovery Key" URL in a safe place for restoration later in the event your site goes down, gets hacked or basically any reason you need to restore a stie.', // phpcs:ignore Generic.Files.LineLength
        'duplicator-pro'
    ) . ' ' .
    __('In the event you still have access to your site you can also launch the recover wizard from the details menu.', 'duplicator-pro');
    ?>
</p>
<small>
    <i>
        <?php
        printf(
            __('*Note: If you do not see a recovery package %s icon in the packages list.', 'duplicator-pro'),
            ViewHelper::disasterIcon(false)
        );
        echo ' ' .
            __('Then be sure to build a full package that does not exclude any of the core WordPress files or database tables.', 'duplicator-pro') . ' ' .
            __('These core files and tables are required to build a valid recovery point.', 'duplicator-pro');
        ?>
    </i>
</small>
