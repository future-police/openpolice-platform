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

class DatabaseTableProvinces extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {
        $languages = $this->getObject('application.languages');
        $language = $languages->getActive()->slug;

        $config->append(array(
            'name'      => $language == 'fr' ? 'data.fr-be_streets_provinces' : 'data.streets_provinces',
            'behaviors' => 'lockable', 'creatable', 'modifiable'
        ));

        parent::_initialize($config);
    }
}