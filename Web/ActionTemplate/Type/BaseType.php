<?php
/****
 *
 * Description:
 *      
 * 
 * $Date$
 * Rev    : see git
 * Author : Yoshi Aoki <yoshi@44services.jp>
 * 
 *  This file is part of the Rock package.
 *
 * For the full copyright and license information, 
 * please read the LICENSE file that is distributed with the source code.
 *
 ****/
// @namespace
namespace Rock\Component\Web\ActionTemplate\Type;
// @use Container Interface
use Rock\Component\Configuration\Definition\IContainer;

/**
 * BaseType 
 *   Type is a Set of ActionTemplate Definition.
 *   
 * @abstract
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
abstract class BaseType
  implements
    IContainerAware
{
	/**
	 * __construct 
	 * 
	 * @param mixed $id 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->configure();
	}

	/**
	 * configure 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function configure()
	{
		$pathBuilder     = $this->createPathTreeBuilder()
		$definitions     = $this->configurePath($pathBuilder);

		// Add All Definitions
		$this->getContainer()->addDefinitions($pathBuilder->getDefinitions());
	}

	/**
	 * configurePath 
	 * 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function configurePath()

	/**
	 * __toString 
	 * 
	 * @access public
	 * @return void
	 */
	public function __toString()
	{
		return get_class($this);
	}
}
