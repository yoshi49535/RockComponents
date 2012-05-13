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
// @interface
use Rock\Component\Automaton\Path\IAutomatonPath;
// @use Automaton Interface
use Rock\Component\Automaton\IAutomaton;
// @use Graph Vertex Interface
use Rock\Component\Container\Graph\Vertex\IVertex;
// @use Graph Edge
use Rock\Component\Automaton\Graph\Edge\Factory\ConditionFactory;
use Rock\Component\Container\Graph\Edge\Edge;
// @use Path Component Interface
use Rock\Component\Automaton\Path\State\IState;
use Rock\Component\Automaton\Path\Condition\ICondition;
// @use Exception
use Rock\Component\Automaton\Exception as AutomatonException;

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
  implements
    IAutomatonPath
{
	/**
	 * owner 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $owner;

	/**
	 * __construct 
	 * 
	 * @param IAutomaton $owner 
	 * @access public
	 * @return void
	 */
	public function __construct(IAutomaton $owner = null)
	{
		parent::__construct();
		$this->owner = $owner;
	}

	/**
	 * setOwner 
	 * 
	 * @param IAutomaton $owner 
	 * @access public
	 * @return void
	 */
	public function setOwner(IAutomaton $owner)
	{
		$this->owner  = $owner;
	}
	/**
	 * getOwner 
	 * 
	 * @access public
	 * @return void
	 */
	public function getOwner()
	{
		return $this->owner;
	}
	/**
	 *
	 */
	protected function initEdgeFactory()
	{
		$this->edgeFactory = new ConditionFactory();
	}


	/**
	 * addEntry 
	 * 
	 * @param IState $state 
	 * @access public
	 * @return void
	 */
	public function addEntry(IState $state)
	{
		$this->addVertex($state);
		if($state instanceof IState)
		{
			$state->asEntryPoint();
		}
		$this->addEdge(new Edge($this->getRoot(), $state));
	}
	
	/**
	 * addState 
	 * 
	 * @param IState $state 
	 * @access public
	 * @return void
	 */
	public function addState(IState $state)
	{
		if($this->countVertices() === 0)
		{
			$this->addEntry($state);
		}
		else
		{
			$this->addVertex($state);
		}
	}

	/**
	 * getState 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function getState($name)
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

	/**
	 * countStates 
	 * 
	 * @access public
	 * @return void
	 */
	public function countStates()
	{
		return $this->countVertices();
	}
	

	/**
	 * addCondition 
	 * 
	 * @param ICondition $condition 
	 * @access public
	 * @return void
	 */
	public function addCondition(ICondition $condition)
	{
		$this->addEdge($condition);
	}

	/**
	 * getEntryPoint 
	 * 
	 * @access public
	 * @return void
	 */
	public function getEntryPoint()
	{
		$states = $this->getEntryPoints();
		//
		if(count($states) == 0)
			throw new AutomatonException\InitializeException('Path dose not have any EntryPoint.');

		return $states[0];
	}

	/**
	 * getEntryPoints 
	 * 
	 * @access public
	 * @return void
	 */
	public function getEntryPoints()
	{
		$root = $this->getRoot();
		// Get edges form root 
		return $this->getOutboundVerticesOf($root);
	}
	/**
	 * getEndPoints
	 * 
	 * @access public
	 * @return void
	 */
	public function getEndPoints()
	{
		$endpoints  = array();
		$vertices = $this->getVertices();
		foreach($vertices as $vertex)
		{
			if((0 === $this->getOutDegreeOf($vertex)) || 
			   ($vertex->isEndPoint()))
			{
				$endpoints[]  = $vertex;
			}
		}
		return $endpoints;
	}

	/**
	 * getConditionsFrom 
	 * 
	 * @param IState $state 
	 * @access public
	 * @return void
	 */
	public function getConditionsFrom(IState $state)
	{
		return $this->getEdgesFrom($state);
	}

	/**
	 * getConditionsTo 
	 * 
	 * @param IState $state 
	 * @access public
	 * @return void
	 */
	public function getConditionsTo(IState $state)
	{
		return $this->getEdgesTo($state);
	}

}
