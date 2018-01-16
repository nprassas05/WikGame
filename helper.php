<?php
	/* store the wiki links in array an array from file */
	$linkFile = fopen("links.txt", "r") or die("Unable to open file!");
	$links = split("\n", fread($linkFile,filesize("links.txt")));
	fclose($linkFile);
	
	/* store jesus wiki links in an array from file*/
	$jesusLinkFile = fopen("jesus_links.txt", "r") or die("Unable to open file!");
	$jesusLinks = split("\n", fread($jesusLinkFile,filesize("links.txt")));
	fclose($jesusLinkFile);
	
	/* set the source and target links, passing by reference */
	function setLinks(&$source, &$target) {
		global $links;
		
		$i = rand(0, count($links) - 1);
		
		// make sure i and j aren't the same
		do {
			$j = rand(0, count($links) - 1);
		} while ($j == $i);
		
		$source = $links[$i];
		$target = $links[$j];
	}
	
	/* alternative for setting the link, return value is the link */
	function getJesusLink() {
		global $jesusLinks;
		return $jesusLinks[rand(0, count($jesusLinks) - 1)];
	}
	
	/*
	setLinks($source, $target);
	echo $source . "<br>";
	echo $target . "<br>";
	*/
	

	/* print the entire html body of a web page given its url */
	function displayTags($url) {
		
		$d = new DOMDocument;
		$d->loadHTMLFile($url);
		$body = $d->getElementsByTagName('body')->item(0);
		// perform innerhtml on $body by enumerating child nodes 
		// and saving them individually
		foreach ($body->childNodes as $childNode) {
  			echo $d->saveHTML($childNode);
		}
	}

?>