<?
/**
 * Belgian Police Web Platentry - Forms Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platentry
 */
?>

<!--
<script src="assets://js/koowa.js" />
<style src="assets://css/koowa.css" />
-->

<ktml:module position="actionbar">
    <ktml:toolbar type="actionbar">
</ktml:module>

<ktml:module position="sidebar">
    <h3><?= translate('Forms') ?></h3>
    <?= import('com:forms.view.forms.list.html', array('forms' => object('com:forms.model.forms')->sort('title')->getRowset())); ?>
</ktml:module>

<form action="" method="get" class="-koowa-grid">
    <?= import('default_scopebar.html'); ?>
    <table>
        <thead>
            <tr>
                <th width="10">
                    <?= helper( 'grid.checkall'); ?>
                </th>
                <th width="1"></th>
                <th width="50%">
                    <?= helper('grid.sort', array('column' => 'name')) ?>
                </th>
                <th width="50%">
                    <?= helper('grid.sort', array('column' => 'email')) ?>
                </th>
                <th>
                    <?= helper('grid.sort', array('column' => 'created_on', 'title' => 'Created on')) ?>
                </th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="7">
                    <?= helper('com:application.paginator.pagination', array('total' => $total)) ?>
                </td>
            </tr>
        </tfoot>
        <tbody>
        <? foreach ($entries as $entry) : ?>
            <tr>
                <td align="center">
                    <?= helper('grid.checkbox', array('row' => $entry))?>
                </td>
                <td align="center">
                    <?= helper('grid.enable', array('row' => $entry, 'field' => 'published')) ?>
                </td>
                <td class="ellipsis">
                    <a href="<?= route( 'view=entry&id='.$entry->id ); ?>">
                        <?= escape($entry->name ? $entry->name : translate('Anonymous')) ?>
                    </a>
                </td>
                <td>
                    <?= $entry->email ?>
                </td>
                <td>
                    <?= helper('date.format', array('date'=> $entry->created_on, 'format' => translate('DATE_FORMAT_LC5'))) ?>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</form>