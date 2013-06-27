<?php

class Scrapper extends CI_Controller
{
	function index()
	{
		//Get the keyowrds first for a particular campaign
		
		/*
			Temporary keyword atm
		*/
		$keywords = "hosting";
		$campaign = 1;
		
		$this->grab_google($keywords, $campaign);
		
		//Now dispatch to get bing data!
		
	}
	
	function grab_google($keyword, $campaign_id)
	{
		$metadata = array();
		//Now dispatch to search google first and insert it into database from there.
		$google_url	= 'http://www.google.com/search?lr=&hl=en&tbm=blg&output=rss&num=70&q=' . $keyword;
		$google_url .= '';
		
		echo $google_url;
		//Get the URL's and data!
		//Use a regex to get the URLs or maybe use Jordan's Serp serp code to accomplish this
		$content = file_get_contents($google_url);
		$c = new SimpleXmlElement(utf8_encode($content));
		echo "<pre>";
		print_r($c);
		foreach($c->channel->item as $co)
		{
			$metadata = $co;
			print_r($metadata);
			//Get the URL Atribute
			
			//URL
			$url = $co->link;
			$this->fetch_page($url, $keyword, $campaign_id, $metadata);
		}
	}
	
	function fetch_page($url, $keyword, $campaign_id, $metadata)
	{
		//Get the data of the page and store in the database!
		//NOt completed 
		/*
			<p>[^\t]+?</p>
		*/
		
		//Get the actual content of the page
		
		
		$cont = mb_convert_encoding($this->curl_fetch($url), "HTML-ENTITIES", "UTF-8");
		//Matches the paragraph tags & stores them in an array so that we can easily later parse the page for keywords
		// My First EVER REGEX[Fail] : /<p[^>]*>[^]+?<\/[p]>/
		
		preg_match_all('#<\s*p[^>]*>([^<]*)<\s*\/\s*p\s*>#', $cont, $paragraph);
		
		//Remove the extravagant stuff, reduce memory usage :D
		$paragraph[0] = "";
		
		//Now we have paragraph array, so we move along and loop through it and process filter_1
		
		$filter_1 = array();
		
		foreach($paragraph[1] as $p)
		{
			//This paragraph contains the keyword which interests us
			if(stristr($p, $keyword) !== FALSE)
			{
				//Now I'll store it in the filter_1 array so we can move along and process it even further in the next filter
				$filter_1[] = $p;
			}
		}
		print_r($paragraph);
		//Filter 2 cuts short the blog post sentences so that we can have a brief concise text related to context(keywords)!
		//Will get back to this later!
		
		//Time to move to filter 3 which just makes up the whole body of text so that it looks natural and concise
		$dot = "...";
		$text = $filter_1[0]. $dot; //Initial sentence to get some idea of the topic, followed by three periods so we know that we are continuing
		$filter_1[0] = "";
		foreach($filter_1 as $f)
		{
			$text .= $f.$dot;
		}
		
		//Now we have the processed text so we can continue inserting it into the DB!
		
		$this->insert_blog($text, $keyword, $campaign_id, $metadata);		
	}	
	/*
		Jordan's curl fetch function, just removed cookies from it!
	*/
	function curl_fetch($url, $proxy='') 
	{
		/*
		 * If the URL is blank, return
		 * 1/26/2013
		 */
		if (empty($url)) 
		{
			return FALSE;
		}

		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, FALSE);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE );
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE );

		/*
		 * If the proxy is not blank,
		 * set it.
		 */
		if (!empty($proxy))
		{
			curl_setopt($ch, CURLOPT_PROXY, $proxy); 
		}

	    $output = curl_exec($ch);
	    $info = curl_getinfo($ch);
	    curl_close($ch);

	    /*
	     * Return the output
	     */
	    return $output;

	}
	
	function insert_blog($text, $keyword,  $campaign_id, $metadata)
	{
		$data = array(
			'text'		=> html_entity_decode($text),
			'keyword'	=> $keyword,
			'campaign_id'	=> $campaign_id,
			'timestamp'	=> time()
		);
		$this->db->set($data);
		$this->db->insert('blog_search');
	}
	
	function get_alexa()
	{
		$cont = mb_convert_encoding($this->curl_fetch('http://alexa.com/siteinfo/liquidserve.com/'), "HTML-ENTITIES", "UTF-8");
		//Matches the paragraph tags & stores them in an array so that we can easily later parse the page for keywords
		// My First EVER REGEX[Fail] : /<p[^>]*>[^]+?<\/[p]>/
		
		preg_match_all('#<\s*a href="/siteowners/[^>]*>([^<]*)<\s*\/\s*a\s*>#', $cont, $rank);
		
		/*
			Returned data
Array
(
    [0] => Array
        (
            [0] => 741,522
            [1] => Learn
more about Enhanced Site Listings
            [2] => Edit your site listing
        )

    [1] => Array
        (
            [0] => 741,522
            [1] => Learn
more about Enhanced Site Listings
            [2] => Edit your site listing
        )

)
			
		*/
		//Remove unnessary data
		$rank[0] = "";
		// This is the index of the rank
		return $rank[1][0];
	}
}