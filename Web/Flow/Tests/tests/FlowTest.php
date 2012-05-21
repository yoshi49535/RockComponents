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
namespace Rock\Component\Web\Flow\Tests;
// @extend
use Rock\Component\Web\Flow\Tests\BaseTestCase;
// @use Flow Component
use Rock\Component\Web\Flow\HttpFlow;
use Rock\Component\Flow\Graph\FlowGraph;
use Rock\Component\Flow\Graph\Vertex\State;
use Rock\Component\Web\Flow\Graph\Vertex\Page;
use Rock\Component\Flow\Type\GraphFlowType;
use Rock\Component\Flow\Graph\Edge\Condition;

// @use 
use Rock\Component\Flow\IO\IOutput;
use Rock\Component\Web\Flow\IO\Input;
use Rock\Component\Flow\Directions;

// @use Test Components
use Rock\Component\Web\Flow\Tests\SessionManager\SessionManager as TestSessionManager;
use Rock\Component\Web\Session\Session;

/**
 *
 */
class FlowTest extends BaseTestCase
{
	public function testForward()
	{
		// Create Automaton
		$flow = new HttpFlow();
		$flow->setName('dammy');
		$flow->setSession($this->createSession());
			
		$flow->setPath(new FlowGraph());

		$flow->getPath()->setEntry($first = new Page('first'));
		$flow->getPath()->addState($second = new State('second'));
		$flow->getPath()->addState($third = new Page('third'));

		$flow->getPath()->addCondition(new Condition($first, $second));
		$flow->getPath()->addCondition(new Condition($second, $third));

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
		$traversal = $flow->forward($traversal);
		$this->assertTrue($trail->last()->current()->getName() === 'third', 'Assert Compare Trail last.');
		$this->assertTrue($trail->last()->current()->isEndPoint(), 'Assert Endpoint');
	}

	public function testHandle()
	{
		// Create Automaton
		$flow = new HttpFlow();
		$flow->setName('dammy');

		$session = $this->createSession();
		$flow->setSession($session);
			
		$flow->setPath(new FlowGraph());

		$flow->getPath()->setEntry($first = new Page('first'));
		$flow->getPath()->addState($second = new State('second'));
		$flow->getPath()->addState($third = new Page('third'));

		$flow->getPath()->addCondition(new Condition($first, $second));
		$flow->getPath()->addCondition(new Condition($second, $third));


		$output = $flow->handle(new Input(Directions::NEXT));
		$this->assertTrue(!is_null($output), 'Assert Output is returned');

		$current = $current = $output->getTrail()->last()->current();
		$this->assertTrue($current->getName() === 'first', 'Assert Compare Trail Last, but '.$current->getName());

		// Session Assert
		$this->assertTrue($session->has('trail'),'Assert Session Trail'); 
		$this->assertTrue(count($session->get('trail')) === 1,'Assert Session Trail'); 

		// 
		$output = $flow->handle(new Input(DIrections::NEXT));

		$current = $output->getTrail()->last()->current();
		$this->assertTrue($current->getName() === 'third', 'Assert Compare Trail Last, but '.$current->getName());
	}

	protected function createSession()
	{
		$session = new Session();
		$manager = new TestSessionManager();

		$manager->set('test.flow', $session);
		return $session;
	}
}

