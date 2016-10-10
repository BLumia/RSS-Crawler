<?php

class RSSArticle {
	public function __construct($title, $link, $description) {
		$this->i_title = $title;
		$this->i_link = $link;
		$this->i_desc = $description;
	}
}

class RSSFeed  {
	
	private $articleArray = array();

	public function __construct($channel_title, $site_url, $site_name, $desc) {
		$this->c_title = $channel_title;
		$this->c_link = $site_url;
		$this->site_name = $site_name;
		$this->c_desc = $desc;
	}
	
	public function addArticle($title, $link, $description) {
		$article = new RSSArticle($title, $link, $description);
		array_push($this->articleArray, $article);
	}
	
	public function generateFeed() {

		$xml = '<?xml version="1.0" encoding="utf-8"?>' . "\n";
		$xml .= '<rss version="2.0">' . "\n";

		$xml .= '<channel>' . "\n";
		$xml .= '<title>' . $this->c_title . '</title>' . "\n";
		$xml .= '<link>' . $this->c_link . '</link>' . "\n";
		$xml .= '<description>' . $this->c_desc . '</description>' . "\n";

		foreach($this->articleArray as $rss_item) {
			$xml .= '<item>' . "\n";
			$xml .= '<title>' . $rss_item->i_title . '</title>' . "\n";
			$xml .= '<link>' . $rss_item->i_link . '</link>' . "\n";
			$xml .= '<description>' . $rss_item->i_desc . '</description>' . "\n";
			$xml .= '</item>' . "\n";
		}

		$xml .= '</channel>' . "\n";
		$xml .= '</rss>';

		return $xml;
	}
}

?>