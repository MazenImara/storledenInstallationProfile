<?php
namespace Drupal\storleden_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
#use Drupal\Core\Entity\Query\QueryInterface
/**
 *
 * @Block(
 *   id = "tjansterblocks",
 *   admin_label = @Translation("Tjanster Block"),
 *   category = @Translation("Storleden")
 * )
 */
class tjansterBlock extends BlockBase {
  
  /**
   * On block call and build
   *
   * @return string
   */
  public function build() {
     $nodes = tjansterBlock::getNodes();
    return array(
            '#theme' => 'tjanster',            
            '#nodes' => $nodes,
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
    $query = \Drupal::entityQuery('node')->condition('type', 'Tjanster', '=')->condition('status', 1)->sort('field_weight','ASC');
    $nids = $query->execute();


    # -------------------
    $node_storage = \Drupal::entityManager()->getStorage('node');    
    $nodes = $node_storage->loadMultiple($nids);    


    # ---------------
    $nodesArray = [] ;
    

    foreach ($nodes as $item ) {
      array_push($nodesArray,
        [
          'title' => $item->title->value , 
          'ingress' => $item->field_ingress->value, 
          'id' =>  $item->id(),
          'img' => file_create_url($item->field_image->entity->getFileUri())         
          ]
        ) ;

    }


    # ---------------------
    return $nodesArray ;

  }
}