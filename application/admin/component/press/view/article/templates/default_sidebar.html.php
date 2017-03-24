<?
/**
 * Belgian Police Web Platform - Press Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<fieldset>
    <legend><?= translate('Publish') ?></legend>
    <div>
        <label for="published"><?= translate('Published') ?></label>
        <div>
            <input type="checkbox" name="published" value="1" <?= $article->published ? 'checked="checked"' : '' ?> />
        </div>
    </div>
    <div>
        <label for="publish_on"><?= translate('Publish on') ?></label>
        <div class="controls">
            <input id="publish_on" type="text" name="publish_on" value="<?= $article->publish_on ? helper('date.format', array('date'=> $article->publish_on, 'format' => 'd-m-Y H:i')) : '' ?>" <?= $article->published ? 'disabled="disabled"' : '' ?> />
            <script data-inline>
                $jQuery("#publish_on").datetimepicker({
                    format:'d-m-Y H:i',
                    lang: '<?= $this->getObject('application.languages')->getActive()->slug; ?>',
                    dayOfWeekStart: '1'
                });
            </script>
        </div>
    </div>
</fieldset>

<fieldset>
    <legend><?= translate('Description') ?></legend>
    <textarea name="description" rows="4" cols="50" maxlength="150" class="required"><?= $article->description ?></textarea>
</fieldset>

<? if($article->isAttachable()) : ?>
    <fieldset>
        <legend><?= translate('Attachments') ?></legend>
        <? if (!$article->isNew()) : ?>
            <?= import('com:attachments.view.attachments.list.html', array('attachments' => $article->getAttachments())) ?>
        <? endif ?>
        <?= import('com:attachments.view.attachments.upload.html') ?>
    </fieldset>
<? endif ?>

<script data-inline>
    $jQuery("input[name=published]").click(function()
    {
        $jQuery("input[name=publish_on]").attr('disabled', this.checked)
    });
</script>
