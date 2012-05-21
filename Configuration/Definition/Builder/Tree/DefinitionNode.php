<?php
/****
 *
 * Description:
 *      
 * $Id$
 * $Date$
 * $Rev$
 * $Author$
 * 
 *  This file is part of the $Project$ package.
 *
 * $Copyrights$
 *
 ****/
// @namespace
namespace Rock\Component\Configuration\Definition\Builder\Tree;
//
use Rock\Component\Container\Tree\Node\NamedNode as BaseNode;
// @use 
use Rock\Component\Utility\Bag\ParameterBag;
// @use Tree Interface
use Rock\Component\Container\Tree\Itree;
// @use DefinitionBuilder Interface
use Rock\Component\Configuration\Definition\Builder\IDefinitionBuilder;
use Rock\Component\Configuration\Component\Reference;


/**
 * Node 
 * 
 * @uses BaseNode
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class DefinitionNode extends BaseNode
  implements
    IDefinitionNode
{
	/**
	 * params 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $params;

	/**
	 * definition 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $definition;

	/**
	 * reference 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $reference;
	/**
	 * __construct 
	 * 
	 * @param mixed $parent 
	 * @access public
	 * @return void
	 */
	public function __construct(ITree $tree, $name, $params = array())
	{
		parent::__construct($tree, $name);
		$this->params = new ParameterBag(array_merge(array('name'=>$name), $params));

		$this->init();
	}

	/**
	 * init 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function init()
	{
	}
	
	/**
	 * setParameter 
	 * 
	 * @param mixed $name 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function setParameter($name, $value)
	{
		$this->params->set($name, $value);
	}

	/**
	 * hasParameter 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function hasParameter($name)
	{
		return $this->params->has($name);
	}

	/**
	 * getParameter 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function getParameter($name)
	{
		return $this->params->get($name);
	}
	/**
	 * getParameterBag 
	 * 
	 * @access public
	 * @return void
	 */
	public function getParameterBag()
	{
		return $this->params;
	}

	/**
	 * set 
	 *   Alias of setParameter for Method Chain
	 * @param mixed $name 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($name, $value)
	{
		$this->setParameter($name, $value);

		return $this;
	}

	/**
	 * alias 
	 * 
	 * @param mixed $alias 
	 * @access public
	 * @return void
	 */
	public function alias($alias)
	{
		$this->setParameter('alias', $alias);
		return $this;
	}
	/**
	 * getBuilder 
	 * 
	 * @access public
	 * @return void
	 */
	public function getBuilder()
	{
		$tree = $this->getTree();
		if(!$tree instanceof IDefinitionBuilder)
			throw new \Exception(sprintf('Tree has to be an IDefinitionBuilder to build this definition, but class "%s" is given.', get_class($tree)));
		return $tree;
	}
	/**
	 * build 
	 * 
	 * @access public
	 * @return void
	 */
	public function getDefinition()
	{
		if(!$this->definition)
		{
			$builder = $this->getBuilder();

			$this->definition = $builder->buildDefinition($this);
			$this->reference  = $this->definition->getReference();
		}

		return $this->definition;
	}

	/**
	 * getReference 
	 * 
	 * @access public
	 * @return void
	 */
	public function getReference()
	{
		if(!$this->reference)
		{
			$this->reference = new Reference($this->generateId());
		}
		return $this->reference;
	}

	/**
	 * generateId 
	 * 	 combine Names from Root to this with dot.
	 * @access public
	 * @return void
	 */
	public function generateId()
	{
		$path  = $this->getPathFromRoot();
		$cmp   = array();
		foreach($path as $node)
		{
			$tmp = $node->getName();
			if($tmp && !empty($tmp))
				$cmp[] = $tmp;
		}

		if(0 === count($cmp))
			throw new \Exception('Cannot generate ID w/ none names.');

		return implode('.', $cmp);
	}

	/**
	 * validate 
	 * 
	 * @access public
	 * @return void
	 */
	public function validate()
	{
		
	}
}
