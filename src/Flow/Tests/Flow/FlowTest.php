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
namespace Rock\Component\Flow\Tests\Flow;
// @extend
use Rock\Component\Flow\Tests\BaseTestCase;
// @use Definition
use Rock\Component\Flow\Definition\FlowContainer;
use Rock\Component\Flow\Definition\FlowDefinition;
use Rock\Component\Flow\Definition\StateDefinition;
// @use Flow Component
use Rock\Component\Flow\IFlow;
use Rock\Component\Flow\Type\BaseType;

// @use 
use Rock\Component\Flow\Output\IOutput;
use Rock\Component\Flow\Input\Input;
use Rock\Component\Flow\Directions;

class TestType extends BaseType
{
	/**
	 * Configurate composite Definitions
	 */
	protected function configure()
	{
		$this
			->addState('first')
			->addState('second')
			->addState('third')
		;
	}
}

/**
 *
 */
class FlowTest extends BaseTestCase
{
	public function testHandle()
	{
		$container  = new FlowContainer();
		$container->addDefinition(new TestType('flow.test'));

		$flow       = $container->get('flow.test');

		$output  = $flow->handle(new Input(Directions::NEXT));

		$this->assertTrue($output instanceof IOutput, 'Assert Output Instance');

		$this->assertTrue($output->getTrail()->last()->current()->getName() === 'first', 'Assert State First');


		$output  = $flow->handle(new Input(Directions::NEXT), $output->getTraversal());
		$this->assertTrue($output instanceof IOutput, 'Assert Output Instance');


		$this->assertTrue($output->getTraversal()->getTrail()->count() === 3, sprintf('Assert Traversal Trail count is 3, but %d', $output->getTraversal()->getTrail()->count()));
		$this->assertTrue($output->getTrail()->last()->current()->getName() === 'second', 'Assert State Second');
	}
}

