<?php

namespace maze\Modules\Markdown;

use League\CommonMark\Converter;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;
use Webuni\CommonMark\TableExtension\TableExtension;
use maze\Modules\Markdown\CodeRenderer;
use maze\Modules\Markdown\FencedCodeRenderer;
use maze\Modules\Markdown\IndentedCodeRenderer;

class Parser {

	public $environment;
	public $converter;

	function __construct() {
		$this->environment = Environment::createCommonMarkEnvironment();

		//pridedam Table Extensiona
		$this->environment->addExtension(new TableExtension());
		$this->environment->addInlineRenderer('Code', new CodeRenderer());
		$this->environment->addBlockRenderer('FencedCode', new FencedCodeRenderer());
		$this->environment->addBlockRenderer('IndentedCode', new IndentedCodeRenderer());

		$this->converter = new Converter(new DocParser($this->environment), new HtmlRenderer($this->environment));
	}

	public function parse($string) {

		$string = e($string);

		return $this->converter->convertToHtml($string);
	}

}