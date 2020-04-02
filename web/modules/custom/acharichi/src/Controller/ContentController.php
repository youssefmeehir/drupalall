<?php
/**
 * @file
 */

namespace Drupal\acharichi\Controller;

use Drupal\Core\Controller\ControllerBase;

class ContentController extends ControllerBase
{
  public function page(){
    return [
      '#type' => 'markup',
      '#markup' => t('this is acharichi custom content page')
    ];
  }
}
