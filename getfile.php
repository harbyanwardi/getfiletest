<?php
  //header('Content-type: application/json');
   

   function parse_argv(array $argv): array
	{
	    $request = [];
	    foreach ($argv as $i => $a) {
	        if (!$i) {
	            continue;
	        }

	        if (preg_match('/^-*(.+?)=(.+)$/', $a, $matches)) {
	            $request[$matches[1]] = $matches[2];
	        } else {
	            $request[$a] = true;
	        }
	    }

	    return $request;
	}

	if (!empty($argv[1])) {
	    $_GET = parse_argv($argv);
	}
	

	//$dat = json_encode( explode("\r\n",file_get_contents('data.txt')) );
	   $type = strtolower(@$_GET['t']);
	   $source = strtolower(@$_GET['s']);
	   $destination = strtolower(@$_GET['o']);
	   $tutor = strtolower(@$_GET['h']);

	   if($tutor!= ''){
	   	$text = 'Penggunaan Get File Log \n Gunakan "t" untuk flag type (Json / Text) \n
	   	Gunakan "s" untuk flag file sumber \n
	   	Gunakan "o" untuk flag file tujuan \n
	   	Gunakan "h" untuk flag cara penggunaan';
	   	echo $text;
	   }
	   else{
		   	if($type=='json'){
		   		$dat = json_encode( explode("\r\n",file_get_contents($source) or die("Failed get File")) );
		   		if($destination!=''){
		   			$file = $destination.'errordest_log.json';
		   		}
		   		else{
		   			$file = 'errordest_log.json';
		   		}
		   		
		   	}
		   	else{
		   		$dat = file_get_contents($source);
		   		if($destination!=''){
		   			$file = $destination.'errordest_log.txt';
		   		}
		   		else{
		   			$file = 'errordest_log.txt';
		   		}
		   	}

		   	$myfile = fopen($file, "w") or die("Unable to open file!");
				// //$txt = "John Doe\n";
		   	fwrite($myfile, $dat) or die("Failed Get File");
		   	fclose($myfile);
		   	echo "Success Get File";
	   }
	   

  ?>