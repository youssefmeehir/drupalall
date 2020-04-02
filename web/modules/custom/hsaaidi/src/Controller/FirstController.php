<?php

namespace Drupal\hsaaidi\Controller;


use Drupal\Core\Controller\ControllerBase;

class FirstController extends ControllerBase {

  public function content() {
    $build = [
      '#markup' => $this->t('Hello World!'),
    ];
    return $build;
  }

}
