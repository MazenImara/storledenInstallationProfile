<?php
namespace Drupal\storleden_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
#use Drupal\Core\Entity\Query\QueryInterface
/**
 *
 * @Block(
 *   id = "allprojectsangularfilters",
 *   admin_label = @Translation("All Projects Angular Filter Block"),
 *   category = @Translation("Storleden")
 * )
 */
class allProjectsAngularFilter extends BlockBase {
  
  /**
   * On block call and build
   *
   * @return string
   */
  public function build() {
     $nodes = allProjectsAngularFilter::getNodes();
    return array(
            '#theme' => 'products_angular',            
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
    $query = \Drupal::entityQuery('node')
    ->condition('status', 1)->sort('created','DESC')->condition('type', 'Project', '=');
    $nids = $query->execute();


    # -------------------
    $node_storage = \Drupal::entityManager()->getStorage('node');    
    $nodes = $node_storage->loadMultiple($nids);    


    # ---------------
    $nodesArray = [] ;
    

    foreach ($nodes as $node ) {
      array_push($nodesArray,
        [
          'title' => $node->title->value , 
          'ingress' => $node->field_ingress->value, 
          'id' =>  $node->id(),
          'img' => file_create_url($node->field_image->entity->getFileUri()),
          'cat' => $node->field_category->value,        
          ]
        ) ;

    }


    # ---------------------
    return $nodesArray ;

  }
}