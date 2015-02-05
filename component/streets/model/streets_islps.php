<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Streets;
use Nooku\Library;

class ModelStreets_islps extends Library\ModelTable
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('islp' , 'string')
            ->insert('street' , 'int');
    }

    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryWhere($query);
        $state = $this->getState();

        if ($state->islp) {
            $query->where('tbl.islp = :islp')->bind(array('islp' => $state->islp));
        }

        if ($state->street) {
            $query->where('tbl.streets_street_identifier = :street')->bind(array('street' => $state->street));
        }
    }
}