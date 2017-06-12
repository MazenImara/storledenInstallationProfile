<?php
namespace Drupal\storleden_module\Plugin\Block;

use Drupal\Core\Block\BlockBase; 
 use Drupal\Core\Form\FormBuilderInterface; 
 use Drupal\Core\Form\FormStateInterface;
 use Drupal\Core\File\File;


#use Drupal\Core\Entity\Query\QueryInterface
/**
 *
 * @Block(
 *   id = "testblockss",
 *   admin_label = @Translation("Test Block"),
 *   category = @Translation("Storleden")
 * )
 */
class testBlock extends BlockBase {
  
  /**
   * On block call and build
   *
   * @return string
   */
  public function build() {
    $sub =isset($_POST["node"]) ? $_POST["node"] : '' ;

    return array(
            '#theme' => 'test',            
            '#node' => [
                          'test' => var_dump($sub),
                          'sub' => $sub 
            ] 
        );
  }



}