<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Component\Pages;

/**
 * Flat Orderable Database Behavior
 *
 * @author  Gergo Erdosi <http://nooku.assembla.com/profile/gergoerdosi>
 * @package Component\Contacts
 */
class AboutDatabaseBehaviorOrderableFlat extends Pages\DatabaseBehaviorOrderableFlat
{
    public function _buildQuery($query)
    {
        parent::_buildQuery($query);

        if ($this->getMixer()->getIdentifier()->name == 'article')
        {
            $query->where('about_category_id = :category')
                ->where('published >= :published')
                ->bind(array('category' => $this->about_category_id, 'published' => 0));

        }
    }
}