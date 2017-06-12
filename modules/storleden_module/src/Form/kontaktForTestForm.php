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
      '#type' => 'textfield',
      '#placeholder' => t('Namn'),
      '#required' => TRUE,
    );
    $form['company'] = array(
      '#type' => 'textfield',
      '#placeholder' => t('Företag'),
      '#required' => TRUE,
    );
    $form['email'] = array(
      '#type' => 'email',
      '#placeholder' => t('E-post'),
      '#required' => TRUE,
    );
    $form['phone'] = array (
      '#type' => 'textfield',
      '#placeholder' => t('Telefonnummer'),
    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Skicka'),
      '#button_type' => 'primary',
    );
    return $form;
  }


  /**
   * {@inheritdoc}
   */
    public function validateForm(array &$form, FormStateInterface $form_state) {
      if (strlen($form_state->getValue('phone')) < 10) {
        $form_state->setErrorByName('candidate_number', $this->t('Mobile number is too short.'));
      }
    }



  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
   // drupal_set_message($this->t('@can_name ,Your application is being submitted!', array('@can_name' => $form_state->getValue('candidate_name'))));
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }
   }

}