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
// @use State
use Rock\Component\Automaton\Graph\Vertex\State;

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

		$entry = new State($automaton->getPath());
		$automaton->getPath()->addEntryVertex($entry);

		$traversal = $automaton->createTraversal();
		$traversal = $automaton->forward($traversal);
	
		$trail  = $traversal->getTrail();
		$this->assertTrue(count($trail) === 1, 'Assert trail size one.');

		$this->assertTrue($trail->last()->current() === $entry, 'Assert Compare Trail last.');

	}
}
