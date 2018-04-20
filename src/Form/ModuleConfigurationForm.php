<?php

namespace Drupal\KiwiIRC\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures forms module settings.
 */
class ModuleConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'KiwiIRC_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'KiwiIRC.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('KiwiIRC.settings');
    $form['Server'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Server'),
      '#default_value' => $config->get('Server'),
    ];
    $form['Channel'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Channel'),
      '#default_value' => $config->get('Channel'),
    ];
    $form['Nick'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Nick'),
      '#default_value' => $config->get('Nick'),
    ];
    $form['Theme'] = [
      '#type' => 'select',
      '#title' => $this->t('Theme'),
      '#options' => ['relaxed' => $this->t('Relaxed (Default)'),
                     'cli' => $this->t('CLI (Dark)'),
                     'basic' => $this->t('Basic'),
                     'mini' => $this->t('Mini (Small)')],
      '#default_value' => $config->get('Theme'),
      '#attributes' => array('style' => 'width:505px'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->config('KiwiIRC.settings')->set('Server', $values['Server'])->save();
    $this->config('KiwiIRC.settings')->set('Channel', $values['Channel'])->save();
    $this->config('KiwiIRC.settings')->set('Nick', $values['Nick'])->save();
    $this->config('KiwiIRC.settings')->set('Theme', $values['Theme'])->save();
    parent::submitForm($form, $form_state);
  }

}
