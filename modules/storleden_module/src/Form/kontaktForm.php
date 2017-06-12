<?php

namespace Drupal\storleden_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements an contact2 form.
 */
class kontaktForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'contact2_form';
  }

  /**
   * {@inheritdoc}
   */

  // These are the values for the checkboxes, change here and it will work directly.
  static $option_array = array( 0 => 'Webbplats', 'System', 'Vidareutveckling', 'Applikation', 'Film');

  public function buildForm(array $form, FormStateInterface $form_state) {


    $form['#method'] = 'post';

    

    $form['name'] = [
      '#type' => 'textfield',
      '#required' => TRUE,
      '#placeholder' => 'Namn',
    ];

    $form['email'] = [
      '#type' => 'email',
      '#required' => TRUE,
      '#placeholder' => 'Epost', //'Din@epost.här',
    ];

    $form['company'] = [
      '#type' => 'textfield',
      '#placeholder' => 'Företag',
    ];

    $form['phone'] = [
      '#type' => 'textfield',
      '#placeholder' => 'Telefon nummer',
    ];


    $option_array = $this::$option_array; // defined near row 25
    $values = array();
    foreach ($option_array as $value) {
      $values[$value] = $value;
    }
    $form['check_boxes'] = [
      '#type' => 'checkboxes',
      // '#title' => 'Vad kan vi hjälpa dig med?',
      '#options' => $values,
    ];



    $form['description'] = [
      '#type' => 'textfield',
      '#placeholder' => 'Berätta gärna mer om projektet',
      '#size' => 135 ,
    ];

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

    if (strlen($form_state->getValue('name')) < 1) {

      $form_state->setErrorByName(
        'name',
        $this->t('Namn krävs.')
      );

    };

    if (strlen($form_state->getValue('email')) < 1) {

      $form_state->setErrorByName(
        'email',
        $this->t('Email krävs.')
      );

    }

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

// ---- ---- ---- ----
/*
    $check_status = $form_state->getValue('check_boxes'); // get checked status
    $option_array = $this::$option_array; // make a function-local copy (removes $this:: )
    $array_length = count($option_array);
    $message = '';

    foreach ($option_array as $key => $value) { // remove all unchecked values
      if (empty($message)) {
        if ($check_status[$value] === 0) {
          continue 1;
        }
        else{
        }
          $message = $check_status[$value];
      }
      else {
        if ($check_status[$value] === 0) {
          continue 1;
        }
        else{
          $message .= ', ' . $check_status[$value];
        }
      }
    }
    $form_state->setValue('checked_boxes', $message); // assign "cleaned" values to new variable.

// ---- ---- ---- ----

    $name     = $form_state->getValue('name');
    $email     = $form_state->getValue('email');
    $phone      = $form_state->getValue('phone');
    $company      = $form_state->getValue('company');
    $description  = $form_state->getValue('description');
    $checked_boxes = $form_state->getValue('checked_boxes');

    $to      = 'sebbes333@gmail.com';
    $form    = $form_state->getValue('email');;
    $subject = 'Kontakt Formulär Storleden';
    $message =
"Namn: {$name}
Epost: {$email}
Företag: {$company}
Telefon: {$phone}
Kategorier: {$checked_boxes}
Beskrivning: {$description}"; // Don't change the structure of this string, unless you want tot change the message.
    $message = wordwrap($message, 70, "\r\n");

    $succes_status = mail ($to, $subject, $message);

    if($succes_status){
      drupal_set_message(t('Medelandet är sänt'), 'status');
     }
    else{
      drupal_set_message(t('Kunde inte sända medelandet, försök igen.'), 'error');
     }
*/
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }
    
  } // end function
}// end class

