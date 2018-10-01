<?php

namespace Drupal\custom_migrate\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 *  Extract users from Drupal 7 database.
 *
 * @MigrateSource(
 *   id = "custom_user"
 * )
 */
class User extends SqlBase {

  public function query() {
    $fields = [
      'uid',
      'name',
      'pass',
      'mail',
      'created',
      'access',
      'login',
	  'status'
    ];

    return $this->select('users', 'u')->fields('u', $fields)->condition('u.uid', array(0,1), 'not in');
  }

  public function fields() {
    $fields = [
      'uid' => $this->t('User id'),
      'name' => $this->t('Username'),
      'pass' => $this->t('Password'),
      'mail' => $this->t('Mail'),
      'created' => $this->t('Created'),
      'access' => $this->t('last access date'),
      'login' => $this->t('last login date'),
      'status' => $this->t('status'),
    ];

    return $fields;
  }

  public function getIds() {
    return [
      'uid' => [
        'type' => 'integer',
        'alias' => 'uid',
      ],
    ];
  }

  public function prepareRow(Row $row) {

    $password = $row->getSourceProperty('pass');
    $hash = \Drupal::service('password')->hash($password);
    $row->setSourceProperty('pass', $hash);
    return parent::prepareRow($row); // TODO: Change the autogenerated stub
  }

}