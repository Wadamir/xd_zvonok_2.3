<?php
class ControllerExtensionModuleXDZvonok extends Controller
{
    private $error = array();
    public function index()
    {
        $this->load->language('extension/module/xd_zvonok');
        $this->document->setTitle($this->language->get('heading_name'));
        $this->load->model('setting/setting');
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('xd_zvonok_', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL'));
        }
        // Heading
        $data['heading_title'] = $this->language->get('heading_title');
        $data['heading_name'] = $this->language->get('heading_name');
        // Text
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        //Buttons
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        // Fields
        $data['field1_title'] = $this->language->get('field1_title');
        $data['field2_title'] = $this->language->get('field2_title');
        $data['field3_title'] = $this->language->get('field3_title');

        $data['agree_title'] = $this->language->get('agree_title');
        $data['field_required'] = $this->language->get('field_required');
        // Phone validation
        $data['entry_validation_type'] = $this->language->get('entry_validation_type');
        $data['text_validation_type0'] = $this->language->get('text_validation_type0');
        $data['text_validation_type1'] = $this->language->get('text_validation_type1');
        $data['text_validation_type2'] = $this->language->get('text_validation_type2');
        $data['value_validation_type1'] = $this->language->get('value_validation_type1');
        $data['value_validation_type2'] = $this->language->get('value_validation_type2');
        // Captcha
        $data['entry_captcha'] = $this->language->get('entry_captcha');
        $data['text_none'] = $this->language->get('text_none');
        // Entry
        $data['entry_button_name'] = $this->language->get('entry_button_name');
        $data['entry_status'] = $this->language->get('entry_status');
        // $data['entry_style_status'] = $this->language->get('entry_style_status');
        $data['entry_success_field'] = $this->language->get('entry_success_field');
        $data['success_field_tooltip'] = htmlspecialchars($this->language->get('success_field_tooltip'));

        $this->load->model('catalog/information');
        $data['informations'] = $this->model_catalog_information->getInformations();
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        if (isset($this->error['name'])) {
            $data['error_name'] = $this->error['name'];
        } else {
            $data['error_name'] = '';
        }
        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
        );
        if (!isset($this->request->get['module_id'])) {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('extension/module/xd_zvonok', 'token=' . $this->session->data['token'], true)
            );
        } else {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('extension/module/xd_zvonok', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], true)
            );
        }
        if (!isset($this->request->get['module_id'])) {
            $data['action'] = $this->url->link('extension/module/xd_zvonok', 'token=' . $this->session->data['token'], true);
        } else {
            $data['action'] = $this->url->link('extension/module/xd_zvonok', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], true);
        }
        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

        $this->load->model('localisation/language');
        $data['languages'] = $this->model_localisation_language->getLanguages();
        $languages = $this->model_localisation_language->getLanguages();
        foreach ($languages as $language) {
            if (isset($this->request->post['xd_zvonok_name_' . $language['language_id']])) {
                $data['xd_zvonok_button_name_' . $language['language_id']] = $this->request->post['xd_zvonok_button_name_' . $language['language_id']];
                $data['xd_zvonok_success_field_' . $language['language_id']] = $this->request->post['xd_zvonok_success_field_' . $language['language_id']];
            } else {
                $data['xd_zvonok_button_name_' . $language['language_id']] = $this->config->get('xd_zvonok_button_name_' . $language['language_id']);
                $data['xd_zvonok_success_field_' . $language['language_id']] = $this->config->get('xd_zvonok_success_field_' . $language['language_id']);
            }
        }

        /********************* Captchas ********************************/
        if (isset($this->request->post['xd_zvonok_captcha'])) {
            $data['xd_zvonok_captcha'] = $this->request->post['xd_zvonok_captcha'];
        } else {
            $data['xd_zvonok_captcha'] = $this->config->get('xd_zvonok_captcha');
        }

        $this->load->model('extension/extension');

        $data['captchas'] = array();
        // Get a list of installed captchas
        $extensions = $this->model_extension_extension->getInstalled('captcha');
        foreach ($extensions as $code) {
            $this->load->language('extension/captcha/' . $code);

            if ($this->config->get($code . '_status')) {
                $data['captchas'][] = array(
                    'text'  => $this->language->get('heading_title'),
                    'value' => $code
                );
            }
        }

        /********************* Modal window fields *********************/
        if (isset($this->request->post['xd_zvonok_field1_status'])) {
            $data['xd_zvonok_field1_status'] = $this->request->post['xd_zvonok_field1_status'];
        } else {
            $data['xd_zvonok_field1_status'] = $this->config->get('xd_zvonok_field1_status');
        }
        if (isset($this->request->post['xd_zvonok_field1_required'])) {
            $data['xd_zvonok_field1_required'] = $this->request->post['xd_zvonok_field1_required'];
        } else {
            $data['xd_zvonok_field1_required'] = $this->config->get('xd_zvonok_field1_required');
        }
        if (isset($this->request->post['xd_zvonok_field2_status'])) {
            $data['xd_zvonok_field2_status'] = $this->request->post['xd_zvonok_field2_status'];
        } else {
            $data['xd_zvonok_field2_status'] = $this->config->get('xd_zvonok_field2_status');
        }
        if (isset($this->request->post['xd_zvonok_field2_required'])) {
            $data['xd_zvonok_field2_required'] = $this->request->post['xd_zvonok_field2_required'];
        } else {
            $data['xd_zvonok_field2_required'] = $this->config->get('xd_zvonok_field2_required');
        }
        if (isset($this->request->post['xd_zvonok_field3_status'])) {
            $data['xd_zvonok_field3_status'] = $this->request->post['xd_zvonok_field3_status'];
        } else {
            $data['xd_zvonok_field3_status'] = $this->config->get('xd_zvonok_field3_status');
        }
        if (isset($this->request->post['xd_zvonok_field3_required'])) {
            $data['xd_zvonok_field3_required'] = $this->request->post['xd_zvonok_field3_required'];
        } else {
            $data['xd_zvonok_field3_required'] = $this->config->get('xd_zvonok_field3_required');
        }

        if (isset($this->request->post['xd_zvonok_agree_status'])) {
            $data['xd_zvonok_agree_status'] = $this->request->post['xd_zvonok_agree_status'];
        } else {
            $data['xd_zvonok_agree_status'] = $this->config->get('xd_zvonok_agree_status');
        }
        if (isset($this->request->post['xd_zvonok_validation_type'])) {
            $data['xd_zvonok_validation_type'] = $this->request->post['xd_zvonok_validation_type'];
        } else {
            $data['xd_zvonok_validation_type'] = $this->config->get('xd_zvonok_validation_type');
        }
        /********************* STATUS *********************/
        if (isset($this->request->post['xd_zvonok_status'])) {
            $data['xd_zvonok_status'] = $this->request->post['xd_zvonok_status'];
        } else {
            $data['xd_zvonok_status'] = $this->config->get('xd_zvonok_status');
        }
        /*
		if (isset($this->request->post['xd_zvonok_style_status'])) {
			$data['xd_zvonok_style_status'] = $this->request->post['xd_zvonok_style_status'];
		} else {
			$data['xd_zvonok_style_status'] = $this->config->get('xd_zvonok_style_status');
		}
		*/
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('extension/module/xd_zvonok.tpl', $data));
    }
    protected function validate()
    {
        if (!$this->user->hasPermission('modify', 'extension/module/xd_zvonok')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }
}
