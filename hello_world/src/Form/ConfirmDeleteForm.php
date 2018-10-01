<?php

namespace Drupal\hello_world\Form;

use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Defines a confirmation form to confirm deletion of something by id.
 */
class ConfirmDeleteForm extends ConfirmFormBase {

  /**
   * ID of the item to delete.
   *
   * @var int
   */
  protected $id, $type;

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, string $id = NULL, string $type = NULL) {
    $this->id = $id;
	$this->type = $type;
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // @todo: Do the deletion.
	drupal_set_message('Deleted');
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return "confirm_delete_form";
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('hello_world');
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return t('Do you want to delete %id of type %type?', ['%id' => $this->id, '%type' => $this->type]);
  }

}