<?php namespace maze\Extras;

use League\CommonMark\Environment;
use League\CommonMark\CommonMarkConverter;
use maze\Extras\Markdown\LinkRenderer;

class Markdown {

	private $environment;
	private $converter;
	private $config;

	public function __construct($config = ['safe' => true]) {
		$this->config = $config;
		$this->createEnvironment();
		$this->createConverter();
	}

	private function createEnvironment() {
		$this->environment = Environment::createCommonMarkEnvironment();
		$this->addInlineRenderers();
	}

	private function addInlineRenderers() {
		$this->environment->addInlineRenderer('League\CommonMark\Inline\Element\Link', new LinkRenderer());
	}

	private function createConverter() {
		$this->converter = new CommonMarkConverter($this->config, $this->environment);
	}

	public function convert($string) {
		$string = $this->converter->convertToHtml($string);
		return $string;
	} 

}