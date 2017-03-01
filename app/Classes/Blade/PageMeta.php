<?php

namespace App\Classes\Blade;

/**
 * Class PageMeta
 * @package App\Classes\Blade
 *
 * @author Wouter van Marrum <w.vanmarrum@texemus.com>
 */
class PageMeta
{
    protected $html;

    /**
     * @var
     */
    protected $pageContent;

    /**
     * @var array
     */
    protected $robots = [
		'index, follow',
		'noindex, follow',
		'index, nofollow',
		'noindex, nofollow'
	];

    /**
     * @var array
     */
    protected $revisit = [
		'days',
		'month'
	];

    /**
     * Gets the page information
     *
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     * @param $pageContent
     * @param array $attr
     * @return mixed
     */
	public function getInformation($pageContent, $attr = [])
	{
		$this->pageContent = $pageContent;
		return $this->buildMetaTags($attr);
	}

    /**
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     * @param $attr
     * @return mixed
     */
	public function buildMetaTags($attr)
	{
		$this->buildTitleTag()
			->buildDescriptionTag()
			->buildKeywordsTag()
			->buildAuthorTag($attr['author'] ?? null)
			->buildRobotsTag($attr['robots'] ?? [])
			->buildRevisitAfterTag($attr['revisit'] ?? []);

		return $this->html;
	}

    /**
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     * @return $this
     */
	public function buildTitleTag()
	{
		$this->html .= "<title>". $this->pageContent->name ."</title>\n";
		return $this;
	}

    /**
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     * @return $this
     */
	public function buildDescriptionTag()
	{
		if (!is_null($this->pageContent->description)) {
			$this->html .= "<meta name=\"description\" content=\"". $this->pageContent->description ."\" />\n";
		}
		return $this;
	}

    /**
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     * @return $this
     */
	public function buildKeywordsTag()
	{
		if (!is_null($this->pageContent->keywords)) {
			$this->html .= "<meta name=\"keywords\" content=\"". $this->pageContent->keywords ."\" />\n";
		}
		return $this;
	}

    /**
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     * @param $author
     * @return $this
     */
	public function buildAuthorTag($author)
	{
		if (isset($author)) {
			$this->html .= "<meta name=\"author\" content=\"$author\" />\n";
		}

		return $this;
	}

    /**
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     * @param $attr
     * @return $this
     */
	public function buildRobotsTag($attr)
	{
		if (isset($attr['type'])) {
			$this->html .= "<meta name=\"robots\" content=\"". $this->robots[$attr['type']] ."\" />\n";
		}

		return $this;
	}

    /**
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     * @param $attr
     * @return $this
     */
	public function buildRevisitAfterTag($attr)
	{
		if (isset($attr['amount']) && isset($attr['type'])) {
			$this->html .= "<meta name=\"revisit-after\" content=\"". $attr['amount'] . " " . $this->revisit[$attr['type']] ."\" />\n";
		}

		return $this;
	}
}