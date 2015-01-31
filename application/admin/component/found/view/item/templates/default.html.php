<?
/**
 * Belgian Police Web Platform - Found Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */
?>

<?= helper('behavior.validator'); ?>

<script src="assets://js/koowa.js" />
<script src="assets://news/js/jquery.datetimepicker.js" />
<style src="assets://news/css/jquery.datetimepicker.css" />

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<? if($item->isTranslatable()) : ?>
    <ktml:module position="actionbar" content="append">
        <?= helper('com:languages.listbox.languages', array('attribs' => array('disabled' => 'true'))) ?>
    </ktml:module>
<? endif ?>

<form action="" method="post" id="item-form" class="-koowa-form">
    <input type="hidden" name="published" value="0" />
    <input type="hidden" name="attachments_attachment_id" value="0" />

    <div class="main">
        <div class="title">
            <input class="required" type="text" name="title" maxlength="50" value="<?= escape($item->title) ?>" placeholder="<?= translate('Title') ?>" />
            <div class="slug">
                <span class="add-on">Slug</span>
                <input type="text" name="slug" maxlength="60" value="<?= escape($item->slug) ?>" />
            </div>
        </div>

        <?= object('com:ckeditor.controller.editor')->render(array('name' => 'text', 'text' => $item->text, 'attribs' => array('class' => 'ckeditor-required'))) ?>
    </div>
    <div class="sidebar">
        <?= import('default_sidebar.html'); ?>
    </div>
</form>