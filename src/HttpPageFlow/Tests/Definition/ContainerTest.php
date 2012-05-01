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
// @namespace
namespace Rock\Component\Flow\Tests\Definition;
// @extend
use Rock\Component\Flow\Tests\BaseTestCase;
// @use Definition
use Rock\Component\Flow\Definition\FlowContainer;
use Rock\Component\Flow\Definition\FlowDefinition;
use Rock\Component\Flow\Definition\StateDefinition;
// @use Flow Component
use Rock\Component\Flow\IFlow;

/**
 *
 */
class ContainerTest extends BaseTestCase
{
	public function testCreate()
	{
		$container  = new FlowContainer();
		// Create Automaton
		$definition = new FlowDefinition('flow');
		$container->addDefinition($definition);

		printf("Container : %s\n", get_class($definition->getContainer()));
		// 
		$state      = new StateDefinition('flow.step.first');
		$definition->addStateDefinition($state);

		$state      = new StateDefinition('flow.step.second');
		$definition->addStateDefinition($state);


		$flow       = $container->get('flow');

		$this->assertTrue($flow instanceof IFlow, 'IFlow Assertion');

		$this->assertTrue($flow->count() === 2, sprintf('Count is not 1[%d]', $flow->count()));

		$graph  = $flow->getPath();
		$this->assertTrue($graph->countVertices() === 2, sprintf('Count is not 1[%d]', $flow->count()));
		$this->assertTrue($graph->countEdges() === 1, sprintf('Count is not 1[%d]', $flow->count()));

		$edges   = $graph->getEdges();
		foreach($edges as $edge)
		{
			printf("Edge : %s\n", $edge);
		}


	}
}

