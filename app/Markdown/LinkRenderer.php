<?php namespace maze\Extras\Markdown;

use League\CommonMark\ElementRendererInterface;
use League\CommonMark\HtmlElement;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Link;
use League\CommonMark\Util\Configuration;
use League\CommonMark\Util\ConfigurationAwareInterface;
use League\CommonMark\Util\RegexHelper;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;
use maze\Extras\Markdown\YouTubeLink;
use maze\Extras\Markdown\TwitchLink;

class LinkRenderer implements InlineRendererInterface, ConfigurationAwareInterface
{
    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @param Link                     $inline
     * @param ElementRendererInterface $htmlRenderer
     *
     * @return HtmlElement
     */
    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if (!($inline instanceof Link)) {
            throw new \InvalidArgumentException('Incompatible inline type: ' . get_class($inline));
        }

        //tikrinam ar URL yra twitch/yt
        $yt_id = YouTubeLink::id($inline->getUrl());
        $twitch_name = TwitchLink::channel($inline->getUrl());
        if($yt_id)
        {
            return $this->buildYouTube($inline, $htmlRenderer, e($yt_id));
        }
        elseif($twitch_name)
        {
            return $this->buildTwitch($inline, $htmlRenderer, e($twitch_name));
        }
        else
        {
            return $this->buildLink($inline, $htmlRenderer);
        }
    }

    private function isExternalUrl($url) {
        return parse_url($url, PHP_URL_HOST) !== $_SERVER['SERVER_NAME'];
    }

    private function buildLink($inline, $htmlRenderer) {
        $attrs = [];
        foreach ($inline->getData('attributes', []) as $key => $value) {
            $attrs[$key] = $htmlRenderer->escape($value, true);
        }

        if (!($this->config->getConfig('safe') && RegexHelper::isLinkPotentiallyUnsafe($inline->getUrl()))) {
            $attrs['href'] = $htmlRenderer->escape($inline->getUrl(), true);
        }

        if (isset($inline->data['title'])) {
            $attrs['title'] = $htmlRenderer->escape($inline->data['title'], true);
        }

        if($this->isExternalUrl($inline->getUrl()))
        {
            $attrs['rel'] = 'nofollow';
            $attrs['target'] = '_blank';
        }

        return new HtmlElement('a', $attrs, $htmlRenderer->renderInlines($inline->children()));
    }

    private function buildYouTube($inline, $htmlRenderer, $id) {
        $attrs = [
            'src' => 'https://www.youtube.com/embed/'.$id,
            'frameborder' => 0,
            'allowfullscreen' => true,
            'class' => 'responsive-embed',
        ];

        $iframe = new HtmlElement('iframe', $attrs, $htmlRenderer->renderInlines($inline->children()));
        $wrapped = new HtmlElement('div', ['class' => 'responsive-embed-wrapper'], $iframe);

        return $wrapped;
    }

    private function buildTwitch($inline, $htmlRenderer, $channel) {
        $attrs = [
            'src' => 'https://player.twitch.tv/?channel='.$channel.'&!autoplay',
            'frameborder' => 0,
            'scrolling' => 'no',
            'autoplay' => 'false',
            'class' => 'responsive-embed',
        ];
        
        $iframe = new HtmlElement('iframe', $attrs, $htmlRenderer->renderInlines($inline->children()));
        $wrapped = new HtmlElement('div', ['class' => 'responsive-embed-wrapper'], $iframe);

        return $wrapped;
    }

    /**
     * @param Configuration $configuration
     */
    public function setConfiguration(Configuration $configuration)
    {
        $this->config = $configuration;
    }
}
