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
 *   id = "acharichi_text_block",
 *   admin_label = @Translation("acharichi text block"),
 * )
 */
class TextBlock extends BlockBase {

  /**
   * @inheritDoc
   */
  public function build()
  {
    return [
      '#type' => 'markup',
      '#markup' => t('custom text block')
    ];
  }
}
