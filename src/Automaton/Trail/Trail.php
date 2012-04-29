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
namespace Rock\Component\Automaton\Trail;
// @base
use Rock\Component\Container\Graph\Path\Path as GraphPath;
// @use Interfaces
use Rock\Component\Container\Graph\IGraph;
use Rock\Component\Automaton\IAutomaton;


/**
 *
 */
class Trail extends GraphPath
{
	public function __construct(IGraph $graph)
	{
		parent::__construct($graph);

		// Additional Validator
		if(!$graph instanceof IAutomaton)
		{
			throw new \InvalidArgumentException(sprintf('Graph has to be an instance fo IAutomaton, but "%s" given.', get_class($graph)));
		}
	}
	
	public function unpack(array $data = array())
	{
		try
		{
			parent::unpack($data);
		}
		catch(\Exception $ex)
		{
			if($this->getGraph()->isHandleException())
				throw $ex;

			// Otherwise, initialize component as empty
			$this->components = array();
		}
	}
}
