<?php
/**
 * @file
 * Contains \Drupal\storleden_module\Plugin\Block\kontaktForTestBlock.
 */
namespace Drupal\storleden_module\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;
 use Drupal\Core\Form\FormBuilderInterface; 
 use Drupal\Core\Form\FormStateInterface;
/**
 * Provides a 'article' block.
 *
 * @Block(
 *   id = "kontaktfortest",
 *   admin_label = @Translation("Kontakt for test a product"),
 *   category = @Translation("Storleden")
 * )
 */
class kontaktForTestBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\storleden_module\Form\kontaktForTestForm');
    $config = $this->getConfiguration();
    return array(
            '#theme' => 'kontakt_for_test',            
            '#form' => [ 'form' => $form, 
                          'ingress' => $config['form_ingress']
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
      '#type' => 'textarea',
      '#title' => $this->t('Form ingress'),
      '#description' => $this->t('Ingress for kontakt form'),
      '#default_value' => isset($config['form_ingress']) ? $config['form_ingress'] : 'ÄR DU INTRESERAD AV ATT TESTA? ÖNSKAR DU MER INFORMATION? KONTAKTA OSS!',
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