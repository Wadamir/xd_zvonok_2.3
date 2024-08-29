<?php
class ControllerExtensionModuleXDZvonok extends Controller {
	private $error = array();

	public function submit() {

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {

			$this->load->language('extension/module/xd_zvonok');
			$json = array();
			$mail_text = '';

			if (isset($this->request->post['xd_zvonok_name'])) {
				$xd_zvonok_name = $this->request->post['xd_zvonok_name'];
				$mail_text .= $this->language->get('text_name') . $xd_zvonok_name . " \r\n";
			}

			if (isset($this->request->post['xd_zvonok_phone'])) {
				$xd_zvonok_phone = $this->request->post['xd_zvonok_phone'];
				$mail_text .= $this->language->get('text_phone') . $xd_zvonok_phone . " \r\n";
			}

			if (isset($this->request->post['xd_zvonok_message'])) {
				$xd_zvonok_message = $this->request->post['xd_zvonok_message'];
				$mail_text .= $this->language->get('text_message') . $xd_zvonok_message . " \r\n";
			}

			if (!empty($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];
				$mail_text .= $this->language->get('text_ip') . $ip . " \r\n";
			}

			if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
				$forwarded_ip = $this->request->server['HTTP_X_FORWARDED_FOR'];
				$mail_text .= $this->language->get('text_forwarded_ip') . $forwarded_ip . " \r\n";
			} elseif (!empty($this->request->server['HTTP_CLIENT_IP'])) {
				$forwarded_ip = $this->request->server['HTTP_CLIENT_IP'];
				$mail_text .= $this->language->get('text_forwarded_ip') . $forwarded_ip . " \r\n";
			}

			if (isset($this->request->server['HTTP_USER_AGENT'])) {
				$user_agent = $this->request->server['HTTP_USER_AGENT'];
				$mail_text .= $this->language->get('text_user_agent') . $user_agent . " \r\n";
			}
			/*
			// Source first visit
			$mail_text .= " \r\n" . $this->language->get('sb_first_visit_title') . " \r\n";
			if (isset($this->request->post['sb_first_typ']) && $this->request->post['sb_first_typ'] != '') {
				$sb_first_typ = $this->request->post['sb_first_typ'];
				$mail_text .= $this->language->get('sb_first_typ') . $sb_first_typ . " \r\n";
			}
			if (isset($this->request->post['sb_first_src']) && $this->request->post['sb_first_src'] != '') {
				$sb_first_src = $this->request->post['sb_first_src'];
				$mail_text .= $this->language->get('sb_first_src') . $sb_first_src . " \r\n";
			}
			if (isset($this->request->post['sb_first_mdm']) && $this->request->post['sb_first_mdm'] != '') {
				$sb_first_mdm = $this->request->post['sb_first_mdm'];
				$mail_text .= $this->language->get('sb_first_mdm') . $sb_first_mdm . " \r\n";
			}
			if (isset($this->request->post['sb_first_cmp']) && $this->request->post['sb_first_cmp'] != '') {
				$sb_first_cmp = $this->request->post['sb_first_cmp'];
				$mail_text .= $this->language->get('sb_first_cmp') . $sb_first_cmp . " \r\n";
			}
			if (isset($this->request->post['sb_first_cnt']) && $this->request->post['sb_first_cnt'] != '') {
				$sb_first_cnt = $this->request->post['sb_first_cnt'];
				$mail_text .= $this->language->get('sb_first_cnt') . $sb_first_cnt . " \r\n";
			}
			if (isset($this->request->post['sb_first_trm']) && $this->request->post['sb_first_trm'] != '') {
				$sb_first_trm = $this->request->post['sb_first_trm'];
				$mail_text .= $this->language->get('sb_first_trm') . $sb_first_trm . " \r\n";
			}
			if (isset($this->request->post['sb_first_add_fd']) && $this->request->post['sb_first_add_fd'] != '') {
				$sb_first_add_fd = $this->request->post['sb_first_add_fd'];
				$mail_text .= $this->language->get('sb_first_add_fd') . $sb_first_add_fd . " \r\n";
			}
			if (isset($this->request->post['sb_first_add_ep']) && $this->request->post['sb_first_add_ep'] != '') {
				$sb_first_add_ep = $this->request->post['sb_first_add_ep'];
				$mail_text .= $this->language->get('sb_first_add_ep') . $sb_first_add_ep . " \r\n";
			}
			if (isset($this->request->post['sb_first_add_rf']) && $this->request->post['sb_first_add_rf'] != '') {
				$sb_first_add_rf = $this->request->post['sb_first_add_rf'];
				$mail_text .= $this->language->get('sb_first_add_rf') . $sb_first_add_rf . " \r\n";
			}
			// Source first visit end

			// Source current visit
			$mail_text .= " \r\n" . $this->language->get('sb_current_visit_title') . " \r\n";
			if (isset($this->request->post['sb_current_typ']) && $this->request->post['sb_current_typ'] != '') {
				$sb_current_typ = $this->request->post['sb_current_typ'];
				$mail_text .= $this->language->get('sb_current_typ') . $sb_current_typ . " \r\n";
			}
			if (isset($this->request->post['sb_current_src']) && $this->request->post['sb_current_src'] != '') {
				$sb_current_src = $this->request->post['sb_current_src'];
				$mail_text .= $this->language->get('sb_current_src') . $sb_current_src . " \r\n";
			}
			if (isset($this->request->post['sb_current_mdm']) && $this->request->post['sb_current_mdm'] != '') {
				$sb_current_mdm = $this->request->post['sb_current_mdm'];
				$mail_text .= $this->language->get('sb_current_mdm') . $sb_current_mdm . " \r\n";
			}
			if (isset($this->request->post['sb_current_cmp']) && $this->request->post['sb_current_cmp'] != '') {
				$sb_current_cmp = $this->request->post['sb_current_cmp'];
				$mail_text .= $this->language->get('sb_current_cmp') . $sb_current_cmp . " \r\n";
			}
			if (isset($this->request->post['sb_current_cnt']) && $this->request->post['sb_current_cnt'] != '') {
				$sb_current_cnt = $this->request->post['sb_current_cnt'];
				$mail_text .= $this->language->get('sb_current_cnt') . $sb_current_cnt . " \r\n";
			}
			if (isset($this->request->post['sb_current_trm']) && $this->request->post['sb_current_trm'] != '') {
				$sb_current_trm = $this->request->post['sb_current_trm'];
				$mail_text .= $this->language->get('sb_current_trm') . $sb_current_trm . " \r\n";
			}
			if (isset($this->request->post['sb_current_add_fd']) && $this->request->post['sb_current_add_fd'] != '') {
				$sb_current_add_fd = $this->request->post['sb_current_add_fd'];
				$mail_text .= $this->language->get('sb_current_add_fd') . $sb_current_add_fd . " \r\n";
			}
			if (isset($this->request->post['sb_current_add_ep']) && $this->request->post['sb_current_add_ep'] != '') {
				$sb_current_add_ep = $this->request->post['sb_current_add_ep'];
				$mail_text .= $this->language->get('sb_current_add_ep') . $sb_current_add_ep . " \r\n";
			}
			if (isset($this->request->post['sb_current_add_rf']) && $this->request->post['sb_current_add_rf'] != '') {
				$sb_current_add_rf = $this->request->post['sb_current_add_rf'];
				$mail_text .= $this->language->get('sb_current_add_rf') . $sb_current_add_rf . " \r\n";
			}
			// Source current visit end

			// Current session
			$mail_text .= " \r\n" . $this->language->get('sb_session_title') . " \r\n";
			if (isset($this->request->post['sb_session_pgs']) && $this->request->post['sb_session_pgs'] != '') {
				$sb_session_pgs = $this->request->post['sb_session_pgs'];
				$mail_text .= $this->language->get('sb_session_pgs') . $sb_session_pgs . " \r\n";
			}
			if (isset($this->request->post['sb_session_cpg']) && $this->request->post['sb_session_cpg'] != '') {
				$sb_session_cpg = $this->request->post['sb_session_cpg'];
				$mail_text .= $this->language->get('sb_session_cpg') . $sb_session_cpg . " \r\n";
			}
			// Current session end

			// Private data
			$mail_text .= " \r\n" . $this->language->get('sb_private_title') . " \r\n";
			if (isset($this->request->post['sb_udata_vst']) && $this->request->post['sb_udata_vst'] != '') {
				$sb_udata_vst = $this->request->post['sb_udata_vst'];
				$mail_text .= $this->language->get('sb_udata_vst') . $sb_udata_vst . " \r\n";
			}
			if (isset($this->request->post['sb_udata_uip']) && $this->request->post['sb_udata_uip'] != '') {
				$sb_udata_uip = $this->request->post['sb_udata_uip'];
				$mail_text .= $this->language->get('sb_udata_uip') . $sb_udata_uip . " \r\n";
			}
			if (isset($this->request->post['sb_udata_uag']) && $this->request->post['sb_udata_uag'] != '') {
				$sb_udata_uag = $this->request->post['sb_udata_uag'];
				$mail_text .= $this->language->get('sb_udata_uag') . $sb_udata_uag . " \r\n";
			}
			if (isset($this->request->post['sb_promo_code']) && $this->request->post['sb_promo_code'] != '') {
				$sb_promo_code = $this->request->post['sb_promo_code'];
				$mail_text .= $this->language->get('sb_promo_code') . $sb_promo_code . " \r\n";
			}
			// Private data end
			*/
			$from_email = 'xd_zvonok@' . $_SERVER['SERVER_NAME'];
			$sender_name = $this->language->get('text_sender_name');
			$mail_title = sprintf($this->language->get('text_mail_title'), $this->config->get('config_name'));

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($this->config->get('config_email'));
			// $mail->setTo('domus159@gmail.com');
			$mail->setFrom($from_email);
			$mail->setSender($sender_name);
			$mail->setSubject($mail_title);
			$mail->setText($mail_text);
			$mail_result = $mail->send();
			
			// var_dump($this->config->get('config_alert_email'));
			
			$additional_emails = explode(',', $this->config->get('config_alert_email'));
			$regexp = $this->config->get('config_mail_regexp') ? $this->config->get('config_mail_regexp') : '/^[^\@]+@.*.[a-z]{2,15}$/i';

			foreach ($additional_emails as $email) {
				if ($email && preg_match($regexp, $email)) {
					$mail->setTo($email);
					$mail->send();
				}
			}			

			if (!$mail_result) {
				$json['success'] = 'Success sending';
			} else {
				$json['error'] = 'Error sending';
			}
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		} else {
			$json['error'] = 'Smth wrong... Error sending';
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		}

	}

	protected function validate() {
		if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 32)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if (!preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['email'])) {
			$this->error['email'] = $this->language->get('error_email');
		}

		if ((utf8_strlen($this->request->post['enquiry']) < 10) || (utf8_strlen($this->request->post['enquiry']) > 3000)) {
			$this->error['enquiry'] = $this->language->get('error_enquiry');
		}

		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('contact', (array)$this->config->get('config_captcha_page'))) {
			$captcha = $this->load->controller('captcha/' . $this->config->get('config_captcha') . '/validate');

			if ($captcha) {
				$this->error['captcha'] = $captcha;
			}
		}

		return !$this->error;
	}
}