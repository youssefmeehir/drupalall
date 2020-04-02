<?php
/**
 * @file
 */
namespace Drupal\acharichi\Plugin\Block;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Block\BlockBase;

/**
 * My custom block
 *
 * @Block(
 *   id = "acharichi_image_block",
 *   admin_label = @Translation("acharichi image block"),
 * )
 */
class ImageBlock extends BlockBase {

  /**
   * @inheritDoc
   */
  public function build()
  {
    return [
      '#type' => 'markup',
      '#markup' => "<img src='https://cdn.shopify.com/s/files/1/0533/2089/files/placeholder-images-image_large.png?v=1530129081'/>"
    ];
  }
}
