<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Revisions;

use Nooku\Library;

/**
 * Revisions Database Table
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Revisions
 */
class DatabaseTableRevisions extends Library\DatabaseTableAbstract
{
    protected function _initialize(Library\ObjectConfig $config)
    {     
        $config->append(array(
            'name'      => 'revisions',
            'behaviors' => array('creatable'),
            'filters'   => array(
                'data' => array('json')
            )
        ));

        parent::_initialize($config);
    }

    /**
     * Insert a new row into the table
     * 
     * Takes care of automatically incrementing the revision number
     *
     * @param Library\DatabaseRowInterface $row
     */
    public function insert(Library\DatabaseRowInterface $row)
    {
    	$query = $this->getObject('lib:database.query.select')
            ->where('table', '=', $row->table)
            ->where('row',   '=', $row->row)
            ->order('revision','desc')
            ->limit(1);

       	$latest = $this->select($query, Library\Database::FETCH_ROW);

     	if (!$latest->isNew()) {
            $row->revision = $latest->revision + 1;
        } 

        return parent::insert($row);
    }
}