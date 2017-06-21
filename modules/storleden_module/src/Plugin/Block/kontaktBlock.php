<?php
namespace Drupal\storleden_module\Plugin\Block;

use Drupal\Core\Block\BlockBase; 
 use Drupal\Core\Form\FormBuilderInterface; 
 use Drupal\Core\Form\FormStateInterface;
 use Drupal\Core\File\File;
 use Drupal\Core\Form\FormInterface;

 


#use Drupal\Core\Entity\Query\QueryInterface
/**
 *
 * @Block(
 *   id = "kontaktblock",
 *   admin_label = @Translation("Kontakt Block"),
 *   category = @Translation("Storleden")
 * )
 */
class kontaktBlock extends BlockBase {
  
  /**
   * On block call and build
   *
   * @return string
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\storleden_module\Form\kontaktForm');
    $config = $this->getConfiguration();

    return array(
            '#theme' => 'kontakt',            
            '#form' => ['form' => $form,
                         'ingress' => $config['form_ingress']['value'],
            ],
            '#attached' => array(
        'library' => array(
          'storleden_module/storleden_lib',
        ),
      ), 
        );
  }

 
     /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['form_ingress'] = array(
      '#type' => 'text_format',
      '#format' => 'full_html',
      '#title' => $this->t('Ingress'),
      '#description' => $this->t('Ingress for Team'),
      '#default_value' => $config['form_ingress']['value']
    );
    

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['form_ingress'] = $values['form_ingress'];

  }

}