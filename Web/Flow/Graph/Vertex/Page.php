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
namespace Rock\Component\Web\Flow\Graph\Vertex;
// @extends 
use Rock\Component\Flow\Graph\Vertex\State;
// @interface
use Rock\Component\Web\Page\IPage;
// @use Flow Traversal
use Rock\Component\Flow\Traversal\IFlowTraversal;

/**
 * Page 
 * 
 * @uses State
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class Page extends State
  implements
    IPage
{
	/**
	 * getUrl 
	 * 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	public function getUrl(array $params = array())
	{
		return '#';
	}

	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	public function getName()
	{
		return parent::getName();
	}

	/**
	 * handle 
	 * 
	 * @param IFlowTraversal $traversal 
	 * @access public
	 * @return void
	 */
	public function handle(IFlowTraversal $traversal)
	{
		$input = $traversal->getInput();
		// Use Redirect or not
		if($input->useRedirection() && ($input->getRequestedDirection() !== null))
		{
			$output  = $traversal->getOutput();
			$output->setRedirectTo($this);
		}
		else
		{
			parent::handle($traversal);
		}
	}
}
