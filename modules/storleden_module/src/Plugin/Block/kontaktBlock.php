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


    return array(
            '#theme' => 'kontakt',            
            '#form' => $form ,
            '#attached' => array(
        'library' => array(
          'storleden_module/storleden_lib',
        ),
      ), 
        );
  }

 

}