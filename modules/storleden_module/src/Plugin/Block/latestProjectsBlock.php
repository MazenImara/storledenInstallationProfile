<?php
namespace Drupal\storleden_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
#use Drupal\Core\Entity\Query\QueryInterface
/**
 *
 * @Block(
 *   id = "latestprojectsblocks",
 *   admin_label = @Translation("Latest Projects Block"),
 *   category = @Translation("Storleden")
 * )
 */
class latestProjectsBlock extends BlockBase {
  
  /**
   * On block call and build
   *
   * @return string
   */
  public function build() {
    
    return array(
      '#theme' => 'latest_projects',
      '#nodes' => latestProjectsBlock::getNodes(),
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
    ->condition('status', 1)->pager(4)->sort('created','DESC')->condition('type', 'Project', '=');
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
          'body' => substr($item->body->value, 0, 500) , 
          'id' =>  $item->id(),
          'img' => file_create_url($item->field_image->entity->getFileUri()),
          'cat' => $item->field_category->value,
          'ingress' => $item->field_ingress->value,      
          ]
        ) ;

    }


    # ---------------------
    return $nodesArray ;

  }



}