<?php
/************************************************************************************
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
 ************************************************************************************/
namespace Rock\CompnentTests\Tests\Flow;

// <Use> : PHPUnit Test
use \PHPUnit_Framework_TestCase as TestCase;

// <Use> : GraphFlow
use Rock\Components\Flow\GraphFlow;
use Rock\Components\Flow\IFlow;
use Rock\Components\Flow\Path\IPath;

use Rock\Components\Flow\Builder\Builder as FlowBuilder;
use Rock\Components\Flow\Factory\Factory as FlowFactory;

use Rock\Components\Flow\Input\Input as FlowInput;
use Rock\Components\Flow\Input\ScalarInput as FlowScalarInput;

// 
class Test extends TestCase
{
  public function testFlow()
  {
	printf("\ntestFlow : \n");

	$flow  = $this->doBuildFlow();

	$flow  = $this->doInitFlow($flow);

	$result = $flow->handle(new FlowInput());

    printf("%s\n", $result);
	$trail  = $result->getState()->getTrail();
	printf("Size of Trail : %d\n", count($trail));
	foreach($trail as $component)
	{
		printf("%s\n", $component);
	}

	printf("-------------------------\n");

	// forward to second w/ prev executed state
	$result = $flow->handle(new FlowInput(), $result->getState());

    printf("%s\n", $result);
	$trail  = $result->getState()->getTrail();
	printf("Size of Trail : %d\n", count($trail));
	foreach($trail as $component)
	{
		printf("%s\n", $component);
	}

	printf("=====================\n");
  }
  public function testCondition()
  {
	printf("\ntestCondition: \n");

	$flow  = $this->doBuildFlow();
	$step  = $flow
	  ->setEntryPoint('first')
	  ->addNext('second', null, 'foo')
	;

	$input  = new FlowInput();
	printf("Input : %s\n", (string)$input);
	$result = $flow->handle($input);

    printf("%s\n", $result);
	$trail = $result->getState()->getTrail();
	printf("Size of Trail : %d\n", $trail->count());
	foreach($trail as $component)
	{
		printf("%s\n", $component);
	}

	printf("-------------------------\n");

	// forward to second w/ prev executed state
	$input  = new FlowScalarInput('bar');
	printf("Input : %s\n", (string)$input);
	$result = $flow->handle($input, $result->getState());

    printf("%s\n", $result);
	$trail  = $result->getState()->getTrail();
	printf("Size of Trail : %d\n", count($trail));
	foreach($trail as $component)
	{
		printf("%s\n", $component);
	}
	printf("-------------------------\n");

	$input  = new FlowScalarInput('foo');
	printf("Input : %s\n", (string)$input);
	// forward to second w/ prev executed state
	$result = $flow->handle($input, $result->getState());

    printf("%s\n", $result);
	$trail  = $result->getState()->getTrail();
	printf("Size of Trail : %d\n", count($trail));
	foreach($trail as $component)
	{
		printf("%s\n", $component);
	}
	printf("=====================\n");
  }
  /*
  public function testForwardTwo()
  {
	$flow  = $this->doBuildFlow();

	$flow  = $this->doInitFlow($flow);

	$result = $flow->handle(new FlowInput(FlowDirections::FORWARD, array('count' => 2)) );

    printf("%s\n", $result);
	$trail  = $result->getState()->getTrail();
	printf("Size of Trail : %d\n", count($trail));
	foreach($trail as $component)
	{
		printf("%s\n", $component);
	}
  }
  */
  public function testCreate()
  {
	$flow = new GraphFlow();

	$this->assertTrue($flow instanceof IFlow, 'Flow is not an instanceof IFlow');
	printf("=====================\n");
  }

  public function doBuildFlow()
  {
	$builder = new FlowBuilder(new FlowFactory());
	
	$builder->setFlowClass('\\Rock\\Components\\Flow\\GraphFlow');

	$flow    = $builder->build();
	$this->assertTrue($flow instanceof IFlow, 'Flow build assertion');

	return $flow;
  }
  protected function doInitFlow(IFlow $flow)
  {
	$flow
	  ->setEntryPoint('first')
	  ->addNext('second');

	$this->assertTrue($flow->getPath()->countSteps() == 2);
	return $flow;
  }
}
