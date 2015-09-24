<?php
function index()
{
	function shutdown() {
		posix_kill(posix_getpid(), SIGHUP);
	}
	// Do some initial processing

	echo("Hello World");

       // Switch over to daemon mode.

       if ($pid = pcntl_fork())
	           return;     // Parent

	ob_end_clean(); // Discard the output buffer and close

        fclose(STDIN);  // Close all of the standard
	fclose(STDOUT); // file descriptors as we
        fclose(STDERR); // are running as a daemon.

	 register_shutdown_function('shutdown');

	if (posix_setsid() < 0)
		return;

	if ($pid = pcntl_fork())
	         return;     // Parent

	// Now running as a daemon. This process will even survive
       // an apachectl stop.

	sleep(10);
	
	$fp = fopen("/tmp/sdf123", "w");
	fprintf($fp, "PID = %s\n", posix_getpid());													
	fclose($fp);								
	return;
																			
}
																				    ?>
