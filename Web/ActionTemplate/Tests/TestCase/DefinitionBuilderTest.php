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
use Rock\Component\Web\ActionTemplate\Definition\Builder\TreeBuilder;
use Rock\Component\Web\ActionTemplate\Definition\Builder\Node\Flow\FlowNode;
/**
 *
 */
class DefinitionBuilderTest extends BaseTestCase
{
	public function testBuild()
	{
		$builder = new TreeBuilder();

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
}

