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
namespace Rock\Component\Container\Tree\Node\Factory;
use Rock\Component\Container\Tree\ITree;
use Rock\Component\Container\Tree\Node\INode;

class NodeFactory
{
	private $defaultParams;
	private $tree;
	private $types;
	/**
	 * __construct 
	 * 
	 * @param ITree $tree 
	 * @access public
	 * @return void
	 */
	public function __construct(ITree $tree)
	{
		$this->defaultParams = array();
		$this->tree = $tree;

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
		$this->add('default', '\\Rock\\Component\\Container\\Tree\\Node\\Node');
		$this->add('named', '\\Rock\\Component\\Container\\Tree\\Node\\NamedNode');
		$this->add('scalar', '\\Rock\\Component\\Container\\Tree\\Node\\ScalarNode');
	}
	/**
	 * create 
	 * 
	 * @param string $type 
	 * @access public
	 * @return void
	 */
	public function create($type = 'default', array $params = array())
	{
		if(!$this->has($type))
			throw new \InvalidArgumentException(sprintf('Node Type "%s" is not registed on NodeFactory.', $type));

		$class = $this->get($type);

		$params = array_merge($this->getDefaultParams($type), $params);
		$node   = new $class($this->getTree());

		$node->setParameters($params);
		return $node;
	}

	/**
	 * add 
	 * 
	 * @param mixed $type 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function add($type, $class, array $defaults = array())
	{
		$this->types[$type]  = $class;
		$this->defaultParams[$type] = $defaults;
	}

	/**
	 * has 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function has($type)
	{
		return array_key_exists($type, $this->types);
	}

	/**
	 * get 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function get($type)
	{
		return $this->types[$type];
	}

	public function getDefaultParams($type)
	{
		return array_key_exists($type, $this->defaultParams) ? $this->defaultParams[$type] : array();
	}

	public function setDefaultParams(array $defaults)
	{
		$this->defaultParams[$type]  = $defaults;
	}
	
	public function getTree()
	{
		return $this->tree;
	}
}
