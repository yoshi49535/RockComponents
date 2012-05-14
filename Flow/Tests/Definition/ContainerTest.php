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
namespace Rock\Component\Flow\Tests\Definition;
// @extend
use Rock\Component\Flow\Tests\BaseTestCase;
// @use Definition
use Rock\Component\Configuration\Definition\Container;
use Rock\Component\Flow\Definition\FlowDefinition;
use Rock\Component\Flow\Definition\Graph\Component\StateDefinition;
// @use Flow Component
use Rock\Component\Flow\IFlow;

/**
 * ContainerTest 
 * 
 * @uses BaseTestCase
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class ContainerTest extends BaseTestCase
{
	public function testCreate()
	{
		$container  = new Container();
		// Create Automaton
		$definition = new FlowDefinition('flow');
		$container->addDefinition($definition);

		// 
		$state      = new StateDefinition('flow.step.first');
		$definition->addStateDefinition($state);

		$state      = new StateDefinition('flow.step.second');
		$definition->addStateDefinition($state);

		$flow       = $container->get('flow');

		$this->assertTrue($flow instanceof IFlow, 'IFlow Assertion');

		$this->assertTrue($flow->getPath()->countStates() === 2, sprintf('Count is not 2, but %d', $flow->getPath()->countStates()));

		$graph  = $flow->getPath();
		$this->assertTrue($graph->countVertices() === 2, sprintf('Count is not 1[%d]', $flow->count()));
		$this->assertTrue($graph->countEdges() === 1, sprintf('Count is not 1[%d]', $flow->count()));

		$edges   = $graph->getEdges();

		
	}
}

