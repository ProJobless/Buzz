<?php

class Scrapper extends CI_Controller
{
	function index()
	{
		//Get the keyowrds first for a particular campaign
		
		/*
			Temporary keyword atm
		*/
		// $keywords = "hosting";
// 		$campaign = 1;
		
		$query = $this->db->get_where('campaigns', array('id' => $this->uri->segment(4)));
		
		$this->grab_google($keywords, $campaign);
		
		//Now dispatch to get bing data!
		
	}
	
	function grab_google($keyword, $campaign_id)
	{
		$metadata = array();
		//Now dispatch to search google first and insert it into database from there.
		$google_url	= 'http://www.google.com/search?lr=&hl=en&tbm=blg&output=rss&num=20&q=' . $keyword;
		$google_url .= '';

		//Get the URL's and data!
		//Use a regex to get the URLs or maybe use Jordan's Serp serp code to accomplish this
		$content = file_get_contents($google_url);
		$c = new SimpleXmlElement(utf8_encode($content));
		
		foreach($c->channel->item as $co)
		{
			//Set the metadata of the post
			$metadata = $co;
			
			//URL
			$url = $co->link;
			$this->fetch_page($url, $keyword, $campaign_id, $metadata);
		}
	}
	
	function fetch_page($url, $keyword, $campaign_id, $metadata)
	{
		//Get the data of the page and store in the database!
		
		//Get the actual content of the page
		
		
		$cont = mb_convert_encoding($this->curl_fetch($url), "HTML-ENTITIES", "UTF-8");
		//Matches the paragraph tags & stores them in an array so that we can easily later parse the page for keywords
		// My First EVER REGEX[Fail] : /<p[^>]*>[^]+?<\/[p]>/
		
		preg_match_all('#<\s*p[^>]*>([^<]*)<\s*\/\s*p\s*>#', $cont, $paragraph);
		
		//Remove the extravagant stuff, reduce memory usage :D
		$paragraph[0] = "";
		
		//Now we have pageragraph array, so we move along and loop through it and process filter_1
		
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
		if(count($filter_1) == 0)
		{
			return;
		}
		//Filter 2 cuts short the blog post sentences so that we can have a brief concise text related to context(keywords)!
		//Will get back to this later!
		
		//Time to move to filter 3 which just makes up the whole body of text so that it looks natural and concise
		$dot = "<br>";
		$text = $filter_1[0]. $dot; //Initial sentence to get some idea of the topic, followed by three periods so we know that we are continuing
		$filter_1[0] = "";
		foreach($filter_1 as $f)
		{
			$text .= $f.$dot;
		}
		
		//Now we have the processed text so we can continue inserting it into the DB!
		$query = $this->db->get_where('blog_search', array('link' => (string)$metadata->link));
		if($query->num_rows > 0)
		{
			return;
		}
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
	
	/*
		Inserts the data into the database
	*/
	function insert_blog($text, $keyword,  $campaign_id, $metadata)
	{
		$data = array(
			'text'		=> $this->parse_keywords(html_entity_decode($text), $keyword),
			'keyword'	=> $keyword,
			'campaign_id'	=> $campaign_id,
			'timestamp'	=> time(),
			'title'		=> (string)$metadata->title,
			'link'		=> (string)$metadata->link,
			'alexa_rank' => $this->get_alexa((string)$metadata->link),
			'google_pr' => $this->get_pr((string)$metadata->link),
		);
		$this->db->set($data);
		$this->db->insert('blog_search');
	}
	function parse_keywords($text, $keyword)
	{
		//Replace the keyword with the keyword with a <b> tag around it
		return preg_replace('/('.$keyword.')/i', '<b>${1}</b>' ,$text);
	}
	/*
		Function gets the google PR
	*/
	function get_pr($url)
	{
		$url = parse_url($url);
		$url = $url['host'];
		
		$url = preg_replace('#www.#', '', $url);
		
		$hash = $this->checkHash($this->createHash($url));
		
		return preg_replace('#Rank_[0-9]:[0-9]:#','',$this->curl_fetch("http://toolbarqueries.google.com/tbr?client=navclient-auto&ch=".$hash."&features=Rank&q=info:".$url."&num=100&filter=0"));
		
	}
	/*
		Function gets the alexa rank from by curl and returns it!
	*/
	function get_alexa($url = "http://liquidserve.com")
	{
		//Fix the URL
		$url = parse_url($url);
		$url = $url['host'];
		$cont = mb_convert_encoding($this->curl_fetch('http://alexa.com/siteinfo/'.$url), "HTML-ENTITIES", "UTF-8");
		
		preg_match_all('/<div class=\"rank-row\">[^\B]+?<span class=\"no-wrap\">/', $cont, $rank);
		
		preg_match_all('/<strong class="font-big2 valign">[0-9,]*<\/strong>/', $rank[0][0], $r);
	
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
		
		// Removing the useless data
		return str_replace(",", "", str_replace('</strong>', '',str_replace('<strong class="font-big2 valign">', "",$r[0][0])));
	}
	function createHash($string) {
	    $check1 = $this->stringToNumber($string, 0x1505, 0x21);
	    $check2 = $this->stringToNumber($string, 0, 0x1003F);

	    $factor = 4;
	    $halfFactor = $factor/2;

	    $check1 >>= $halfFactor;
	    $check1 = (($check1 >> $factor) & 0x3FFFFC0 ) | ($check1 & 0x3F);
	    $check1 = (($check1 >> $factor) & 0x3FFC00 ) | ($check1 & 0x3FF);
	    $check1 = (($check1 >> $factor) & 0x3C000 ) | ($check1 & 0x3FFF);

	    $calc1 = (((($check1 & 0x3C0) << $factor) | ($check1 & 0x3C)) << $halfFactor ) | ($check2 & 0xF0F );
	    $calc2 = (((($check1 & 0xFFFFC000) << $factor) | ($check1 & 0x3C00)) << 0xA) | ($check2 & 0xF0F0000);

	    return ($calc1 | $calc2);
	}
	function stringToNumber($string, $check, $magic) {
	    $int32 = 4294967296;  // 2^32
	    $length = strlen($string);
	    for ($i = 0; $i < $length; $i++) {
	        $check *= $magic;
	        // If the float is beyond the boundaries of integer (usually +/- 2.15e+9 = 2^31),
	        // the result of converting to integer is undefined
	        // refer to http://www.php.net/manual/en/language.types.integer.php
	        if($check >= $int32) {
	            $check = ($check - $int32 * (int) ($check / $int32));
	            // if the check less than -2^31
	            $check = ($check < -($int32 / 2)) ? ($check + $int32) : $check;
	        }
	        $check += ord($string{$i});
	    }
	    return $check;
	}

	function checkHash($Hashnum)
	{
		$CheckByte = 0;
		$Flag = 0;
		$HashStr = sprintf('%u', $Hashnum) ;
		$length = strlen($HashStr);
		for ($i = $length - 1; $i >= 0; $i --) {
			$Re = $HashStr{$i};
			if (1 === ($Flag % 2)) {
				$Re += $Re;
				$Re = (int)($Re / 10) + ($Re % 10);
			}
			$CheckByte += $Re;
			$Flag ++;
			}
			$CheckByte %= 10;
			if (0 !== $CheckByte) {
				$CheckByte = 10 - $CheckByte;
				if (1 === ($Flag % 2) ) {
					if (1 === ($CheckByte % 2)) {
						$CheckByte += 9;
					}
					$CheckByte >>= 1;
				}
			}
		return '7'.$CheckByte.$HashStr;
	}
}