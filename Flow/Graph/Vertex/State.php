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
use Rock\Component\Flow\Path\State\IState;

// <Use> : Graph
use Rock\Component\Container\Graph\IGraph;
//use Rock\Component\Flow\Graph\Graph as ExecutableGraph;
// <Use> : Flow IO
use Rock\Component\Flow\Traversal\IFlowTraversal;
// @use State Delegator Interface
use Rock\Component\Utility\Delegate\IDelegator;
use Rock\Component\Utility\Delegate\IDelegatorProvider;
// @use FlowPath Interface
use Rock\Component\Automaton\Path\IAutomatonPath;
// @use Exception
use Rock\Component\Flow;
use Rock\Component\Exception;

/*
 *
 */
class State extends NamedState
  implements 
    IState
{

	/**
	 * delegator 
	 * 
	 * @var IDelegator
	 * @access protected
	 */
	protected $delegator;

	/**
	 * getFlow 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFlow()
	{
		if(!($graph  = $this->getGraph()) instanceof IAutomatonPath)
			throw new \Exception(sprintf('Graph "%s" is not implemented IAutomatonPath.', get_class($graph)));
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
	public function addDelegatorWithProvider(IDelegatorProvider $provider, $params = array())
	{
		$this->addDelegator($provider->createDelegator($params));
	}

	public function setDelegator(IDelegator $delegator)
	{
		$this->delegator = $delegator;
	}
	/**
	 * addDelegator 
	 * 
	 * @param IDelegator $delegator 
	 * @access public
	 * @return void
	 */
	public function addDelegator(IDelegator $delegator)
	{
		if($this->delegator)
			$this->delegator = $this->delegator->merge($delegator);
		else
			$this->delegator = $delegator;
	}
	/**
	 * getDelegator 
	 * 
	 * @access public
	 * @return void
	 */
	public function getDelegator()
	{
		return $this->delegator;
	}

	/**
	 * handle 
	 * 
	 * @param IFlowTraversal $traversal 
	 * @access public
	 * @return void
	 */
	public function handle(IFlowTraversal $traversal)
	{
		$this->doHandle($traversal);
	}

	/**
	 * doHandle 
	 * 
	 * @param IFlowTraversal $traversal 
	 * @access protected
	 * @return void
	 */
	protected function doHandle(IFlowTraversal $traversal)
	{
		$flow = $this->getGraph()->getOwner();
		$comp = $flow->getAliasComponent($this->getName());

		try
		{
			if($this->delegator && ($this->delegator instanceof IDelegator))
				$this->delegator->delegate(array($traversal), $this);
		}
		catch(Exception\NotImplementedException $ex)
		{
			throw new Flow\Exception\InitializeException(sprintf(
					"Delegate on State \"%s\" is ambiguous.\n".
					"Set @WATDelegate(\"%s\", provider=\"ProviderAlias\", method={\"onFoo\", \"onBar\"}).", 
					$this->getName(),
					$this->getName()
				), 0, $ex);
		}
	}

	/**
	 * __toString 
	 * 
	 * @access public
	 * @return void
	 */
	public function __toString()
	{
		return $this->getName();
	}
}
