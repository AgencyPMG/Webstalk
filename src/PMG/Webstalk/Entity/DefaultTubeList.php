<?php
/**
 * This File is Part of Webstalk
 *
 * @since       1.0
 * @package     PMG\Webstalk
 * @copyright   2014 PMG <http://pmg.co>
 * @license     http://opensource.org/licenses/Apache-2.0 Apache-2.0
 */

namespace PMG\Webstalk\Entity;

/**
 * The default implementation of TubeList.
 *
 * @since   1.0
 * @author  Christopher Davis <chris@pmg.co>
 */
class DefaultTubeList implements TubeList
{
    /**
     * The list of tubes in $tube_name => Statistics pairs.
     *
     * @since   1.0
     * @access  private
     * @var     array
     */
    private $tubes;

    /**
     * constructor. Set up the tubes.
     *
     * @since   1.0
     * @access  public
     * @param   array $tubes
     * @return  void
     */
    public function __construct(array $tubes=array())
    {
        $this->tubes = $tubes;
    }

    /** Countable *************************************************************/

    public function count()
    {
        return count($this->tubes);
    }

    /** IteratorAggregate *****************************************************/

    public function getIterator()
    {
        return new \ArrayIterator($this->tubes);
    }
}
