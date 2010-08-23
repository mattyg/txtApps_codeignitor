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


	include('config.php');

	//loop-de-loop the input reading
	while(true)
	{
		$orderoutput = shell_exec("php txtappsslave.php '$cellnumber@$carrier' '$twitterfeed_url'");
		echo "m---> txtappsslave.php executed\n";
		echo "$orderoutput\n";
		sleep(10);
	}
?>