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
 * Dispatcher Response Interface
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Library\Dispatcher
 */
interface DispatcherResponseInterface extends ControllerResponseInterface
{
    /**
     * Send the response
     *
     * @return boolean  Returns true if the response has been send, otherwise FALSE
     */
    public function send();

    /**
     * Sets the response path
     *
     * Path needs to be of the form "scheme://..." and a wrapper for that protocol need to be registered. See @link
     * http://www.php.net/manual/en/wrappers.php for a list of default PHP stream protocols and wrappers.
     *
     * @param mixed  $content   The content
     * @param string $type      The content type
     * @throws \InvalidArgumentException If the path is not a valid stream or no stream wrapper is registered for the
     *                                   stream protocol
     * @return HttpMessage
     */
    public function setPath($path);

    /**
     * Get the response path
     *
     * @return string The response stream path.
     */
    public function getPath();

    /**
     * Sets the response content using a stream
     *
     * @param FilesystemStreamInterface $stream  The stream object
     * @return HttpMessage
     */
    public function setStream(FilesystemStreamInterface $stream);

    /**
     * Get the stream resource
     *
     * @return FilesystemStreamInterface
     */
    public function getStream();

    /**
     * Get a transport handler by identifier
     *
     * @param   mixed    $transport    An object that implements ObjectInterface, ObjectIdentifier object
     *                                 or valid identifier string
     * @param   array    $config    An optional associative array of configuration settings
     * @return DispatcherResponseInterface
     */
    public function getTransport($transport, $config = array());

    /**
     * Attach a transport handler
     *
     * @param   mixed  $transport An object that implements ObjectInterface, ObjectIdentifier object
     *                            or valid identifier string
     * @param   array $config  An optional associative array of configuration settings
     * @return DispatcherResponseInterface
     */
    public function attachTransport($transport, $config = array());
}