<?php
namespace Drupal\storleden_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
#use Drupal\Core\Entity\Query\QueryInterface
/**
 *
 * @Block(
 *   id = "textsliderblocks",
 *   admin_label = @Translation("Text Slider Block"),
 *   category = @Translation("Storleden")
 * )
 */
class textSliderBlock extends BlockBase {
  
  /**
   * On block call and build
   *
   * @return string
   */
  public function build() {
    $nodesArray = textSliderBlock::getNodes();
    return array(
            '#theme' => 'text_slider',            
            '#nodesArray' => $nodesArray,
            '#attached' => array(
        'library' => array(
          'storleden_module/storleden_lib',
        ),
      ),
        );
  }


  private function getNodes()
  {    

    #this is entity query
    $query = \Drupal::entityQuery('node')
    ->condition('status', 1)->condition('field_add_to_slider_', true );
    $nids = $query->execute();


    # -------------------
    $node_storage = \Drupal::entityManager()->getStorage('node');    
    $nodes = $node_storage->loadMultiple($nids);


    # ---------------
    $nodesArray = [] ;
    

    foreach ($nodes as $item ) {
      $img = null;
      if (isset($item->field_image->entity) && !empty($item->field_image->entity)) {
        $img = file_create_url($item->field_image->entity->getFileUri());
      }

      array_push($nodesArray,
        [
          'title' => $item->title->value , 
          'body' => substr($item->field_ingress->value, 0, 200) , 
          'id' =>  $item->id(),
          'img' => $img ,          
          ]
        ) ;

    }


    # ---------------------
    return $nodesArray ;

  }
}