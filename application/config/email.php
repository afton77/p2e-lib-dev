<?php defined('BASEPATH') OR exit('No direct script access allowed.');

$config['useragent']        = 'PHPMailer';              // Mail engine switcher: 'CodeIgniter' or 'PHPMailer'
// $config['useragent']        = 'CodeIgniter';
$config['protocol']         = 'smtp';                   // 'mail', 'sendmail', or 'smtp'
// $config['mailpath']         = '/usr/sbin/sendmail';
$config['mailpath']	= "D:\server\xampp\mailtodisk\mailtodisk.exe";
// $config['smtp_host']        = 'smtp.gmail.com';
// $config['smtp_host']    	= 'ssl://smtp.gmail.com';
$config['smtp_host']    	= '10.1.2.32';
$config['smtp_port']		= '25';
  	
// $config['smtp_user']        = 'perpustakaan.p2e@gmail.com';
$config['smtp_user']        = 'xupj21amr';
// $config['smtp_pass']        = 'Bi5millah';
// $config['smtp_port']        = 25;
$config['smtp_timeout']     = 30;                        // (in seconds)
// $config['smtp_crypto']      = '';                       // '' or 'tls' or 'ssl'
$config['smtp_debug']       = 3;                        // PHPMailer's SMTP debug info level: 0 = off, 1 = commands, 2 = commands and data, 3 = as 2 plus connection status, 4 = low level data output.
// $config['wordwrap']         = true;
// $config['wrapchars']        = 76;
$config['mailtype']         = 'html';                   // 'text' or 'html'
// $config['charset']          = 'UTF-8';                     // 'UTF-8', 'ISO-8859-15', ...; NULL (preferable) means config_item('charset'), i.e. the character set of the site.
$config['validate']         = true;
$config['priority']         = 3;                        // 1, 2, 3, 4, 5; on PHPMailer useragent NULL is a possible option, it means that X-priority header is not set at all, see https://github.com/PHPMailer/PHPMailer/issues/449
$config['crlf']             = "\n";                     // "\r\n" or "\n" or "\r"
$config['newline']          = "\n";                     // "\r\n" or "\n" or "\r"
$config['bcc_batch_mode']   = false;
$config['bcc_batch_size']   = 200;
$config['encoding']         = '8bit';                   // The body encoding. For CodeIgniter: '8bit' or '7bit'. For PHPMailer: '8bit', '7bit', 'binary', 'base64', or 'quoted-printable'.
