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
namespace Rock\Component\Flow\Tests\Flow;
// @extend
use Rock\Component\Flow\Tests\BaseTestCase;
// @use Flow Component
use Rock\Component\Flow\Flow;
use Rock\Component\Flow\Graph\FlowGraph;
use Rock\Component\Flow\Graph\Vertex\State;
use Rock\Component\Flow\Type\BaseType;
use Rock\Component\Automaton\Graph\Edge\Condition;

// @use 
use Rock\Component\Flow\IO\IOutput;
use Rock\Component\Flow\IO\Input;
use Rock\Component\Flow\Directions;

/**
 *
 */
class FlowTest extends BaseTestCase
{
	public function testAutomaton()
	{
		// Create Automaton
		$flow = new Flow();
			
		$flow->setPath(new FlowGraph());

		$flow->getPath()->setEntry($first = new State('first'));
		$flow->getPath()->addState($second = new State('second'));

		$flow->getPath()->addCondition(new Condition($first, $second));

		$traversal = $flow->createTraversal();
		$traversal = $flow->forward($traversal);
	
		$trail  = $traversal->getTrail();
		$this->assertTrue(count($trail) === 1, 'Assert trail size one.');

		$this->assertTrue($trail->last()->current()->getName() === 'first', 'Assert Compare Trail last.');
		$this->assertTrue($trail->last()->current()->isEntryPoint(), 'Assert Entry point.');

		// 
		$traversal = $flow->forward($traversal);
		$this->assertTrue(count($trail) === 3, 'Assert trail size three.');
		$this->assertTrue($trail->last()->current()->getName() === 'second', 'Assert Compare Trail last.');

		// 
		$this->assertTrue($trail->last()->current()->isEndPoint(), 'Assert Endpoint');
	}

	public function testHandle()
	{
		$flow  = new Flow();
		$flow->setPath(new FlowGraph());

		$flow->getPath()->setEntry($first = new State('first'));
		$flow->getPath()->addState($second = new State('second'));
		$flow->getPath()->addCondition(new Condition($first, $second));

		$flow->handle(new Input(Directions::NEXT));
	}
}

