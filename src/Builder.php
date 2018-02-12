<?php
namespace YuBuilder;

use Symfony\Component\Yaml\Yaml;

final class Builder
{
	protected $config;

	public function __construct(string $configFile)
	{
		$this->config = Yaml::parseFile($configFile);
	}

	/**
	 * getConfig
	 * @return array
	 */
	public function getConfig()
	{
		return $this->config;
	}

	public function build()
	{
		// generate new template file based on origin files and configuration file
		// new theme.yaml
		$generator = new \YuBuilder\Generator\Adapter\YamlGenerator($this->getConfig());
		$generator->generate();

		// new cms pages

		// new partial pages
	}
}