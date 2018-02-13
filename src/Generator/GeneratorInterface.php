<?php
namespace YuBuilder\Generator;

interface GeneratorInterface
{
	/**
	 * parserTemplate
	 * @return [type]
	 */
	// public function parserTemplate();

	/**
	 * generate
	 * @return [type]
	 */
	public function generate();

	/**
	 * configure
	 * @return [type]
	 */
	public function configure();
}