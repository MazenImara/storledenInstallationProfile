<?php

/**
 * @file
 */
namespace Drupal\storleden_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;
use Drupal\image\Entity\ImageStyle;


/**
 * Provides a 'references' Block.
 * @Block(
 *  id = "referensblock",
 *  admin_label = @Translation("Referens Block"),
 * )
 */

class referencesBlock extends BlockBase {

  /**
   * {@inheritdoc}
   *
   * On block call an build
   *
   * @return string
   *
   **/
  public function build() {

    return array(

      '#theme'     => 'references',
    //'#picture'   => referencesBlock::showReferences(),
      '#picture'   =>$this->showReferences(),

      '#attached' => array(
        'library' => array(
          'storleden_module/storleden_lib',
                    ),
              ), 

    );
  }

  public function showReferences() {
    $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('type','references'); // machine name
          /*Make query: load filter*/

    $entity_ids = $query->execute();
    /*Execute query: get node IDs [$entity_ids = list of integers]*/

    $nodes = \Drupal::entityManager()
      ->getStorage('node')
      ->loadMultiple( $entity_ids );

    $urls= [];
    foreach ($nodes as $key => $node) {
      array_push($urls, file_create_url($node->field_image->entity->getFileUri()) );
    }

    return $urls;
  }
}
