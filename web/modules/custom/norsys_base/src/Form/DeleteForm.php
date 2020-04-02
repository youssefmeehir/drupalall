<?php


namespace Drupal\norsys_base\Form;


use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class DeleteForm extends ConfirmFormBase
{
  public $cid;

  /**
   * @inheritDoc
   */
  public function getQuestion()
  {
    $this->cid = \Drupal::routeMatch()->getParameter('id');
    return t('Do you want to delete %cid?', array('%cid' => $this->cid));
  }

  /**
   * @inheritDoc
   */
  public function getCancelUrl()
  {
    return new Url('norsys_base.condidature_display');
  }

  /**
   * @inheritDoc
   */
  public function getFormId()
  {
    return 'candidature_delete_form';
  }

  /**
   * @inheritDoc
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $query = \Drupal::database();
    $query->delete('candidature')
      ->condition('id',$this->cid)
      ->execute();
    \Drupal::messenger()->addMessage('suppression réussite');
    $form_state->setRedirect('norsys_base.condidature_display');
 }


  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return t('Delete it!');
 }

  /**
   * {@inheritdoc}
   */
  public function getCancelText() {
    return t('Cancel');
  }
}
