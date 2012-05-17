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
// <Namspace>
namespace Rock\Component\Container\Tests\TestCase;
// <Base>
use \PHPUnit_Framework_TestCase as TestCase;
// <Use> : Automaton
use Rock\Component\Container\Tree\Tree;
use Rock\Component\Container\Tree\Node\ScalarNode;

/**
 *
 */
class TreeTest extends TestCase
{
	public function testTree()
	{
		$tree = new Tree();
		$tree->root()->add($first = new ScalarNode('a'));
		$tree->root()->add($second = new ScalarNode('b'));
		
		$second->add(new ScalarNode('c'));
		
		$this->assertTrue(2 === ($count = $tree->root()->countChildren()), 'Assert Count, but '.$count);
		
		$itr  = $tree->getIterator();

		$this->assertTrue($itr->current()->getScalar() === 'a', 'Assert a');

		$itr->next();
		$this->assertTrue($itr->current()->getScalar() === 'b', 'Assert b');

		$sItr  = $itr->getChildIterator();
		$this->assertTrue($sItr->current()->getScalar() === 'c', 'Assert c');
	}
}
