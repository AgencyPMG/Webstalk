<?php
/**
 * This File is Part of Webstalk
 *
 * @since       1.0
 * @package     PMG\Webstalk
 * @copyright   2014 PMG <http://pmg.co>
 * @license     http://opensource.org/licenses/Apache-2.0 Apache-2.0
 */

namespace PMG\Webstalk\Controller;

use PMG\Webstalk\Entity\ServerCollection;
use PMG\Webstalk\Adapter\AdapterFactory;
use PMG\Webstalk\Adapter\TemplateEngine;

/**
 * Displays information about the beanstalkd servers to users.
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
class WebstalkController
{
    /**
     * The twig environment, used to render the pages.
     *
     * @since   1.0
     * @access  private
     * @var     TemplateEngine
     */
    private $templates;

    /**
     * The adapter factory. A bit of syntactic sugar to handle accessing the
     * servers easier
     *
     * @since   1.0
     * @access  private
     * @var     AdapterFactory
     */
    private $factory;

    /**
     * The array of valid servers.
     *
     * @since   1.0
     * @access  private
     * @var     ServerCollection
     */
    private $servers;

    /**
     * Constructor. Set up our dependencies.
     *
     * @since   1.0
     * @access  public
     * @param   TemplateEngine $template
     * @param   AdapterFactory $factor
     * @param   array $server
     * @return  void
     */
    public function __construct(TemplateEngine $templates, AdapterFactory $factory, ServerCollection $servers)
    {
        $this->templates = $templates;
        $this->factory = $factory;
        $this->servers = $servers;
    }
}
