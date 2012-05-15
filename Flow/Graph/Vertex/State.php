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

// <Namespace>
namespace Rock\Component\Flow\Graph\Vertex;
// <Base>
use Rock\Component\Automaton\Graph\Vertex\NamedState;
// @interface
use Rock\Component\Automaton\Path\State\IState;

// <Use> : Graph
use Rock\Component\Container\Graph\IGraph;
//use Rock\Component\Flow\Graph\Graph as ExecutableGraph;
// <Use> : Flow IO
use Rock\Component\Flow\Input\IInput;
// @use State Delegator Interface
use Rock\Component\Utility\Delegate\Delegate;
use Rock\Component\Utility\Delegate\IDelegator;
// @use FlowPath Interface
use Rock\Component\Automaton\IAutomatonPath;

/**
 *
 */
class State extends NamedState
  implements 
    IState
{

	/**
	 * delegate 
	 * 
	 * @var Delegate
	 * @access protected
	 */
	protected $delegate;

	/**
	 * __construct 
	 * 
	 * @param IGraph $graph 
	 * @param mixed $name 
	 * @param mixed $delegate
	 * @access public
	 * @return void
	 */
	public function __construct($name, Delegate $delegate = null)
	{
		parent::__construct($name);
		
		// Delegate as DelegatorContainer
		//$this->doHandle = new Delegate($this);
		//if($handler)
		//	$this->doHandle->setDelagator($handler);
		$this->delegate = $delegate;
	}

	/**
	 * getFlow 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFlow()
	{
		if(!($graph  = $this->getGraph()) instanceof IAutomatonPath)
			throw new \Exception('Graph is not FlowPath');
		return $graph->getOwner();
	}

	/**
	 * setHandler 
	 * 
	 * @param mixed $object 
	 * @param mixed $method 
	 * @access public
	 * @return void
	 */
	public function setHandler(Delegate $delegate)
	{
		$this->delegate = $delegate;
	}

	/**
	 * handle 
	 * 
	 * @param IInput $input 
	 * @access public
	 * @return void
	 */
	public function handle(IInput $input)
	{
		$ret  = null;
		// Call Flow Delegate 
		if($delegator = $this->delegate)
		{
			$ret = $this->getFlow()->callDelegate('doStateInit', array($input));
		}

		return $ret;
	}

	/**
	 * __toString 
	 * 
	 * @access public
	 * @return void
	 */
	public function __toString()
	{
		return sprintf('Graph Vertex[%s][name=%s] on %s', get_class($this), $this->getName(), $this->getGraph());
	}
}
