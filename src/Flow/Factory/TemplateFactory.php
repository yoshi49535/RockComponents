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

namespace Rock\Components\Flow\Factory;

use Rock\Components\Flow\Factory\Factory as FlowFactory;
use Rock\Components\Flow\IFlow;

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
	/**
	 *
	 */
	public function addTemplate(string $name, string $class)
	{
		$this->templates[$name]  = $class;
	}
	/**
	 *
	 */
	public function addTemplates(array $templates)
	{
		$this->templates  = array_merge($this->templates, $templates);
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
		return isset($this->templates[$name]) ? $this->templates[$name] : $name;
	}
}
