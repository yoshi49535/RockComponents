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
use Rock\Component\Configuration\Definition\Provider\IDefinitionProvider;
use Rock\Component\Configuration\Aware\IContainerAware;
use Rock\Component\Configuration\Definition\Builder\Tree\ITreeBuilder;

use Rock\Component\Web\ActionTemplate\Definition\Builder\GraphTreeBuilder;
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
    IDefinitionProvider
{
	protected $definitions;
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
	 * createPathBuilder 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function createPathBuilder()
	{
		return new GraphTreeBuilder();
	}
	/**
	 * configure 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function configure()
	{
		try
		{
			$pathBuilder     = $this->createPathBuilder();
			$definitions     = $this->configurePath($pathBuilder);
		
			$this->definitions = $pathBuilder->build();

		}
		catch(\Exception $ex)
		{
			throw new \Exception(sprintf('Failed to construct path for Type "%s".', get_class($this)), 0, $ex);
		}
	}

	/**
	 * configurePath 
	 * 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function configurePath(ITreeBuilder $tree);

	public function getDefinitions()
	{
		return $this->definitions;
	}

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
