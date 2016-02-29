<?php

class Filerequest extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->helper(array('form', 'url', 'codegen_helper'));
    $this->load->library('email');
  }

  /**
   * INDEX PAGE
   */
  function index() {
  	 	
  	$post = '';
    $FileName = NULL;
    $Email = NULL;
    if ($this->input->raw_input_stream) {
      $post = json_decode($this->input->raw_input_stream);
      $FileName = isset($post->FileName) ? $post->FileName : NULL;
      $Email = isset($post->Email) ? $post->Email : NULL;
    }
    
    $this->data['FileName'] = $FileName;
    $this->data['Email'] = $Email;
    
    
    $this->data['EmailMessage'] = $this->sendmailto($Email, $FileName);
    
    echo json_encode($this->data);
  }
  
  function sendmail($yourMail,$FileName)
  {
  	$this->load->library('email'); // load email library
  	$this->email->from('perpustakaan.p2e@gmail.com', 'Perpustakaan P2E LIPI');
  	$this->email->to($yourMail);
  	$this->email->subject('Permintaan Download File  Perpustakaan P2E LIPI');
  	$this->email->message('Salam ... Berikut ini kami kirim file yang Anda perlukan.');
  	// $this->email->attach(base_url().'uploads/'.$FileName); // attach file
  	if ($this->email->send()) {
  		return  "Mail Sent!";
  	}
  	else {
  		return  "There is error in sending mail!";
  	}
  }
  
  function kirimemail()
  {
  	$this->load->library('email'); // load email library
  	$this->email->from('perpustakaan.p2e@gmail.com', 'Perpustakaan P2E LIPI');
  	$this->email->to('afton@sangsurya.com');
  	$this->email->subject('Permintaan Download File  Perpustakaan P2E LIPI');
  	$this->email->message('Salam ... Berikut ini kami kirim file yang Anda perlukan.');
  	$this->email->send();
  	echo $this->email->print_debugger();
  }
  
  
  function sendmailto($email, $filename) {
  	$this->load->library('my_email');
  	
  	$subject = 'Permintaan File';
  	$message = '<p>This message has been sent for testing purposes.</p> '.$filename;
  	
  	// Get full html:
  	$body =
  	'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset='.strtolower(config_item('charset')).'" />
    <title>'.html_escape($subject).'</title>
    <style type="text/css">
        body {
            font-family: Arial, Verdana, Helvetica, sans-serif;
            font-size: 16px;
        }
    </style>
</head>
<body>
'.$message.'
</body>
</html>';
  	// Also, for getting full html you may use the following internal method:
  	//$body = $this->email->full_html($subject, $message);
  	
//   	$result = $this->email
//   	->from('perpustakaan.p2e@gmail.com')
//   	->reply_to('afton7@gmail.com')    // Optional, an account where a human being reads.
//   	->to($email)
//   	->subject($subject)
//   	->message($body)
//   	->send();
  	
//   	return $result;
  	// var_dump($result);
  	// echo '<br />';
  	// return $this->email->print_debugger();
  	
  	// exit;
  	
  	$mail = new MY_Email();
  	$mail->smtp_host = "smtp.gmail.com";
  	$mail->smtp_pass = "Bi5millah";
  	$mail->smtp_user = "perpustakaan.p2e@gmail.com";
  	
  	$mail->from('perpustakaan.p2e@google.com');
  	$mail->to($email);
//   	$mail->to('afton@sangsurya.com');
  	$mail->subject("Perpustakaan P2E : Permintaan Download File");
  	$mail->full_html($subject, $message);
  	// $mail->body() = $body;
  	if ($mail->send()){
  		return TRUE;
  	} else {
  		return FALSE;
  	}
  }

}

/* End of file laporanpenelitian.php */
/* Location: ./system/application/controllers/laporanpenelitian.php */