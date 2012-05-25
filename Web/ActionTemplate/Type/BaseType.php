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

// @
use Rock\Component\Configuration\Container\IContainer;
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
	/**
	 * container 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $container;

	/**
	 * definitions 
	 * 
	 * @var mixed
	 * @access protected
	 */
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
		$definition = null;
	}
	
	/**
	 * createPathBuilder 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function createPathBuilder()
	{
		return new GraphTreeBuilder($this->getContainer());
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

	/**
	 * getDefinitions 
	 * 
	 * @access public
	 * @return void
	 */
	public function getDefinitions()
	{
		if(null === $this->definitions)
			$this->configure();

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

	/**
	 * setContainer 
	 * 
	 * @param IContainer $container 
	 * @access public
	 * @return void
	 */
	public function setContainer(IContainer $container)
	{
		$this->container = $container;
	}
	/**
	 * getContainer 
	 * 
	 * @access public
	 * @return void
	 */
	public function getContainer()
	{
		if(!$this->container)
			throw new \Exception('Container is not initialized.');
		return $this->container;
	}
}
