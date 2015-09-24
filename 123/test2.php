<?
echo "This is an echo before I called the fork command\n";

$pid = pcntl_fork();
if ($pid == -1) {
   die("could not fork");
   } else if ($pid) {
      echo "I am the parent, pid = ". $pid ."\n";
      } else {
         echo "I am the child, pid = ". $pid ."\n";
	 }
	 echo "This is an echo after I called the fork command\n";
	 ?>
