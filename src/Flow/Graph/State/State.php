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
namespace Rock\Component\Flow\Graph\State;

// <Base>
use Rock\Component\Automaton\State\NamedState;
// <Use> : Graph
use Rock\Component\Container\Graph\IGraph;
//use Rock\Component\Flow\Graph\Graph as ExecutableGraph;
// <Use> : Flow IO
use Rock\Component\Flow\Input\IInput;
/**
 *
 */
class State extends NamedState
  implements 
    IState
{
	/**
	 * @var
	 */
	protected $handler;

	/**
	 *
	 */
	public function __construct(IGraph $graph, $name, $callable = null)
	{
		parent::__construct($graph, $name);
		
		if($callable)
			$this->setHandler($callable);
	}

	/**
	 *
	 */
	public function getFlow()
	{
		if(!($graph  = $this->getGraph()) instanceof IFlowPath)
			throw new \Exception('IFlowComponent holder has to be an IFlowPath');
		return $graph->getFlow();
	}

	/**
	 *
	 */
	public function setHandler($callable = null)
	{
		if($callable&& !is_callable($callable))
		{
			throw new \InvalidArgumentException('Listener has to be a callable or null.');
		}
		$this->handler = $callable;
	}

	/**
	 *
	 */
	public function handle(IInput $input)
	{
		if($this->handler)
		{
			if($this->handler instanceof IFlowStateDelegator)
			{
				$this->handler->delegate($this, $input);
			}
			else if(is_callable($this->handler))
			{
				call_user_func_array($this->handler, array($input));
			}
		}
	}

	/**
	 *
	 */
	public function __toString()
	{
		return sprintf('Graph Vertex[%s][name=%s] on %s', get_class($this), $this->getName(), $this->getGraph());
	}

}
