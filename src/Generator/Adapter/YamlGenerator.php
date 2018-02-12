<?php
namespace YuBuilder\Generator\Adapter;

use YuBuilder\Generator\Generator;
use Symfony\Component\Yaml\Yaml;

class YamlGenerator extends Generator
{
	protected $theme = [];

	protected $output = [];

	protected $requiredKeys = [
		'name',
		'author',
		'homepage',
		'description',
		'code'
	];

	public function configure()
	{
		if (isset($this->config->theme)) {
			$this->checkRequiredKeys($this->config->theme);
		}
		$this->theme = $this->config->theme;
		$this->output = $this->config->output['directory'];
	}

	private function checkRequiredKeys(array $theme)
	{
		// check if all keys exist
		foreach ($this->requiredKeys as $key) {
			if (!array_key_exists($key, $theme)) {
				// todo: move logger into exception class
				$message = __CLASS__ . '->' . __FUNCTION__ . ': does not contain all the required keys. Missing: ' . $key;
				logger($message);
				throw new \Exception($message);
			}
		}
		// check if all keys has value
	}

	public function generate()
	{
		$filename = $this->output . '/theme.yaml';
		$yaml = Yaml::dump($this->theme);
		file_put_contents($filename, $yaml);
	}
}