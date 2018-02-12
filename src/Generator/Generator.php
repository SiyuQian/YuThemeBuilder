<?php
namespace YuBuilder\Generator;

abstract class Generator implements \YuBuilder\Generator\GeneratorInterface
{
	protected $config;

	public function __construct($config)
	{
		$this->config = (object) $config;
		$this->configure();
	}
	// presistend copy rule applies
	public function copyFile() {
	}

	// different parser for different object
	// abstract public function parserTemplate();
}