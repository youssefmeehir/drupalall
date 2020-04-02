<?php
/**
 * @file
 * Contains \Drupal\ielbahay\Controller\FormationController.
 */

namespace Drupal\ielbahay\Controller;

use Drupal\Core\Controller\ControllerBase;

class FormationController extends ControllerBase {
  public function content() {
    return array(
      '#type' => 'markup',
      '#markup' => t('Hello world'),
    );
  }
}
