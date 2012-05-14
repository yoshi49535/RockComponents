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

// <Namspace>
namespace Rock\Component\Automaton\Tests;
// <Base>
use \PHPUnit_Framework_TestCase as TestCase;
// <Use> : Automaton
use Rock\Component\Automaton\FiniteAutomaton;
use Rock\Component\Automaton\Graph\AutomatonGraph;
// @use GraphPath Component
use Rock\Component\Automaton\Graph\Vertex\NamedState;
use Rock\Component\Automaton\Graph\Edge\Condition;

/**
 *
 */
class AutomatonTest extends TestCase
{
	public function testAutomaton()
	{
		// Create Automaton
		$automaton = new FiniteAutomaton();
			
		$automaton->setPath(new AutomatonGraph());

		$automaton->getPath()->setEntry($first = new NamedState('first'));
		$automaton->getPath()->addState($second = new NamedState('second'));

		$automaton->getPath()->addCondition(new Condition($first, $second));

		$traversal = $automaton->createTraversal();
		$traversal = $automaton->forward($traversal);
	
		$trail  = $traversal->getTrail();
		$this->assertTrue(count($trail) === 1, 'Assert trail size one.');

		$this->assertTrue($trail->last()->current()->getName() === 'first', 'Assert Compare Trail last.');
		$this->assertTrue($trail->last()->current()->isEntryPoint(), 'Assert Entry point.');

		// 
		$traversal = $automaton->forward($traversal);
		$this->assertTrue(count($trail) === 3, 'Assert trail size three.');
		$this->assertTrue($trail->last()->current()->getName() === 'second', 'Assert Compare Trail last.');

		// 
		$this->assertTrue($trail->last()->current()->isEndPoint(), 'Assert Endpoint');
	}
}
