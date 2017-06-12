<?php
/**
 * @file
 * Contains \Drupal\storleden_module\Plugin\Block\kontaktForTestBlock.
 */
namespace Drupal\storleden_module\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;
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
    
    return array(
            '#theme' => 'kontakt_for_test',            
            '#form' => $form,
            '#attached' => array(
                  'library' => array(
                  'storleden_module/storleden_lib',
                ),
            ),
        );
   }
}