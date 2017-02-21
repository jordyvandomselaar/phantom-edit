<?php

namespace App\Classes\Blade;

/**
 * Class for page meta.
 *
 * @author     Wouter van Marrum <w.vanmarrum@texemus.com>
 *
 * @package    App\Classes\Blade
 */
class PageMeta
{
	protected $pageContent;

	protected $robots = [
		'index, follow',
		'noindex, follow',
		'index, nofollow',
		'noindex, nofollow'
	];

	protected $revisit = [
		'days',
		'month'
	];

	/**
	 * Gets the information.
	 *
	 * @param      Object  $pageContent  The page content
	 * @param      array   $attr         The attribute
	 *
	 * @return     <type>  The information.
	 */
	public function getInformation($pageContent, $attr = [])
	{
		$this->pageContent = $pageContent;
		return $this->buildMetaTags($attr);
	}

	/**
	 * Builds meta tags.
	 *
	 * @return     <type>  The meta tags.
	 */
	public function buildMetaTags($attr)
	{
		$this->buildTitleTag()
			->buildDescriptionTag()
			->buildKeywordsTag()
			->buildAuthorTag($attr['author'])
			->buildRobotsTag($attr['robots'])
			->buildRevisitAfterTag($attr['revisit'] ?? []);
	}

	/**
	 * Builds a title tag.
	 *
	 * @return     string  The title tag.
	 */
	public function buildTitleTag()
	{
		echo "<title>". $this->pageContent->name ."</title>\n";
		return $this;
	}

	/**
	 * Builds a description tag.
	 *
	 * @return     string  The description tag.
	 */
	public function buildDescriptionTag()
	{
		if (!is_null($this->pageContent->description)) {
			echo "<meta name=\"description\" content=\"". $this->pageContent->description ."\" />\n";
		}
		return $this;
	}

	/**
	 * Builds a keywords tag.
	 *
	 * @return     string  The keywords tag.
	 */
	public function buildKeywordsTag()
	{
		if (!is_null($this->pageContent->keywords)) {
			echo "<meta name=\"keywords\" content=\"". $this->pageContent->keywords ."\" />\n";
		}
		return $this;
	}

	/**
	 * Builds an author tag.
	 *
	 * @param      <type>  $author  The author
	 *
	 * @return     string  The author tag.
	 */
	public function buildAuthorTag($author)
	{
		if (isset($author)) {
			echo "<meta name=\"author\" content=\"$author\" />\n";
		}

		return $this;
	}

	/**
	 * Builds a robots tag.
	 *
	 * @param      <type>  $type   The type
	 *
	 * @return     string  The robots tag.
	 */
	public function buildRobotsTag($attr)
	{
		if (isset($attr['type'])) {
			echo "<meta name=\"robots\" content=\"". $this->robots[$attr['type']] ."\" />\n";
		}

		return $this;
	}

	/**
	 * Builds a revisit after tag.
	 *
	 * @param      <type>  $type    The type
	 * @param      <type>  $amount  The amount
	 *
	 * @return     string  The revisit after tag.
	 */
	public function buildRevisitAfterTag($attr)
	{
		if (isset($attr['amount']) && isset($attr['type'])) {
			echo "<meta name=\"revisit-after\" content=\"". $attr['amount'] . " " . $this->revisit[$attr['type']] ."\" />\n";
		}

		return $this;
	}
}