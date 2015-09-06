<?php

namespace maze\Modules\Markdown;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\IndentedCode;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\HtmlElement;
use League\CommonMark\Block\Renderer\BlockRendererInterface;

class IndentedCodeRenderer implements BlockRendererInterface
{
    /**
     * @param AbstractBlock            $block
     * @param ElementRendererInterface $htmlRenderer
     * @param bool                     $inTightList
     *
     * @return HtmlElement
     */
    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, $inTightList = false)
    {
        if (!($block instanceof IndentedCode)) {
            throw new \InvalidArgumentException('Incompatible block type: ' . get_class($block));
        }

        $attrs = [];
        foreach ($block->getData('attributes', []) as $key => $value) {
            $attrs[$key] = $htmlRenderer->escape($value, true);
        }

        return new HtmlElement(
            'pre',
            [],
            new HtmlElement('code', $attrs, $block->getStringContent())
        );
    }
}