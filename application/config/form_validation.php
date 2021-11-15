<?php

$config = array(
	'pessoa/create' => array(
		array(
			'field' => 'nome',
			'rules' => 'trim|required|min_length[5]',
			'errors' => array(
				'required' => 'Preencha o campo nome',
				'min_length' => 'O campo nome deve ter no mínimo 5 caracteres'
			)
		),
		array(
			'field' => 'email',
			'rules' => 'trim|required|valid_email',
			'errors' => array(
				'required' => 'Preencha o campo e-mail',
				'valid_email' => 'Insira um e-mail válido'
			)
		)
	)
);
