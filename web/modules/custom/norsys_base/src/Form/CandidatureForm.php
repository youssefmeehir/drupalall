<?php


namespace Drupal\norsys_base\Form;


use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class CandidatureForm extends FormBase
{
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $conn = Database::getConnection();
    $record = array();
    if (isset($_GET['num'])) {
      $query = $conn->select('candidature', 'c')
        ->condition('id', $_GET['num'])
        ->fields('c');
      $record = $query->execute()->fetchAssoc();
    }
    $form['nom'] = array(
      '#type' => 'textfield',
      '#title' => t('le nom de candidat:'),
      '#required' => TRUE,
      '#default_value' => (isset($record['nom']) && $_GET['num']) ? $record['nom'] : '',
    );
    $form['prenom'] = array(
      '#type' => 'textfield',
      '#title' => t('le prénom de candidat:'),
      '#required' => TRUE,
      '#default_value' => (isset($record['prenom']) && $_GET['num']) ? $record['prenom'] : '',
    );
    $form['telephone'] = array(
      '#type' => 'tel',
      '#required' => TRUE,
      '#title' => t('numéro de telephone'),
      '#default_value' => (isset($record['telephone']) && $_GET['num']) ? $record['telephone'] : '',
    );
    $form['mail'] = array(
      '#type' => 'email',
      '#title' => t('Email:'),
      '#required' => TRUE,
      '#maxlength' => 255,
      '#default_value' => (isset($record['mail']) && $_GET['num']) ? $record['mail'] : '',
    );
    $form['mots'] = array(
      '#type' => 'textarea',
      '#title' => t('Quelques mots à propos de vous:'),
      '#required' => FALSE,
      '#default_value' => (isset($record['mots']) && $_GET['num']) ? $record['mots'] : '',
    );
    $form['cv'] = array(
      '#type' => 'file',
      '#title' => t('CV'),
      '#required' => FALSE,
      '#default_value' => (isset($record['cv']) && $_GET['num']) ? $record['cv'] : '',
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Sauvegarder'),

    );
    $url = Url::fromRoute('norsys_base.condidature_display')->toString();
    $form['actions']['cancel'] = array(
      '#type' => 'markup',
      '#markup' => "<a class='btn btn-info' href='".$url."'>Annuler</a>"
    );

    $form['actions']['cancel']['#attributes']['class'][] = 'btn-danger';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    parent::validateForm($form, $form_state);
    if (empty($form_state->getValue('nom'))) {
      $form_state->setErrorByName('nom', $this->t('Merci de saisir votre nom.'));
    }
    if (empty($form_state->getValue('prenom'))) {
      $form_state->setErrorByName('prenom', $this->t('Merci de saisir votre prènom.'));
    }
    if (empty($form_state->getValue('telephone'))) {
      $form_state->setErrorByName('telephone', $this->t('Merci de saisir votre telephone.'));
    }
    if (empty($form_state->getValue('mail'))) {
      $form_state->setErrorByName('mail', $this->t('Merci de saisir votre adresse mail.'));
    }
    $tel = trim($form_state->getValue('telephone'));
    if ($tel != '') {
      if (strpos($tel, '+') === 0) {
        $tel = substr($tel, 1, strlen($tel));
      }
      if (!is_numeric($tel) || strpos($tel, '+') === 0 || strpos($tel, '-') === 0) {
        $form_state->setErrorByName('telephone', $this->t('Merci de renseigner un téléphone valide au format numérique.'));
      }
    }
  }

  /**
   * @inheritDoc
   */
  public function getFormId()
  {
    return 'form_candidat';
  }

  /**
   * @inheritDoc
   * @throws \Exception
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $fields = $form_state->getValues();
    if (isset($_GET['num'])) {
      \Drupal::database()->update('candidature')
        ->fields([
          'nom' => $fields['nom'],
          'prenom' => $fields['prenom'],
          'telephone' => $fields['telephone'],
          'mail' => $fields['mail'],
          'mots' => $fields['mots'],
          'cv' => $fields['cv']
        ])->condition('id', $_GET['num'])->execute();
      \Drupal::messenger()->addMessage('Modification réussite');
    } else {
      \Drupal::database()->insert('candidature')
        ->fields([
          'nom',
          'prenom',
          'telephone',
          'mail',
          'mots',
          'cv'
        ])
        ->values([
          $fields['nom'],
          $fields['prenom'],
          $fields['telephone'],
          $fields['mail'],
          $fields['mots'],
          'cv test'
        ])
        ->execute();
      \Drupal::messenger()->addMessage('Ajout réussit');
    }
    $form_state->setRedirect('norsys_base.condidature_display');
  }
}
