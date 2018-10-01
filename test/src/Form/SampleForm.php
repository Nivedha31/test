<?php

namespace Drupal\test\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountInterface;

class SampleForm extends FormBase {
	protected $database;
	protected $account;

  public static function create(ContainerInterface $container) {
    return new static(
	$container->get('database'),
	$container->get('current_user')
	);
  }

  public function __construct(Connection $connection, AccountInterface $account) {
    $this->database = $connection;
	$this->account = $account;
  }
	
  public function getFormId() {
    return 'sample_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#size' => 60,
      '#maxlength' => USERNAME_MAX_LENGTH,
      '#description' => $this->t('Enter your username.'),
      '#required' => TRUE,
    ];

    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['submit'] = ['#type' => 'submit', '#value' => $this->t('Save')];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
      $this->database->insert('test')
            ->fields([
			  'uid' => $this->account->id(),
              'name' => $form_state->getvalue('name'),
            ])
            ->execute();
  }

}
