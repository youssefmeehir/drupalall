<?php

namespace Drupal\norsys_base\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

class CandidatureController extends ControllerBase
{
  public function display(){
    $header_table = array(
      'id' => t('Id'),
      'nom' => t('Nom'),
      'prenom' => t('Prénom'),
      'telephone' => t('telephone'),
      'mail' => t('Email'),
      'mots' => t('Quelques mots'),
      'cv' => t('Cv'),
      'action_e' => t('Edit'),
      'action_d' => t('Delete'),
    );
    $query = \Drupal::database()->select('candidature','c');
    $query->fields('c', ['id','nom','prenom','telephone','mail','mots','cv']);
    $results = $query->execute()->fetchAll();

    $rows = [];
    foreach ($results as $res){
      $delete = Url::fromUserInput('/norsys-base/candidature/delete/'.$res->id);
      $edit = Url::fromUserInput('/norsys-base/candidature?num='.$res->id);
      $rows[] = [
        'id' => $res->id,
        'nom' => $res->nom,
        'prenom' => $res->prenom,
        'telephone' => $res->telephone,
        'mail' => $res->mail,
        'mots' => $res->mots,
        'cv' => $res->cv,
         Link::fromTextAndUrl('Delete', $delete),
         Link::fromTextAndUrl('Edit', $edit),
      ];
    }

    $form['table'] = [
      '#type' => 'table',
      '#header' => $header_table,
      '#rows' => $rows,
      '#empty' => t('aucune candidature trouvée')
    ];
    return $form;
  }
}
