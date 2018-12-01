<h1> ADD New Menu Item</h1>

<?php



//var_dump($menuItems);

  $parts = parse_url(site_url());
  $domain_url = $parts['scheme'] . '://' . $parts['host'];

  //var_dump($domain_url);


$limit_ini = ini_get('memory_limit');
echo $limit_ini;  echo '<br>';

$limit = ini2bytes(ini_get('memory_limit'));
echo $limit;


echo '<br>';
$usage = function_exists('memory_get_usage')? memory_get_usage(true) : 0;
echo 'memory'.$usage.'<br>';


$percent = (empty($usage) || empty($limit))? 0 : round(($usage * 100) / $limit);
echo $percent.'<br><br>';

$usage = format_bytes($usage, 0);
echo $usage.'<br>';

$usage_ini = format_bytes_2_ini($usage);
echo $usage_ini.'<br>';


echo '------------------------------------';


$free  = format_bytes(disk_free_space('/'));
$total = format_bytes(disk_total_space('/'));
$used  = $total - $free;

echo '<br>Total disk space: '.$total.'<br>'.'Used: '.$used.'<br>'.'Free :'.$free;

	/**
	 * Cast PHP ini values
	 */
	 function ini2bytes($value) {

		// Check values
		if (empty($value))
			return 0;

		// Extract unit
		$unit = strtoupper(substr($value, -1));
		$value = (int) substr($value, 0, -1);

		// Check KB
		if ('K' == $unit) {
			$value = $value * 1024;

		// Check MB
		} elseif ('M' == $unit) {
			$value = $value * 1048576;

		// Check GB
		} elseif ('G' == $unit) {
			$value = $value * 1073741824;
		}

		// Done
		return $value;
	}

	/**
	 * Cast formatted size to ini units
	 */
	 function format_bytes_2_ini($value) {
		return str_replace(array(' KB',' MB',' GB', ' TB'), array('K', 'M', 'G', 'T'), $value);
	}


	//void passthru ( string $command [, int &$return_var ] )
	/**
	 * A wrapper to format bytes for ini_get values
	 */
	 function format_bytes_ini_val($value) {
		return format_bytes(ini2bytes($value));
	}



	/**
	 * A wrapper to format bytes and ini_get method
	 */
	 function format_bytes_ini_get($key) {
		return format_bytes(ini2bytes(ini_get($key)));
	}



	/**
	 * Format size from bytes to KB, MB, GB or TB
	 */
 function format_bytes($bytes, $precision = 2, $number_format = true) {

		// Supported units
		$units = array('B', 'KB', 'MB', 'GB', 'TB');

		// Prepate values
		$bytes = max($bytes, 0);
		$pow = floor(($bytes? log($bytes) : 0) / log(1024));
		$pow = min($pow, count($units) - 1);

		// Uncomment one of the following alternatives
		$bytes /= pow(1024, $pow);
		if (0 == $pow) {
			$pow = 1;
			if ($bytes > 0)
				$bytes /= 1024;
		}

		// Round and format
		$value = round($bytes, $precision);
		if ($number_format && function_exists('number_format_i18n'))
			$value = number_format_i18n($value, $precision);

		// Done
		return $value.' '.$units[$pow];
	}

//$output = shell_exec('ls ');

//$output = `ls -al`;

// $output = `pwd`;
// echo "<pre>$output</pre>";

//echo exec('whoami');
//echo exec('ls /home/vagrant');  


//getting current directory. same as `pwd`
//$old_path = getcwd(); 
//echo  "<pre>$old_path</pre>";

//change directory for instance to where the script you want to run is.
//chdir('/home/vagrant/');

//Execute your shell script
//$output = shell_exec('./script.sh var1 var2');

//Then change directory back to the original directory as captured by  $old_path
//chdir($old_path);


/*  //making a directory. This will  change directory make a folder named data, then change directory back to where you were
$old_path = getcwd();
chdir('/home/vagrant/');
exec("mkdir data");
chdir($old_path);
echo `pwd`;

*/

//This function will return complete output as string 
//system('ls');

/*

One downside to PHP is that it will hang until your script is done.
The way around it is to start a new shell and redirect all output to null.

This will run your command in a new shell and will make PHP continue with the rest of your script right away. Great if you don't need the output or if you can read it later with javascript. e.g

exec('bash -c "sudo /some/command &>/dev/null &" &>/dev/null &');

*/



//Differences Between shell_exec(), exec(), and system()
/*

You can get return value of the executed command with the exec() function. e.g
	exec("ls",$o,$v);     --$o  is the output as an array. Print using print_r. The variable $v is the return value
	echo $v;

The exec() command only returns the last line of the output if you were to echo the command directly

 shell_exec() function will create a shell process and run given command
 With shell_exec() function we can not get return value of the shell process or command.
 Shell_exec(), is similar to the backtick operater.  e.g $output=`pwd`;   Both don't have return values 
 The shell_exec() will return the complete output as a string

 system()  will just return complete output as string. No need to use echo command or print separately

 passthru();

 The passthru() function is similar to the exec() function in that it executes a command. This function should be used in place of exec() or system() when the output from the Unix command is binary data which needs to be passed directly back to the browser. A common use for this is to execute something like the pbmplus utilities that can output an image stream directly. By setting the Content-type to image/gif and then calling a pbmplus program to output a gif, you can create PHP scripts that output images directly.

 	void passthru ( string $command [, int &$return_var ] )

*/

 /*

When allowing user-supplied data to be passed to this function, use escapeshellarg() or escapeshellcmd() to ensure that users cannot trick the system into executing arbitrary commands.

escapeshellarg() 
adds single quotes around a string and quotes/escapes any existing single quotes allowing you to pass a string directly to a shell function and having it be treated as a single safe argument. This function should be used to escape INDIVIDUAL arguments to shell functions coming from user input. The shell functions include exec(), system() and the backtick operator.

Example;
system('ls '.escapeshellarg($dir))


Note:
exec()
If a program is started with this function, in order for it to continue running in the background, the output of the program must be redirected to a file or another output stream. Failing to do so will cause PHP to hang until the execution of the program ends.

Note: When safe mode is enabled, you can only execute files within the safe_mode_exec_dir. For practical reasons, it is currently not allowed to have .. components in the path to the executable.

 */




//example of passthrough
//redirecting output to a file or another output stream
//running a bash script from php

//popen , proc_popen()