<?php
/**
 * This File is Part of Webstalk
 *
 * @since       1.0
 * @package     PMG\Webstalk
 * @copyright   2014 PMG <http://pmg.co>
 * @license     http://opensource.org/licenses/Apache-2.0 Apache-2.0
 */

namespace PMG\Webstalk\Adapter;

/**
 * Wraps up external templating libraries for us in our application.
 *
 * TemplateEngine makes some assumptions about templating:
 *  1. A template is rendered via a string name
 *  2. A context array is passed into the template engine to render the template
 *  3. The templating engine returns a string
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
interface TemplateEngine
{
    /**
     * Render a template with a given context.
     *
     * @since   1.0
     * @access  public
     * @param   string $template
     * @param   array $ctx
     * @return  string
     */
    public function render($template, array $ctx=null);
}
