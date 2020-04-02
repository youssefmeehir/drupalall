<?php
namespace Drupal\hsaaidi\Plugin\Block;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * @Block(
 *    id = "my_block_example",
 *   admin_label = @Translation("My block"),
 *   )
 */
class MyBlock extends BlockBase
{

  /**
   * @inheritDoc
   */
  public function build() {
    return [
      '#markup' => $this->t('This is a simple block in my first page in my first module!'),
    ];
  }
}
