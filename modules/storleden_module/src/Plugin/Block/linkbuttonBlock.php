<?php

/**
 * @file
 */
namespace Drupal\storleden_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;

use Drupal\Core\Form\FormState;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'linkbutton' Block.
 * @Block(
 *  id = "linkbutton",
 *  admin_label = @Translation("Link button."),
 * )
 */

class linkbuttonBlock extends BlockBase implements BlockPluginInterface {
  /**
   * {@inheritdoc}
   *
   * On block call an build
   *
   * @return string
   *
   **/

  public function blockForm($form, FormStateInterface $form_state){

    $form = parent::blockForm($form, $form_state);
    $config = $this->getConfiguration();

    $form['button_Name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Button name'),
      '#description' => $this->t('Namnet som ska visas på knappen'),
      '#default_value' => isset($config['button_Name']) ? $config['button_Name'] : '',
    ];

    $form['button_URL'] = [
      '#type' => 'textfield',
      '#title' => $this->t('URL'),
      '#description' => $this->t('URL länk till dit den som klickar på knappen ska bli skickad.'),
      '#default_value' => isset($config['button_URL']) ? $config['button_URL'] : '',
    ];

    $form['send_Type']['active'] = [
      '#type' => 'radios',
      '#title' => $this->t('Protokoll'),
      '#default_value' => 'get',
      '#options' => [
        'get'  => $this->t('Get'),
        'post' => $this->t('Post')
      ],
      '#description' => $this->t('Get (default) rekomenderas.'),
    ];

    return $form;
  }



  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);

    $values = $form_state->getValues();
    $this->configuration['send_Type']   = $values['send_Type']['active'];
    $this->configuration['button_URL']  = $values['button_URL'];
    $this->configuration['button_Name'] = $values['button_Name'];
  }



  public function build() {
    return [
      '#theme' => 'linkbutton',
      //'#sendMethod' => $this->configuration['send_Type']['active'],
      '#url'        => $this->configuration['button_URL'],
      '#buttonName' => $this->configuration['button_Name'],

      '#attached' => array(
        'library' => array(
          'storleden_module/storleden_lib',
                    ),
              ), 
    ];
  }

}
