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
namespace Rock\Component\Container\Graph;
/**
 * IGraphReference 
 * 
 * @package 
 * @version $id$
 * @copyright 2011-2012 Yoshi Aoki
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license 
 */
interface IGraphReference
{
	/**
	 * getReferencedGraph 
	 * 
	 * @access public
	 * @return void
	 */
	function getReferencedGraph();
	/**
	 * setReferencedGraph 
	 * 
	 * @param IGraph $graph 
	 * @access public
	 * @return void
	 */
	function setReferencedGraph(IGraph $graph);

}
