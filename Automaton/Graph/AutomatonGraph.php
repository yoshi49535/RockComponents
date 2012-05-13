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
// @namesapce
namespace Rock\Component\Automaton\Graph;
// @extends
use Rock\Component\Container\Graph\DirectedGraph;
// @use Graph Vertex Interface
use Rock\Component\Container\Graph\Vertex\IVertex;
// @use Graph Edge
use Rock\Component\Automaton\Graph\Edge\Factory\ConditionFactory;
use Rock\Component\Container\Graph\Edge\Edge;

/**
 * AutomatonGraph 
 * 
 * @uses DirectedGraph
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class AutomatonGraph extends DirectedGraph
{
	/**
	 *
	 */
	protected function initEdgeFactory()
	{
		$this->edgeFactory = new ConditionFactory();
	}


	public function addEntryVertex(IVertex $vertex)
	{
		$this->addVertex($vertex);
		if($vertex instanceof IState)
		{
			$vertex->asEntryPoint();
		}
		$this->addEdge(new Edge($this->getRoot(), $vertex));
	}
	
	/**
	 * addVertex 
	 * 
	 * @override 
	 * @param IVertex $vertex 
	 * @access public
	 * @return void
	 */
	public function addVertex(IVertex $vertex)
	{
		if($this->countVertices() === 0)
		{
			$vertex->isEntryPoint(true);
		}
		parent::addVertex($vertex);
	}
	/**
	 *
	 */
	public function getVertexByName($name)
	{
		$ret  = null;
		//
		foreach($this->getVertices() as $vertex)
		{
			if($name === $vertex->getName())
			{
				$ret = $vertex;
				break;
			}
		}

		return $ret;
	}
}
