<?php

namespace Drupal\storleden_module\Form;

/**
 * @file
 * Contains \Drupal\storleden_module\Form\kontaKtForTestForm.
 */

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class kontaktForTestForm extends FormBase {
	/**
	 * {@inheritdoc}
	 */
	public function getFormId() {
		return 'resume_form';
	}

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(array $form, FormStateInterface $form_state) {
		$form['name'] = array(
			'#type'        => 'textfield',
			'#placeholder' => t('Namn'),
			'#required'    => TRUE,
		);
		$form['company'] = array(
			'#type'        => 'textfield',
			'#placeholder' => t('Företag'),
			'#required'    => TRUE,
		);
		$form['email'] = array(
			'#type'        => 'email',
			'#placeholder' => t('E-post'),
			'#required'    => TRUE,
		);
		$form['phone'] = array(
			'#type'        => 'textfield',
			'#placeholder' => t('Telefonnummer'),
		);
		$form['actions']['#type']  = 'actions';
		$form['actions']['submit'] = array(
			'#type'        => 'submit',
			'#value'       => $this->t('Skicka'),
			'#button_type' => 'primary',
		);
		return $form;
	}

	/**
	 * {@inheritdoc}
	 */
	public function validateForm(array&$form, FormStateInterface $form_state) {
		if (strlen($form_state->getValue('phone')) < 10) {
			$form_state->setErrorByName('candidate_number', $this->t('Mobile number is too short.'));
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function submitForm(array&$form, FormStateInterface $form_state) {

		$name    = $form_state->getValue('name');
		$company = $form_state->getValue('company');
		$email   = $form_state->getValue('email');
		$phone   = $form_state->getValue('phone');

		$subject = 'Kontaktformulär Storleden hemsida för information om produkt';
		$message =
		"Namn: {$name}
Epost: {$email}
Företag: {$company}
Telefon: {$phone}";// Don't change the structure of this string, unless you want tot change the message.

		$mailManager       = \Drupal::service('plugin.manager.mail');
		$module            = 'storleden_module';
		$key               = 'kontakt';// Replace with Your key
		$to                = \Drupal::config('system.site')->get('mail');
		$params['message'] = $message;
		$params['from']    = $form_state->getValue('email');
		$params['title']   = $subject;
		$langcode          = \Drupal::currentUser()->getPreferredLangcode();
		$send              = true;

		$result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);
		if ($result['result'] !== true) {
			$message = t('There was a problem sending your email notification to @email.', array('@email' => $to));
			drupal_set_message($message, 'error');
			\Drupal::logger('mail-log')->error($message);
			return;
		}

		$message = t('Tack! Ditt meddelande har skickats. ', array('@email' => $to));
		drupal_set_message($message);
		\Drupal::logger('mail-log')->notice($message);

	}

}