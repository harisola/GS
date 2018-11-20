<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Emg_msg extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('emergency/msg_emg_contact_person_model');
		$this->load->model('emergency/msg_emg_contact_type_model');
		$this->load->model('emergency/msg_emg_log_model');
		$this->load->model('emergency/msg_emg_message_model');
		$this->load->model('organization/users_model');
	}

	public function index()
	{
		if($this->data['can_user_add'] == 1){
			$this->form_validation->set_rules($this->msg_emg_log_model->validation);

			if(isset($_POST['message'])){
				$this->form_validation->set_rules($this->msg_emg_message_model->validation);
			}


			if($this->form_validation->run() == FALSE){

			}else{
				$this->add();
			}


			$this->emg_msg['contact_type'] = array($this->msg_emg_contact_type_model->get());
			$this->emg_msg['message'] = array($this->msg_emg_message_model->get());
			$this->load->view('emergency/message/emg_msg_add_orb');
		}


		// Loading footer
		$this->load->view('emergency/message/emg_msg_orb_footer');
	}


	public function add()
	{

		if(count($_POST))
		{
			/*$this->emg_persons['mobile_phone'] = array($this)*/
			$contact_type_id = $this->input->post('contact_id');
			$message_id = $this->input->post('msg_id');
			/*var_dump($contact_type_id . "__" . $message_id);*/


			// Saving Message Here
			if(strlen($this->input->post('message')) > 0) {
				$fireMessage = $this->input->post('message');
				$data = array(
					'name' => 'Custome Msg',
					'message' => $fireMessage
				);

				$saveMessageId = (int)$this->msg_emg_message_model->save($data);

				$data = array(
					'register_by' => (int)$this->session->userdata('user_id'),
					'contact_id' => (int)$this->input->post('contact_id'),
					'msg_id' => (int)$saveMessageId
				);


			}else{
				$data = array(
					'register_by' => (int)$this->session->userdata('user_id'),
					'contact_id' => (int)$this->input->post('contact_id'),
					'msg_id' => (int)$this->input->post('msg_id')
				);

				$fire['message'] = array($this->msg_emg_message_model->get_by(array('id =' => $message_id)));
				$fireMessage = $fire['message'][0][0]->message;
			}


			// Saving Log Here
			$msg_log_id = (int)$this->msg_emg_log_model->save($data);

			$message['mobile_phone'] = array($this->msg_emg_contact_person_model->get_by(array('type_id =' => $contact_type_id)));
			//var_dump($message['mobile_phone']);

			$url = 'http://localhost/android/getstudentscount.php';
			$this->MessageToPersons = count($message['mobile_phone'][0]);
			$this->ResponseFromServer = $this->get_data($url);

			/*$url = 'http://websms.eocean.pk/api/getbalance.php?username=generations&secret=4185219754c579754b6a47d118b5572a';
			$this->MessageBalance = $this->get_data($url);*/
			//$this->MessageBalance = file_get_contents($url);


			$mobile_phone_nos = "";
			foreach ($message['mobile_phone'][0] as $mobile_phone) {
				$mobile_phone_nos = $mobile_phone_nos . '92' . substr(str_replace("-", "", $mobile_phone->mobile_phone),1) . ",";
			}
			$mobile_phone_nos = rtrim($mobile_phone_nos, ",");

			$now = date('d-m-Y H:i');
			$MessageTimeStamp = $now;
			$fireMessage = str_replace("[TIMESTAMP]", $MessageTimeStamp, $fireMessage);
			$user_data = $this->users_model->get_by(array('id = ' => (int)$this->session->userdata('user_id')));
			$fireMessage = str_replace("[sender_id]", $user_data[0]->email , $fireMessage);
			$fireMessage = str_replace("@generations.gs", "", $fireMessage);
			$fireMessage = str_replace("@admin.com", "", $fireMessage);
			//$fireMessage = urlencode($fireMessage);

			/*********************** SMS 4 GEEK ***********************/
			$this->MessageBalance = "";
			/*$fireMessage = "This is Test Message. The quick brown fox jumps right over the lazy dog. this is an old sentence and it has all the alphabats of english. Urdu is an easy language, all the languages are easy except arabic. Arabic language has a huge vocabulary in the world.
			To ap logon ko chahiye k arabic language seekhin. you must learn arabic language. Arabic langauge is the most superior language in the world.";
			*/
			$msgHeaderChar = ":";
			$msgHeaderLength = 12;
			$msgLength = strlen($fireMessage);
			$msgTotal = 0;
			if($msgLength <= 160) {
				$msgTotal = 1;
				$msg1 = $fireMessage;
				//$this->MessageBalance = "Length: " . $msgLength . "<br>Total Msgs: " . $msgTotal . "<br>Msg1: ";
				//$fireMessage = urlencode($msg1);

			}else if($msgLength > 160 && $msgLength <= 306) {
				$msgTotal = 2;
				$msg1End = strrpos($fireMessage, ' ', -($msgLength - 161 + $msgHeaderLength));
				$msg1 = substr($fireMessage, 0, $msg1End);
				$msg2 = substr($fireMessage, strlen($msg1), $msgLength);
				$msg1 = "Msg 1/2" . $msgHeaderChar. $msg1;
				$msg2 = "Msg 2/2" . $msgHeaderChar. $msg2;
				//$this->MessageBalance = "Length: " . $msgLength . "<br>Total Msgs: " . $msgTotal . "<br>Msg1: " . $msg1 . "<br>Msg2: " . $msg2;
				//$fireMessage = urlencode($msg1 . $msg2);

			}else if($msgLength > 306 && $msgLength <= 459) {
				$msgTotal = 3;
				$msg1End = strrpos($fireMessage, ' ', -($msgLength - 161 + $msgHeaderLength));
				$msg1 = substr($fireMessage, 0, $msg1End);
				$msg2End = strrpos($fireMessage, ' ', -($msgLength - strlen($msg1) - 161 + $msgHeaderLength));
				$msg2 = substr($fireMessage, strlen($msg1), $msg2End-strlen($msg1));
				$msg3 = substr($fireMessage, strlen($msg2)+strlen($msg1), $msgLength);
				$msg1 = "Msg 1/3" . $msgHeaderChar. $msg1;
				$msg2 = "Msg 2/3" . $msgHeaderChar. $msg2;
				$msg3 = "Msg 3/3" . $msgHeaderChar. $msg3;
				//$this->MessageBalance = "Length: " . $msgLength . "<br>Total Msgs: " . $msgTotal . "<br>Msg1: " . $msg1 . "<br>Msg2: " . $msg2 . "<br>Msg3: " . $msg3;
				//$fireMessage = urlencode($msg1 . $msg2 . $msg3);

			}else if($msgLength > 459 && $msgLength <= 611) {
				$msgTotal = 4;
				$msg1End = strrpos($fireMessage, ' ', -($msgLength - 161 + $msgHeaderLength));
				$msg1 = substr($fireMessage, 0, $msg1End);
				$msg2End = strrpos($fireMessage, ' ', -($msgLength - strlen($msg1) - 161 + $msgHeaderLength));
				$msg2 = substr($fireMessage, strlen($msg1), $msg2End-strlen($msg1));
				$msg3End = strrpos($fireMessage, ' ', -($msgLength - strlen($msg1) - strlen($msg2) - 161 + $msgHeaderLength));
				$msg3 = substr($fireMessage, strlen($msg2)+strlen($msg1), $msg3End-strlen($msg1)-strlen($msg2));
				$msg4 = substr($fireMessage, strlen($msg3)+strlen($msg2)+strlen($msg1), $msgLength);
				$msg1 = "Msg 1/4" . $msgHeaderChar. $msg1;
				$msg2 = "Msg 2/4" . $msgHeaderChar. $msg2;
				$msg3 = "Msg 3/4" . $msgHeaderChar. $msg3;
				$msg4 = "Msg 4/4" . $msgHeaderChar. $msg4;
				/*$this->MessageBalance = "Length: " . $msgLength .
										"<br>Total Msgs: " . $msgTotal .
										"<br>Msg1: " . $msg1 . "Length: " . strlen($msg1) .
										"<br>Msg2: " . $msg2 . "Length: " . strlen($msg2) .
										"<br>Msg3: " . $msg3 . "Length: " . strlen($msg3) .
										"<br>Msg4: " . $msg4 . "Length: " . strlen($msg4);
				*/
				//$fireMessage = urlencode($msg1 . $msg2 . $msg3 . $msg4);
			}

			$thisNum = 1;
			$this->MessageBalance = 'Message: <br>' . $fireMessage . '<br><br>';
			foreach ($message['mobile_phone'][0] as $mobile_phone) {
				for($j=1; $j<=$msgTotal; $j++){
					if($j==1){$fireMessage = urlencode($msg1);}
					if($j==2){$fireMessage = urlencode($msg2);}
					if($j==3){$fireMessage = urlencode($msg3);}
					if($j==4){$fireMessage = urlencode($msg4);}

					$thisMobileNo = '0' . substr(str_replace("-", "", $mobile_phone->mobile_phone),1);
					$this->fullURL = "https://sms4geeks.appspot.com/smsgateway?action=out&username=gen1&password=123&msisdn=" . $thisMobileNo . "&msg=" . $fireMessage;
					//$this->MessageBalance = $this->fullURL;
					//160 + 146 = 306 + 153 = 459 + 152 = 611
					$this->MessageBalance = $this->MessageBalance . $thisNum . '. ' . $thisMobileNo . '...' . $this->get_data($this->fullURL) . "<br>";

					$thisNum++;
				}
			}

			/*********************** SMS 4 GEEK ***********************/

			// E-OCEAN
			/*http://websms.eocean.pk/api/sendsms.php?username=generations&secret=4185219754c579754b6a47d118b5572a&to=923135521122,923135521122&text=TEST MESSAGE*/
			//$this->fullURL = 'http://websms.eocean.pk/api/sendsms.php?username=generations&secret=4185219754c579754b6a47d118b5572a&to=' . $mobile_phone_nos . '&text=' . $fireMessage;


			// LifeTimeSMS.com
			/*http://LifetimeSMS.com/plain?username=xxxx&password=xxxx&to=44xxxxxxx&from=Brand&message=this+is+plain+api.*/
			//$this->fullURL = 'http://LifetimeSMS.com/plain?username=anajetli&password=theone1&to=' . $mobile_phone_nos . '&from=GENERATIONS&message=' . $fireMessage;

			/*********************** LIFE TIME SMS ***********************/
			//$sms = $this->LifetimeSms_JSON('anajetli','theone1',$mobile_phone_nos,'GENERATIONS',$fireMessage);
			//$this->MessageBalance = $sms;
			//die ("$sms");
			/*********************** LIFE TIME SMS ***********************/

			//$this->MessageBalance = $this->get_data($this->fullURL);
			//****** SUCCESS //$this->MessageBalance = $this->get_data($this->fullURL); ****** SUCCESS

			//$this->MessageBalance = $this->fullURL;
			//$this->MessageBalance = $this->get_data($this->fullURL);
			//$this->MessageBalance = $this->websmsSend($mobile_phone_nos, $fire['message'][0][0]->message);
			//redirect($this->fullURL,'refresh');
		}
	}


	function LifetimeSms_JSON($username,$password,$to,$from,$message)
	{
		$Lifetimesms_username = $username;
		$Lifetimesms_password = $password;
		$to = $to;
		$from = urlencode($from);
		$message = urlencode($message);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,'http://lifetimesms.com/json?username='.$Lifetimesms_username.'&password='.$Lifetimesms_password.'&to='.$to.'&from='.$from.'&message='.$message);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$chk= curl_exec ($ch);
		return $chk;
	}

	function SendSMSNow($MobilePhoneNumber, $Message)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,'https://sms4geeks.appspot.com/smsgateway?action=out&username=gen1&password=123&msisdn=' . $MobilePhoneNumber . "&msg=" . $Message);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$chk= curl_exec ($ch);
		return $chk;
	}


	function get_data($url) {
		//$url = str_replace(" ","%20",$url);
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

	function getHtml($url, $post = null) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		if(!empty($post)) {
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	function get_remote_data($url, $use_FOLLOWLOCATION=true, $post_paramtrs=false, $from_mobile=false )
	{
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
			if ($post_paramtrs){
		curl_setopt($c, CURLOPT_POST, TRUE);
		curl_setopt($c, CURLOPT_POSTFIELDS, "var1=bla&".$post_paramtrs);
			}
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($c, CURLOPT_USERAGENT, ($from_mobile) ? "Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420+ (KHTML, like Gecko) Version/3.0 Mobile/1C25 Safari/419.3" :  "Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0");
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($c, CURLOPT_MAXREDIRS, 10);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 9);
		curl_setopt($c, CURLOPT_TIMEOUT, 60);
		curl_setopt($c, CURLOPT_HEADER, true);
		curl_setopt($c, CURLOPT_REFERER, $url);
		curl_setopt($c, CURLOPT_ENCODING, 'gzip,deflate');
		curl_setopt($c, CURLOPT_AUTOREFERER, true);
			$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml," . "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
			$header[]="Cache-Control: max-age=0"; $header[]="Connection: keep-alive"; $header[]="Keep-Alive: 300"; $header[]="Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7"; $header[] = "Accept-Language: en-us,en;q=0.5"; $header[] = "Pragma: "; 
		curl_setopt($c, CURLOPT_HTTPHEADER, $header);

		//==========EXECUTE=========
		$got_html = curl_exec($c);
		$status   = curl_getinfo($c);
		curl_close($c);
		//if TURNED OFF "FOLLOWLOCATION"
		if (!$use_FOLLOWLOCATION){
			if($status['http_code']==200) { return $got_html; } else{
				if($status['http_code'] == 301 || $status['http_code'] == 302) {
					list($header) = explode("\r\n\r\n", $got_html, 2);
					preg_match("/(Location:|URI:)[^(\n)]*/", $header, $matches);
					$url = trim(str_replace($matches[1],"",$matches[0])); $url_parsed = parse_url($url);
					return (isset($url_parsed))? get_remote_data($url, $use_FOLLOWLOCATION, $post_paramtrs, $from_mobile ) : "ERRORCODE11:<br/>can't catch redirected url. LAST RESPONSE:<br/><br/>$got_html";
				}
				else{
					$oline=''; foreach($status as $key=>$eline){$oline.='['.$key.']'.$eline.' ';}
					$line =$oline." <br/> ".$url."<br/>-----------------<br/>";
					return "ERRORCODE13:<br/>$line";
				}
			}
		}
	}


	function httpRequest($url){
		$pattern = "/http...([0-9a-zA-Z-.]*).([0-9]*).(.*)/";
		preg_match($pattern,$url,$args);
		$in = "";
		$fp = fsockopen("$args[1]", $args[2], $errno, $errstr, 30);
		//$fp = fsockopen($args[1], intval($args[2]), $errno, $errstr, 30);
		if (!$fp) {
			return("$errstr ($errno)");
		} else {
			$out = "GET /$args[3] HTTP/1.1\r\n";
			$out .= "Host: $args[1]:$args[2]\r\n";
			$out .= "User-agent: PHP Web SMS client\r\n";
			$out .= "Accept: */*\r\n";
			$out .= "Connection: Close\r\n\r\n";

			fwrite($fp, $out);
			while (!feof($fp)) {
				$in.=fgets($fp, 128);
			}
		}
		fclose($fp);
		return($in);
	}

	function websmsSend($phone, $msg, $debug=false){
		$username = 'generations';
		$secret_key = '4185219754c579754b6a47d118b5572a';
		$smsurl = 'http://websms.eocean.pk/api/sendsms.php?';

		$url = 'username='.$username;
		$url.= '&secret='.$secret_key;
		$url.= '&to='.urlencode($phone);
		$url.= '&text='.urlencode($msg);

		$urltouse =  $smsurl.$url;
		if ($debug) { echo "Request: <br>$urltouse<br><br>"; }

		//Open the URL to send the message
		$response = $this->httpRequest($urltouse);
		if ($debug) {
			echo "Response: <br><pre>".
			str_replace(array("<",">"),array("&lt;","&gt;"),$response).
			"</pre><br>"; }

		return($response);
	}

	//****** SUCCESS //$this->MessageBalance = $this->get_data($this->fullURL); ****** SUCCESS
}
