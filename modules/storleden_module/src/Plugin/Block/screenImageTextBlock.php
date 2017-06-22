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
 *   id = "screenimagetextblocks",
 *   admin_label = @Translation("Screen Image Text Block"),
 *   category = @Translation("Storleden")
 * )
 */
class screenImageTextBlock extends BlockBase {
  
  /**
   * On block call and build
   *
   * @return string
   */
  public function build() {
      $config = $this->getConfiguration();


      if (isset($config['screen_text_title']) && !empty($config['screen_text_title'])) {
          $textTitle = $config['screen_text_title'];
      }
      else {
        $textTitle = $this->t('');
      }



     if (isset($config['screen_text1']) && !empty($config['screen_text1'])) {
          $text = $config['screen_text1'];
      }
      else {
        $text = $this->t('');
      }

      if (isset($config['screen_text2']) && !empty($config['screen_text2'])) {
          $text2 = $config['screen_text2'];
      }
      else {
        $text2 = $this->t('');
      }
      // fetch photo

       $imageid = $config['photo'];
      

      if (isset($imageid) && !empty($imageid)) {
          $file = \Drupal\file\Entity\File::load($imageid[0]);
          if ($file != null) {
            $imgurl = file_create_url($file->getFileUri());
          }
          else{
            $imgurl= drupal_get_path('module', 'storleden_module') . '/images/startslide.jpg';
          } 
            
          
          
      }
      else {
        $imgurl = drupal_get_path('module', 'storleden_module') . '/images/startslide.jpg';
      }
      


    return array(
            '#theme' => 'screen_image_text',            
            '#node' => [
                          'screenTextTitle' => $config['screen_text_title']['value'] ,
                          'screenText1' => $config['screen_text1']['value'] ,
                          'screenText2' => $config['screen_text2']['value'] ,
                          'imgurl' => $imgurl ,
                          'links' => $this->links($config),
            ],
            '#attached' => array(
        'library' => array(
          'storleden_module/storleden_lib',
                    ),
              ), 
        );
  }

  public function links($config)
  {
    $links = [];

    if (isset($config['link1']) && !empty($config['link1'])) {
      array_push($links, 
        [ 
          'value' => explode(',', $config['link1'] )[0] ,
          'url' => explode(',', $config['link1'] )[1] ,

        ]);
    }
    if (isset($config['link2']) && !empty($config['link2'])) {
      array_push($links, 
        [ 
          'value' => explode(',', $config['link2'] )[0] ,
          'url' => explode(',', $config['link2'] )[1] ,

        ]);
    }
    if (isset($config['link3']) && !empty($config['link3'])) {
      array_push($links, 
        [ 
          'value' => explode(',', $config['link3'] )[0] ,
          'url' => explode(',', $config['link3'] )[1] ,

        ]);
    }
    if (isset($config['link4']) && !empty($config['link4'])) {
      array_push($links, 
        [ 
          'value' => explode(',', $config['link4'] )[0] ,
          'url' => explode(',', $config['link4'] )[1] ,

        ]);
    }
    if (isset($config['link5']) && !empty($config['link5'])) {
      array_push($links, 
        [ 
          'value' => explode(',', $config['link5'] )[0] ,
          'url' => explode(',', $config['link5'] )[1] ,

        ]);
    }
    
      return $links;
  }
  
  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['screen_text_title'] = array(
      '#type' => 'text_format',
      '#format' => 'full_html',
      '#title' => $this->t('Screen Text Title'),
      '#description' => $this->t('effect work when you add &lt;h1 data-animation="animated flipInX"&gt;STORLEDEN&lt;/h1&gt; '),
      '#default_value' => $config['screen_text_title']['value'],
    );
    $form['screen_text1'] = array(
      '#type' => 'text_format',
      '#format' => 'full_html',
      '#title' => $this->t('Screen Text 1'),
      '#description' => $this->t('effect work when you add &lt;p data-animation="animated lightSpeedIn"&gt;Innovativa produkter och tjänster&lt;/p&gt;'),
      '#default_value' => $config['screen_text1']['value'],
    );

    $form['screen_text2'] = array(
      '#type' => 'text_format',
      '#format' => 'full_html',
      '#title' => $this->t('Screen Text 2'),
      '#description' => $this->t('effect work when you add &lt;p data-animation="animated slideInLeft"&gt;Concept to realisation&lt;/p&gt;'),
      '#default_value' => $config['screen_text2']['value'],
    );

    // upload imag

    $form['photo'] = array(
      '#title' => t('Local Computer Image'),
      '#type' => 'managed_file',
      '#description' => t('The uploaded image will be displayed on screen image.'),
      '#default_value' => isset($config['photo']) ? $config['photo'] : '',
      '#upload_location' => 'public://images/',
      '#required' => FALSE,
      '#theme'    =>    'advphoto_thumb_upload',
    );

    $form['link1'] = array(
      '#type' => 'textfield',
      '#description' => t('Type the title then comma then node ex: title , /nod/22'),
      '#title' => $this->t('link 1'),
      '#default_value' => isset($config['link1']) ? $config['link1'] : '',
    );    

    $form['link2'] = array(
      '#type' => 'textfield',
      '#description' => t('Type the title then comma then node ex: title , /nod/22'),
      '#title' => $this->t('link 2'),
      '#default_value' => isset($config['link2']) ? $config['link2'] : '',
    );    

    $form['link3'] = array(
      '#type' => 'textfield',
      '#description' => t('Type the title then comma then node ex: title , /nod/22'),
      '#title' => $this->t('link 3'),
      '#default_value' => isset($config['link3']) ? $config['link3'] : '',
    );    

    // end img
    $form['link4'] = array(
      '#type' => 'textfield',
      '#description' => t('Type the title then comma then node ex: title , /nod/22'),
      '#title' => $this->t('link 4'),
      '#default_value' => isset($config['link4']) ? $config['link4'] : '',
    );    
    $form['link5'] = array(
      '#type' => 'textfield',
      '#description' => t('Type the title then comma then node ex: title , /nod/22'),
      '#title' => $this->t('link 5'),
      '#default_value' => isset($config['link5']) ? $config['link5'] : '',
    );    


    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['screen_text_title'] = $values['screen_text_title'];
    $this->configuration['screen_text1'] = $values['screen_text1'];
    $this->configuration['screen_text2'] = $values['screen_text2'];
    $this->setConfigurationValue('photo', $form_state->getValue('photo'));
    $this->configuration['link1'] = $values['link1'];
    $this->configuration['link2'] = $values['link2'];
    $this->configuration['link3'] = $values['link3'];
    $this->configuration['link4'] = $values['link4'];
    $this->configuration['link5'] = $values['link5'];
  }


}