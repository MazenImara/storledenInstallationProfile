<?php

/**
 * @file
 */
namespace Drupal\storleden_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;
use Drupal\image\Entity\ImageStyle;


/**
 * Provides a 'person' Block.
 * @Block(
 *  id = "person_block",
 *  admin_label = @Translation("Person Block"),
 * )
 */
class personBlock extends BlockBase {

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
      '#theme'     => 'person',
      '#getPerson' => personBlock::getPerson(),
            '#attached' => array(
        'library' => array(
          'storleden_module/storleden_lib',
                    ),
              ), 
    );
  }

  public function getPerson() {
    $query = \Drupal::entityQuery('node')
          ->condition('status', 1)
          ->condition('type','person'); /*Person or person? ... that's the question! */
          /*Make querry: load filter*/

    $entity_ids = $query->execute();
    /*Execute querry: get node IDs [$entity_ids = list of integers]*/

    $nodes = \Drupal::entityManager()
    ->getStorage('node')
    ->loadMultiple( $entity_ids );
    /*Load the nodes with the IDs, [$nodes = list of node objects]*/



    $nodePackage=[];
    $counterOuter = 0;
    $result = [];
    foreach ($nodes as $node) {

      $result['Namn'] = $node->title->value;



      if( !is_null( $node->field_telefon->value) ) {
        $tempArray = [];
        $tempLength = count($node->field_telefon);
        for ($counter = 0; $counter < $tempLength; $counter++ ) {
          $tempArray[$counter] = $node->field_telefon[$counter]->value;
        }
        $result['Telefon'] = $tempArray;

      } else {
        $result['Telefon'] = NULL;
      }



      if( !is_null( $node->field_yrke->value) ) {
        $tempArray = [];
        $tempLength = count($node->field_yrke);
        for ($counter = 0; $counter < $tempLength; $counter++ ) {
          $tempArray[$counter] = $node->field_yrke[$counter]->value;

        }
        $result['Yrken'] = $tempArray;

      } else {
        $result['Yrken'] = NULL;
      }



      if( !is_null( $node->field_epost->value) ) {
        $tempArray = [];
        $tempLength = count($node->field_epost);
        for ($counter = 0; $counter < $tempLength; $counter++ ) {
          $tempArray[$counter] = $node->field_epost[$counter]->value;
        }
        $result['Epost'] = $tempArray;

      } else {
        $result['Epost'] = NULL;
      }



      if( !is_null($node->field_image->entity) ) {
        $tempImgURL = file_create_url($node->field_image->entity->getFileUri());
        //$style = ImageStyle::load('medium'); //img_storleden

        // $uri = $style->buildUri($tempImgURL);
        //$url = $style->buildUrl($tempImgURL);
        $result['BildURL'] = $tempImgURL;//$url;
      } else {
        $result['BildURL'] = NULL;
      }

      if( !is_null($node->field_image2->entity) ) {
        $tempImgURL = file_create_url($node->field_image2->entity->getFileUri());
        //$style = ImageStyle::load('medium'); //img_storleden

        // $uri = $style->buildUri($tempImgURL);
        //$url = $style->buildUrl($tempImgURL);
        $result['Bild2URL'] = $tempImgURL;//$url;
      } else {
        $result['Bild2URL'] = NULL;
      }      

      $nodePackage[$counterOuter] = $result;
      $counterOuter++;

    } // end of: foreach ($nodes as $node)

    return $nodePackage;



  } // end of: getPerson();

} // end of class personBlock;
