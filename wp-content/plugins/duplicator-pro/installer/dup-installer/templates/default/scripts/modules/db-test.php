<?php

/**
 *
 * @package templates/default
 */

defined('ABSPATH') || defined('DUPXABSPATH') || exit;

use Duplicator\Installer\Core\InstState;
use Duplicator\Installer\Core\Params\PrmMng;
use Duplicator\Libs\Snap\SnapJson;

$paramsManager = PrmMng::getInstance();

if (InstState::getInstance()->getMode() === InstState::MODE_OVR_INSTALL) {
    $overwriteData = $paramsManager->getValue(PrmMng::PARAM_OVERWRITE_SITE_DATA);
    $ovr_dbhost    = $overwriteData['dbhost'];
    $ovr_dbname    = $overwriteData['dbname'];
    $ovr_dbuser    = $overwriteData['dbuser'];
    $ovr_dbpass    = $overwriteData['dbpass'];
} else {
    $ovr_dbhost = '';
    $ovr_dbname = '';
    $ovr_dbuser = '';
    $ovr_dbpass = '';
}
?>
<script>
    const fileExtractMode = <?php echo SnapJson::jsonEncode(InstState::dbDoNothing()); ?>;

    DUPX.toggleFileExtractMode = function(enable = false)   
    {
        if (enable) {
            $('.requires-db-hide').hide();
            $('.requires-db-disable').prop('disabled', true);
            $('.requires-no-db').show();
            $('#label-for-advanced').trigger('click');
        } else {
            $('.requires-db-hide').show();
            $('.requires-db-disable').prop('disabled', false);
            $('.requires-no-db').hide();
        }
    }

    const dbViewModeInputId = <?php echo SnapJson::jsonEncode($paramsManager->getFormItemId(PrmMng::PARAM_DB_VIEW_MODE)); ?>;
    const dbHostInputId = <?php echo SnapJson::jsonEncode($paramsManager->getFormItemId(PrmMng::PARAM_DB_HOST)); ?>;
    const dbNameInputId = <?php echo SnapJson::jsonEncode($paramsManager->getFormItemId(PrmMng::PARAM_DB_NAME)); ?>;
    const dbUserInputId = <?php echo SnapJson::jsonEncode($paramsManager->getFormItemId(PrmMng::PARAM_DB_USER)); ?>;
    const dbPassInputId = <?php echo SnapJson::jsonEncode($paramsManager->getFormItemId(PrmMng::PARAM_DB_PASS)); ?>;
    const dbActionInputId = <?php echo SnapJson::jsonEncode($paramsManager->getFormItemId(PrmMng::PARAM_DB_ACTION)); ?>;

    DUPX.basicDBActionChange = function ()
    {
        var action = $('#' + dbActionInputId).val();
        $('.s2-basic-pane .s2-warning-manualdb').hide();
        $('.s2-basic-pane .s2-warning-emptydb').hide();
        $('.s2-basic-pane .s2-warning-renamedb').hide();

        DUPX.toggleFileExtractMode(fileExtractMode);
        switch (action)
        {
            case 'create'  :
                break;
            case 'empty'   :
                $('.s2-basic-pane .s2-warning-emptydb').show(300);
                break;
            case 'rename'  :
                $('.s2-basic-pane .s2-warning-renamedb').show(300);
                break;
            case 'manual'  :
                $('.s2-basic-pane .s2-warning-manualdb').show(300);
                break;
            case 'dbdonothing':
                DUPX.toggleFileExtractMode(true);
                break;
        }
    };


    //DOCUMENT INIT
    $(document).ready(function ()
    {
        $("#" + dbActionInputId).on("change", DUPX.basicDBActionChange);
        DUPX.basicDBActionChange();

        DUPX.checkOverwriteParameters = function (dbhost, dbname, dbuser, dbpass)
        {
            $("#" + dbHostInputId).val(<?php echo SnapJson::jsonEncode($ovr_dbhost); ?>).prop('readonly', true);
            $("#" + dbNameInputId).val(<?php echo SnapJson::jsonEncode($ovr_dbname); ?>).prop('readonly', true);
            $("#" + dbUserInputId).val(<?php echo SnapJson::jsonEncode($ovr_dbuser); ?>).prop('readonly', true);
            $("#" + dbPassInputId).val(<?php echo SnapJson::jsonEncode($ovr_dbpass); ?>).prop('readonly', true);
            $("#s2-db-basic-setup").show();
        };

        DUPX.fillInPlaceHolders = function ()
        {
            $("#" + dbHostInputId).attr('placeholder', <?php echo SnapJson::jsonEncode($ovr_dbhost); ?>).prop('readonly', false);
            $("#" + dbNameInputId).attr('placeholder', <?php echo SnapJson::jsonEncode($ovr_dbname); ?>).prop('readonly', false);
            $("#" + dbUserInputId).attr('placeholder', <?php echo SnapJson::jsonEncode($ovr_dbuser); ?>).prop('readonly', false);
            $("#" + dbPassInputId).attr('placeholder', <?php echo SnapJson::jsonEncode($ovr_dbpass); ?>).prop('readonly', false);
        };

        DUPX.resetParameters = function ()
        {
            $("#" + dbHostInputId).val('').attr('placeholder', '').prop('readonly', false);
            $("#" + dbNameInputId).val('').attr('placeholder', '').prop('readonly', false);
            $("#" + dbUserInputId).val('').attr('placeholder', '').prop('readonly', false);
            $("#" + dbPassInputId).val('').attr('placeholder', '').prop('readonly', false);
        };

<?php if (InstState::getInstance()->getMode() === InstState::MODE_OVR_INSTALL) : ?>
            DUPX.fillInPlaceHolders();
<?php endif; ?>

        DUPX.togglePanels = function ()
        {
            if ($('#' + dbViewModeInputId).val() == 'basic') {
                $('#' + dbViewModeInputId).val("cpnl").change();
            } else {
                $('#' + dbViewModeInputId).val("basic").change();
            }
        }

        $('#' + dbViewModeInputId).change(function () {
            switch ($(this).val()) {
                case 'cpnl':
                    $('.s2-cpnl-pane').removeClass('no-display');
                    $('.s2-basic-pane').addClass('no-display');
                    $('#' + dbViewModeInputId + "_0").removeClass("active");
                    $('#' + dbViewModeInputId + "_1").addClass("active");
                    break;
                case 'basic':
                default:
                    $('.s2-cpnl-pane').addClass('no-display');
                    $('.s2-basic-pane').removeClass('no-display');
                    $('#' + dbViewModeInputId + "_1").removeClass("active");
                    $('#' + dbViewModeInputId + "_0").addClass("active");                    
                    break;
            }
        });
    });
</script>
