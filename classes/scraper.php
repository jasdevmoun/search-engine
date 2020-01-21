<?php 

class Scraper {

	public $client; // Goutte client
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
	function get_link($q, $engine = 'bing') {
		switch ($engine) {
			case "google":
				$engine = "google.com";   // the search engine
				$link = "https://www." . $engine . "/search?q=" . $q;
				break;
			case "yahoo":
				$engine = "in.search.yahoo.com";   // the search engine
				$link = "https://." . $engine . "/search?p=" . $q;
				break;
			case "duckduckgo":
				$engine = "duckduckgo.com";   // the search engine
				$link = "https://" . $engine . "/?q=" . $q;
				break;
			default:
				$engine = "bing.com";   // the search engine
				$link = "https://www." . $engine . "/?q=" . $q;
		}

		$link = str_replace(" ","%20", $link);
		return $link;
	}

	/**
	 * Do the scraping
	 */
	public function scrape($query, $engine = 'bing') {
		//  Make a GET request (Create DOM from URL or file)
		$crawler = $this->client->request('GET', $this->get_link($query));

		switch ($engine) {
			case 'google':
			case 'bing':
				$this->result_count =  $crawler->filter('span.sb_count')->text();


				// echo $crawler->filter('')

				$crawler->filter('ol#b_results > li.b_algo')->each(function ($node) {
					static $i = 0;
					
					$this->content[$i]['title'] = $node->filter('h2')->text();
					$this->content[$i]['url'] = $node->filter('div.b_attribution')->text();
					$this->content[$i]['desc'] = $node->filter('div.b_caption')->text();
					$i++;
				});
			break;
		}
		
		return $this->content;
	}
}