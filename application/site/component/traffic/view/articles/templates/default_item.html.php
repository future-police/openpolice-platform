<? if($article->text) : ?>
    <?= $article->text ?>
<? endif ?>

<h2>
    <?= @helper('date.format', array('date'=> $article->start_on, 'format' => JText::_('DATE_FORMAT_LC3'))) ?>
    <?= $article->end_on ? @text('till').' '.@helper('date.format', array('date'=> $article->end_on, 'format' => JText::_('DATE_FORMAT_LC3'))) : '' ?>
    <small><?= $article->title ?></small>
</h2>
<a href="<?= @helper('route.article', array('row' => $article)) ?>"></a>

<? if($streets = $this->getObject('com:streets.model.relations')->row($article->id)->table('traffic_articles')->getRowset()) : ?>
<? foreach ($streets as $street) : ?>
    <?= $street->street ?>,
<? endforeach; ?>
<? else : ?>
    <?= @text('Grondgebied van Politie').' '.@object('com:police.model.zone')->id(@object('application')->getCfg('site' ))->getRow()->title ?>
<? endif ?>