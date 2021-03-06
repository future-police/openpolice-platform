<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2007 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Library;

/**
 * Dispatcher Permissible Behavior
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Library\Dispatcher
 */
class DispatcherBehaviorPermissible extends ControllerBehaviorAbstract
{
    /**
     * The permission object
     *
     * @var DispatcherPermissionInterface
     */
    protected $_permission;

    /**
     * Initializes the default configuration for the object
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param  ObjectConfig $config An optional ObjectConfig object with configuration options.
     * @return void
     */
    protected function _initialize(ObjectConfig $config)
    {
        $config->append(array(
            'priority'   => self::PRIORITY_HIGH,
            'auto_mixin' => true
        ));

        parent::_initialize($config);
    }

    /**
     * Command handler
     *
     * Only handles before.action commands to check authorization rules.
     *
     * @param   string $name     The command name
     * @param   object $context  The command context
     * @throws  ControllerExceptionForbidden       If the user is authentic and the actions is not allowed.
     * @throws  ControllerExceptionUnauthorized    If the user is not authentic and the action is not allowed.
     * @return  boolean Return TRUE if action is permitted. FALSE otherwise.
     */
    public function execute( $name, CommandContext $context)
    {
        $parts = explode('.', $name);

        if($parts[0] == 'before')
        {
            $action = $parts[1];

            if($this->canExecute($action) === false)
            {
                if($context->user->isAuthentic()) {
                    throw new ControllerExceptionForbidden('Action '.ucfirst($action).' Not Allowed');
                } else {
                    throw new ControllerExceptionUnauthorized('Action '.ucfirst($action).' Not Allowed');
                }

                return false;
            }
        }

        return true;
    }

    /**
     * Check if an action can be executed
     *
     * @param   string  $action Action name
     * @return  boolean True if the action can be executed, otherwise FALSE.
     */
    public function canExecute($action)
    {
        //Check if the action is allowed
        $method = 'can'.ucfirst($action);

        if(!in_array($method, $this->getMixer()->getMethods()))
        {
            $actions = $this->getActions();
            $actions = array_flip($actions);

            $result = isset($actions[$action]);
        }
        else $result = $this->$method();

        return $result;
    }

    /**
     * Mixin Notifier
     *
     * This function is called when the mixin is being mixed. It will get the mixer passed in.
     *
     * @param ObjectMixable $mixer The mixer object
     * @return void
     */
    public function onMixin(ObjectMixable $mixer)
    {
        parent::onMixin($mixer);

        //Mixin the permission
        $permission       = clone $mixer->getIdentifier();
        $permission->path = array('dispatcher', 'permission');

        if($permission !== $this->getPermission()) {
            $this->setPermission($mixer->mixin($permission));
        }
    }

    /**
     * Get the permission
     *
     * @return DispatcherPermissionInterface
     */
    public function getPermission()
    {
        return $this->_permission;
    }

    /**
     * Set the permission
     *
     * @param  ControllerPermissionInterface $permission The controller permission object
     * @return ControllerBehaviorPermissible
     */
    public function setPermission(DispatcherPermissionInterface $permission)
    {
        $this->_permission = $permission;
        return $this;
    }

    /**
     * Get an object handle
     *
     * Force the object to be enqueue in the command chain.
     *
     * @return string A string that is unique, or NULL
     * @see execute()
     */
    public function getHandle()
    {
        return ObjectMixinAbstract::getHandle();
    }
}