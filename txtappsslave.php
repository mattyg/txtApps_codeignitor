#!/usr/bin/php
<?php
	/*This file is part of txtApps.

	    txtApps is free software: you can redistribute it and/or modify
	    it under the terms of the GNU General Public License as published by
	    the Free Software Foundation, either version 3 of the License, or
	    (at your option) any later version.

	    txtApps is distributed in the hope that it will be useful,
	    but WITHOUT ANY WARRANTY; without even the implied warranty of
	    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	    GNU General Public License for more details.

	    You should have received a copy of the GNU General Public License
	    along with txtApps.  If not, see <http://www.gnu.org/licenses/>.*/
	
	
	include_once('SimplePie/simplepie.inc');
	date_default_timezone_set('America/New_York');

	echo "s---> slave started\n";
	//get email and url arguments
	ob_start();
		var_export($argv[1]);
		$mailto = substr(ob_get_contents(),1,-1);
	ob_end_clean();	
	ob_start();
		var_export($argv[2]);
		$url = substr(ob_get_contents(),1,-1);
	ob_end_clean();
	
	//output argument info
	echo "s---> address: " . $mailto. "\n";
	echo "s---> url: $url\n";
		
	//get the last rss item from feed 
	$rss = new SimplePie($url, getcwd()."/SimplePie/cache", 10);
	$item = $rss->get_item(0);
	
	//if its a new item, interperet it
	$itemcache = exec("cat cache.txt");
	if($item && $item->get_id() != $itemcache)
	{
		$t = stripos($item->get_title(),":");
		$input = strtolower(htmlspecialchars_decode(substr($item->get_title(), $t+2)));
		if($input != $itemcache)
		{
			$l = strpos($item->get_link(),"statuses/");
			$id = substr($item->get_link(), $l+9);

			echo "s---> input: $input\n";
			
			//interperet first word as commmand, run script with command as title
			$sub = substr($input, $l);
			if($l == 0)
			{
				$cmd = "./scripts/".$input.".* ";
			}
			else
			{
				$cmd = "./scripts/".substr($input,0,$l).".* ".$sub;
			}
			echo "s---> cmd: ".$cmd."\n";
			$output = exec($cmd);
			
			//write this item's id to the cache
			exec("echo \"".$item->get_id()."\" > cache.txt");
			echo "s---> output: $output\n";

			//prepare output for txt messages (make into array of <= 160 character strings)
			if(strlen($output)/160 > 1)
			{
				$txtnum = 0;
				while(strlen($output) > 0)
				{
					$brokenoutput[$txtnum] = substr($output, 0, 160);
					$output = substr($output, 160);
					$txtnum++;
				}
			}
			else
			{
				$brokenoutput[0] = $output;				
			}
			
			//send txt message through email
			foreach($brokenoutput as $txt)
			{
				$mailed = mail($mailto, "", $txt); 
				if($mailed)
				{
					echo "s---> txt sent\n";
				}
				else 
				{
					echo "s---> txt sending failed\n";
				}
			}
		}	
		else
		{
			echo "s---> no new inputs\n";
		}
	}
	else
	{
		echo "s---> No new items in feed\n";
	}
?>