<?php
/**
* Simple Logger Class
* @author Josh Nesbitt <josh@josh-nesbitt.net>
*
* By default will write to /log/filename.log
*
**/
class Logger {
  var $file, $level, $stream;
  const INFO  = 4;
  const WARN  = 3;
  const DEBUG = 2;
  const ERROR = 1;
  const FATAL = 0;
  
	function __construct($file, $level)
	{
		$this->file = $file;
		$this->level = $level;
		$this->stream = fopen($_SERVER["DOCUMENT_ROOT"] . "/log/$this->file", "a") or die("Cannot write to file '$this->path'");
	}
	
	function info($string)
	{
	  if($this->level < self::INFO) return true;
	  $this->log($string);
	}
	
	function warn($string)
	{
	  if($this->level < self::WARN) return true;
	  $this->log($string);
	}
	
	function debug($string)
	{
	  if($this->level < self::DEBUG) return true;
	  $this->log($string);
	}
	
	function error($string)
	{
	  if($this->level < self::ERROR) return true;
	  $this->log($string);
	}
	
	function fatal($string)
	{
	  if($this->level < self::FATAL) return true;
	  $this->log($string);
	}
	
	private function log($string)
	{
	  $this->write("[". date('l jS F Y : h:i:sa') . "] ". $string . "\r\n");
	}
	
	private function write($string)
	{
	  return fwrite($this->stream, $string);
	}
	
	private function cut()
	{
	  return fclose($this->stream);
	}
}

$logger = new Logger("development.log", Logger::INFO);

$logger->info("--> info");
$logger->warn("--> warn");
$logger->debug("--> debug");
$logger->error("--> error");
$logger->fatal("--> fatal");

# TODO: finish me...

?>