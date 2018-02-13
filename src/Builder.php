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
		$config = $this->getConfig();
		// generate new template file based on origin files and configuration file
		// new theme.yaml
		$yaml = new \YuBuilder\Generator\Adapter\YamlGenerator($config);
		$yaml->generate();

		// new cms pages
		$cms = new \YuBuilder\Generator\Adapter\CmsGenerator($config);
		$cms->generate();

		// new layout pages
		$layout = new \YuBuilder\Generator\Adapter\LayoutGenerator($config);
		$layout->generate();

		// new partial pages
		$partial = new \YuBuilder\Generator\Adapter\PartialGenerator($config);
		$partial->generate();
	}
}