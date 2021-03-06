<?
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
?>

<h3><?= translate( 'Groups' ); ?></h3>
<ul class="navigation">
    <li>
        <a <? if(!$state->group) echo 'class="active"' ?> href="<?= route('group=') ?>">
            <?= translate('All groups') ?>
        </a>
    </li>
    <? foreach($groups as $group) : ?>
    <li>
        <a <? if($state->group == $group->name) echo 'class="active"' ?> href="<?= route('group='.$group->name) ?>">
            <?= $group->name; ?>
        </a>
    </li>
    <? endforeach ?>
</ul>
<h3><?= translate( 'Details' ); ?></h3>
<p><?= translate('Files').':'.$count ?></p>
<p><?= translate('Size').':'.number_format($size / 1024, 2) ?></p>