<?php

namespace Drupal\hello_world\Controller;

class HelloWorldController {
	public function hello() {
		return array(
			'#title' => 'Hello World',
			'#markup' => 'This is some content',
			//'#theme' => 'my_template',
			/*'#attached' => array(
				'library' => array(
				  'hello_world/hello_world_global',
				),
			)*/
		);
		//$form = \Drupal::formBuilder()->getForm('Drupal\hello_world\Form\SampleForm');
		//return $form;
	}
}