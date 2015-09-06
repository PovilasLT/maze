<?php

namespace maze\Modules\Markdown;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\FencedCode;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\HtmlElement;
use League\CommonMark\Block\Renderer\BlockRendererInterface;

class FencedCodeRenderer implements BlockRendererInterface
{
    /**
     * @param FencedCode               $block
     * @param ElementRendererInterface $htmlRenderer
     * @param bool                     $inTightList
     *
     * @return HtmlElement
     */
    public function render(AbstractBlock $block, ElementRendererInterface $htmlRenderer, $inTightList = false)
    {
        if (!($block instanceof FencedCode)) {
            throw new \InvalidArgumentException('Incompatible block type: ' . get_class($block));
        }

        $attrs = [];
        foreach ($block->getData('attributes', []) as $key => $value) {
            $attrs[$key] = $htmlRenderer->escape($value, true);
        }

        $infoWords = $block->getInfoWords();
        if (count($infoWords) !== 0 && strlen($infoWords[0]) !== 0) {
            $attrs['class'] = isset($attrs['class']) ? $attrs['class'] . ' ' : '';
            $attrs['class'] .= 'language-' . $htmlRenderer->escape($infoWords[0], true);
        }

        return new HtmlElement(
            'pre',
            [],
            new HtmlElement('code', $attrs, $block->getStringContent())
        );
    }
}