<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Application;

use Nooku\Library;

/**
 * Exception Controller Permission
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Application
 */
class ControllerPermissionException extends Library\ControllerPermissionAbstract
{
    public function canRender()
    {
        return true;
    }
}