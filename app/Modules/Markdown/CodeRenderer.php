<?php

namespace maze\Modules\Markdown;

use League\CommonMark\Inline\Renderer\InlineRendererInterface;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\HtmlElement;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Code;

class CodeRenderer implements InlineRendererInterface
{
    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if (!($inline instanceof Code)) {
            throw new \InvalidArgumentException('Incompatible inline type: ' . get_class($inline));
        }

        $attrs = [];
        foreach ($inline->getData('attributes', []) as $key => $value) {
            $attrs[$key] = $htmlRenderer->escape($value, true);
        }

        return new HtmlElement('code', $attrs, $inline->getContent());
    }
}