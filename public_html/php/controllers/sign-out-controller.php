<?php
/**
 * controller for the logging out
 *
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com
 * contributing code from TruFork https://github.com/Skylarity/trufork
 */

if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
unset($_SESSION[]);//TODO what should I do here? another line for administrator? Can I leave [] blank and have all sessions deleted?
header("Location:index.php");