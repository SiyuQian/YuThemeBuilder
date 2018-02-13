<?php
namespace YuBuilder\Generator\Adapter;

class YamlGenerator extends \YuBuilder\Generator\Generator
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
	}

	private function checkRequiredKeys(array $theme)
	{
		// check if all keys exist
		foreach ($this->requiredKeys as $key) {
			if (!array_key_exists($key, $theme)) {
				// todo: move logger into exception class
				$message = __CLASS__ . '->' . __FUNCTION__ . ': does not contain all the required keys. Missing: ' . $key;
				trace_log($message);
				throw new \Exception($message);
			}
		}
		// check if all keys has value
	}

	public function generate()
	{
		$filename = $this->config->output['directory'] . $this->config->output['name'] . '/theme.yaml';
		if (!file_exists(dirname($filename))) {
            mkdir(dirname($filename), 0777, true);
        }
		$yaml = \Symfony\Component\Yaml\Yaml::dump($this->theme);
		file_put_contents($filename, $yaml);
		trace_log($filename . ' has been generated.');
	}
}