<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class StreetsModelStreets extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('city' , 'int')
            ->insert('islp' , 'string')
            ->insert('no_islp' , 'int')
            ->insert('row' , 'int')
            ->insert('table' , 'string')
            ->insert('iso' , 'string')
            ->insert('source' , 'int')
            ->insert('identifier' , 'int')
            ->insert('title' , 'string')
            ->insert('sort'      , 'cmd', 'title');
    }

    protected function _buildQueryColumns(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryColumns($query);
        $state = $this->getState();

        $cities = $this->getObject('com:police.model.zones')->id($this->getObject('application')->getSite())->getRow()->cities;

        $query->columns(array(
            'title'             => $cities !== '1' ? "CONCAT(tbl.title,' (',city.title,')')" : 'tbl.title',
            'title_short'       => 'tbl.title',
            'city'              => 'city.title',
            'islp'              => 'islps.islp'
        ));
    }

    protected function _buildQueryJoins(Library\DatabaseQuerySelect $query)
    {
        $state = $this->getState();

        $languages = $this->getObject('application.languages');
        $language = $languages->getActive()->slug;

        // Join the ISLP ID
        $query->join(array('islps' => 'data.streets_streets_islps'), 'islps.streets_street_identifier = tbl.streets_street_identifier');

        $query->join(array('city' => $language == 'fr' ? 'data.fr-be_streets_cities' : 'data.streets_cities'), 'city.streets_city_id = tbl.streets_city_id');

        parent::_buildQueryJoins($query);
    }

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryWhere($query);
        $state = $this->getState();

        $site = $this->getObject('application')->getSite();

        if ($state->iso && !in_array($site, array('default', 'fed', '5806'))) {
            $query->where('tbl.iso = :iso')->bind(array('iso' => $state->iso));
        }

        if ($state->source) {
            $query->where('tbl.sources_source_id = :source')->bind(array('source' => $state->source));
        }

        if ($state->identifier) {
            $query->where('tbl.streets_street_identifier = :identifier')->bind(array('identifier' => $state->identifier));
        }

        if ($state->search) {
            $query->where('(tbl.title LIKE :search OR islps.islp LIKE :search OR tbl.streets_street_id LIKE :search)')->bind(array('search' => '%' . $state->search . '%'));
        }

        if(!$state->isUnique() && $state->row && $state->table)
        {
            if($state->table) {
                $query->where('relations.table = :table')->bind(array('table' => $state->table));
            }

            if($state->row) {
                $query->where('relations.row IN :row')->bind(array('row' => (array) $state->row));
            }
        }

        if ($state->title) {
            $query->where('tbl.title LIKE :title')->bind(array('title' => $state->title));
        }

        if ($state->city) {
            $query->where('tbl.streets_city_id = :city')->bind(array('city' => $state->city));
        }

        if ($state->no_islp) {
            $query->where('islps.islp IS NULL');
        }
    }
}