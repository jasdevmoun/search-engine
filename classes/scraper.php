<?php 

class Scraper {

	public $client; // Goutte client
	public $search_engine = 'bing';
	public $content;
	public $result_count;

	public function __construct() {
		require 'vendor/autoload.php';
		
		//  Create a new Goutte client instance
		$this->client = new Goutte\Client();
		
		// Configure Guzzle Client
		$guzzleclient = new \GuzzleHttp\Client([
			'timeout' => 60,
			'verify' => false,
		]);
		
		//  config to allow HTTPS
		$this->client->setClient($guzzleclient);
	}

	/**
	 * Generate a search engine specific link
	 */
	function get_link($q) {
		switch ($this->search_engine) {
			case 'google':
				$engine = "google.com";   // the search engine
				$link = "https://www." . $engine . "/search?q=" . $q;
				break;
			case 'yahoo':
				$engine = "in.search.yahoo.com";   // the search engine
				$link = "https://" . $engine . "/search?p=" . $q;
				break;
			case 'duckduckgo':
				$engine = "duckduckgo.com";   // the search engine
				$link = "https://" . $engine . "/?q=" . $q;
				break;
			default:
				$engine = "bing.com";   // the search engine
				$link = "https://www." . $engine . "/?q=" . $q . '&ia=web';
		}

		$link = str_replace(" ","%20", $link);
		return $link;
	}

	/**
	 * Do the scraping
	 */
	public function scrape($query) {
		//  Make a GET request (Create DOM from URL or file)
		$crawler = $this->client->request('GET', $this->get_link($query));

		switch ($this->search_engine) {
			case 'bing':
				$this->result_count =  $crawler->filter('span.sb_count')->text();

				$crawler->filter('ol#b_results > li.b_algo')->each(function ($node) {
					static $i = 0;
					
					$this->content[$i]['title'] = $node->filter('h2')->text();
					$this->content[$i]['url'] = $node->filter('div.b_attribution')->text();
					$this->content[$i]['desc'] = $node->filter('div.b_caption')->text();
					$i++;
				});
			break;
			case 'yahoo':
				$crawler->filter('ol.mb-15.reg > li')->each(function ($node) {
					static $i = 0;
					
					$this->content[$i]['title'] = $node->filter('h3')->html();
					$this->content[$i]['url'] = $node->filter('span')->text();
					$this->content[$i]['desc'] = $node->filter('p')->text();
					$i++;
				});
			break;
		}
		
		return $this->content;
	}
}