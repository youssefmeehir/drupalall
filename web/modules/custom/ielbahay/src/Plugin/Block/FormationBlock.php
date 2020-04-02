<?php
/**
 * @file
 * Contains \Drupal\ielbahay\Plugin\Block\HelloBlock.
 */

namespace Drupal\ielbahay\Plugin\Block;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Formation' Block
 *
 * @Block(
 *   id = "Formation_block",
 *   admin_label = @Translation("Formation block"),
 * )
 */
class FormationBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build () {
    return array(
      '#markup' => $this->t('content of block formation '),
    );
  }

}
