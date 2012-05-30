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
namespace Rock\Component\Web\Page;
use Rock\Component\Web\Page\IPage;

use Rock\Component\Utility\ParameterBagContainer;

/**
 * ProxyPage 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
class ProxyPage extends ParameterBagContainer
  implements
    IProxyPage
{
	private $reference;


	/**
	 * __construct
	 * 
	 * @param IPage $page 
	 * @access public
	 * @return void
	 */
	public function __construct(IPage $page, $params = array())
	{
		$this->reference = $page;

		parent::__construct($params);
	}

	/**
	 * getReferenced 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getReferenced()
	{
		return $this->reference;
	}

	/**
	 * getUrl 
	 * 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	public function getUrl(array $params = array())
	{
		return $this->getReferenced()->getUrl($params);
	}

	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	public function getName() 
	{
		return $this->getReferenced()->getName();
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
		// none
		throw new \Exception('Proxy is Protected to execute Page::handle method.');
	}

	/**
	 * createProxy 
	 * 
	 * @access public
	 * @return void
	 */
	public function createProxy(array $params = array())
	{
		return $this;
	}
}
