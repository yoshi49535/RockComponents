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

class TreeBuilder
  implements
    IDefinitionBuilder
{
	/**
	 * children:w

	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $children;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->root  = new Node();
	}

	/**
	 * build 
	 *   Build for Root
	 * @final
	 * @access public
	 * @return void
	 */
	public function build($itr = null)
	{
		$definitions = array();

		if($itr === null)
		{
			// 
			$itr  = new ArrayIterator($this->root()->getChildren());
		}

		$definitions = array();
		while($itr->next())
		{
			$itr->current()->validate();
			$definitions  = $this->doBuild($itr);
		}

		return $definitions;
	}
	protected function doBuild($itr)
	{
		// For Root Builder just LookUp for Specified Builder 
		$builder     = $this->getSupportedBuilder($itr->current());
		$definitions = $builder->build($itr);

		return $definitions;
	}

	protected function getSupportedBuilder($node)
	{
		if($this->isSupport($node))
			return $this;
		else
			foreach($this->children as $child)
				if($child->isSupport($node))
					return $child;

		throw new \Exception('Not Supported');
	}

	public function addChild(IDefinitionBuilder $builder)
	{
		$this->children[] = $builder;
	}

	public function isSupport()
	{
	}
}
