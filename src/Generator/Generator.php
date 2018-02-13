<?php
namespace YuBuilder\Generator;

abstract class Generator implements \YuBuilder\Generator\GeneratorInterface
{
	protected $config;
	protected $outputDir;
	protected $files;
	protected $dirname;
	protected $sourceDir;
	protected $separator = '/';

	public function __construct($config)
	{
		$this->config = (object) $config;
		$this->configure();
	}

	public function configure()
	{
		$this->outputDir = $this->getOutputDirectory();
		$dirname = $this->dirname;
		if (!isset($this->config->$dirname)) {
			trace_log(sprintf('ERROR! %s configuration has not been set.', $dirname));
			throw new \Exception(sprintf('ERROR! %s configuration has not been set.', $dirname));
		}
		$this->files = $this->config->$dirname;
		$this->sourceDir = $this->getSourceDirectory($this->dirname);
	}

	// presistent copy rule applies
	public function generateNewFilename($filename)
	{
		if (strpos($filename, $this->separator) !== false) {
			$filename = str_replace($this->separator, '-', $filename);
		}
		return $filename;
	}

	public function getSourceDirectory($dirname)
	{
		return $this->config->source['directory'] . $dirname . DS;
	}

	public function getOutputDirectory()
	{
		return $this->config->output['directory'] . $this->config->output['name'];
	}

	public function generate()
	{
		foreach ($this->files as $newFile => $source) {
			$soureFile = $this->sourceDir . $source;
			// get source file full path
			if (!file_exists($soureFile)) {
				trace_log($soureFile . ' does not exist. Skipped.');
				continue;
			}

			// todo: make this dynamic
			if ($this->dirname == 'partials') {
				$filename = $this->generateNewFilename($source);
			} else {
				$filename = $newFile . '.htm';
			}

			$outputFile = $this->outputDir . DS . $this->dirname . DS . $filename;
			// create directory if directory is not exist
			if (!file_exists(dirname($outputFile))) {
				mkdir(dirname($outputFile), 0777, true);
			}
			// if file not created
			if (!copy($soureFile, $outputFile)) {
				trace_log($outputFile . ' not created.');
			}
			// copy to new file path
			trace_log($outputFile . ' has been generated.');
		}
	}

	// different parser for different object
	// abstract public function parserTemplate();
}