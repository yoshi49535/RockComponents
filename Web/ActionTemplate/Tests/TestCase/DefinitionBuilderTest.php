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
namespace Rock\Component\Web\ActionTemplate\Tests;
// @extend
use Rock\Component\Web\ActionTemplate\Tests\BaseTestCase;
// @use 
use Rock\Component\Web\ActionTemplate\Definition\Builder\GraphTreeBuilder;
use Rock\Component\Web\ActionTemplate\Definition\Builder\Node\Flow\FlowNode;
use Rock\Component\Configuration\Container\InjectionContainer;
/**
 *
 */
class DefinitionBuilderTest extends BaseTestCase
{
	public function testBuild()
	{
		$builder = new GraphTreeBuilder();

		$builder->root()
			->flow()
				->set('name', 'sample')
				->path()
					->state('first')
					->end()
				->end()
		;
		
		$definitions = $builder->build();

		$this->assertTrue(count($definitions) === 3, 'Assert Count Definition 3, but '.count($definitions));
	}

	public function testContainer()
	{
		$builder = new GraphTreeBuilder();

		$builder->root('sample')
			->flow()
				->set('name', 'sample')
				->path()
					->state('first')
					->end()
				->end()
		;
		
		$definitions = $builder->build();

		$container  = new InjectionContainer();

		$container->addDefinitions($definitions);

		$flow = $container->get('sample.flow');



		$this->assertTrue($flow instanceof \Rock\Component\Flow\IFlow, 'Assert Flow, but '.get_class($flow));
		$this->assertTrue($flow->getPath() instanceof \Rock\Component\Automaton\Path\IAutomatonPath, 'Assert Path , but '.get_class($flow->getPath()));

		$this->assertTrue($flow->getPath()->countStates() === 1, 'Assert State Count');
	}
}

