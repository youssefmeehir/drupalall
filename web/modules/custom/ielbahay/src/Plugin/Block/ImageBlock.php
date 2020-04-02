<?php
/**
 * @file
 * Contains \Drupal\ielbahay\Plugin\Block\ImageBlock.
 */

namespace Drupal\ielbahay\Plugin\Block;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Image' Block
 *
 * @Block(
 *   id = "Image_block",
 *   admin_label = @Translation("Image block"),
 * )
 */
class ImageBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build () {
    return array(
      '#markup' => "<img src='https://images.unsplash.com/photo-1476718840318-386693801fbe?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=700&q=80' /> ",
    );
  }

}
