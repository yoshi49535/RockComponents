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
 *  This file is part of the $project$ package.
 *
 *  Copyright (c) 2009, 44services.jp. Inc. All rights reserved.
 *  For the full copyright and license information, please read LICENSE file
 *  that was distributed w/ source code.
 *
 *  Contact Us : Yoshi Aoki <yoshi@44services.jp>
 *
 ************************************************************************************/

namespace Rock\Component\Flow\Factory;

use Rock\Component\Flow\Factory\Factory as FlowFactory;
use Rock\Component\Flow\IFlow;

class TemplateFactory extends FlowFactory
{
	protected $templates = array();
	/**
	 *
	 */
	public function __construct()
	{
		$this->templates  = array();

		parent::__construct();
	}

	/**
	 *
	 */
	protected function init()
	{
		// initialize templates 
	}
	/**
	 *
	 */
	public function addTemplate($name, $class)
	{
		$this->templates[strtolower($name)]  = $class;
	}
	/**
	 *
	 */
	public function addTemplates(array $templates)
	{
		foreach($templates as $name =>  $template)
		{
			$this->templates[strtolower($name)] = $template;
		}
	}

	/**
	 *
	 */
	public function getTemplates()
	{
		return $this->templates;
	}
	/**
	 *
	 */
	public function getTemplate($name)
	{
		return isset($this->templates[strtolower($name)]) ? $this->templates[strtolower($name)] : $name;
	}
	/**
	 *
	 */
	public function create($name)
	{
		$flow      = null;
		$template  = $this->getTemplate($name);

		if(!class_exists($template))
		{
			throw new \InvalidArgumentException(sprintf(
				'Flow template "%s" is not a registed template or class not exists.',
				$template
			));
		}
		
		return parent::create($template);
	}
}
