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
namespace Rock\Component\Flow\Definition;

/**
 *
 */
interface IFlowComponentDefinition
{
	function getGraph();

	function setGraph(GraphDefinition $definition);
}
