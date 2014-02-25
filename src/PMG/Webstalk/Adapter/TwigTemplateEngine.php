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

use PMG\Webstalk\Exception\TemplateException;

/**
 * A TemplateEngine implementation that uses twig.
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
class TwigTemplateEngine implements TemplateEngine
{
    /**
     * The twig environment.
     *
     * @since   1.0
     * @access  private
     * @var     Twig_Environment
     */
    private $twig;

    /**
     * Constructor. Set up twig.
     *
     * @since   1.0
     * @access  public
     * @param   Twig_Environment $twig
     * @return  void
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * {@inheritdoc}
     */
    public function render($template, array $ctx=null)
    {
        try {
            return $this->twig->render($template, $ctx ?: array());
        } catch (\Exception $e) {
            throw new TemplateException(sprintf(
                'Could not render template %s: %s',
                $template,
                $e->getMessage()
            ));
        }
    }
}
