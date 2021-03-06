<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Categories;

use Nooku\Library;

/**
 * Category Controller Toolbar
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Categories
 */
class ControllerToolbarCategory extends Library\ControllerToolbarActionbar
{
    /**
     * Add default toolbar commands
     * .
     * @param	Library\CommandContext	$context A command context object
     */
    protected function _afterControllerBrowse(Library\CommandContext $context)
    {
        parent::_afterControllerBrowse($context);
        
        $this->addSeparator();
        $this->addEnable(array('label' => 'publish', 'attribs' => array('data-data' => '{published:1}')));
        $this->addDisable(array('label' => 'unpublish', 'attribs' => array('data-data' => '{published:0}')));
    }  
    
    protected function _commandNew(Library\ControllerToolbarCommand $command)
    {
        $option = $this->getController()->getIdentifier()->package;
		$view	= Library\StringInflector::singularize($this->getIdentifier()->name);
		$table  = $this->getController()->getModel()->getState()->table;
		
        $command->href = 'option=com_'.$option.'&view='.$view.'&table='.$table;
    }
}