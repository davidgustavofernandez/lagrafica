<?php

/**
 * Valdiation meassages configuration
 */
$config['v_errors'] = array(

  // ESPAÑOL
  'esp_name' => array(
    'required' => 'Debe ingresar un Nombre',
    'not_empty' => 'Debe ingresar un Nombre',
    'alpha' => 'El Nombre debe contener sólo letras',
    'min_length' => 'El Nombre tiene que tener más que 2 caracteres',
    'max_length' => 'El Nombre debe tener menos de 50 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_email' => array(
    'required' => 'Debe ingresar un Email',
    'not_empty' => 'Debe ingresar un Email',
    'default' => 'El Email que introdujo no es válido',
    'email' => 'El Email no es válido',
    'min_length' => 'El Email deve ser superior a 6 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_cell_phone' => array(
    'required' => 'Debe ingresar un Teléfono Celular',
    'not_empty' => 'Debe ingresar un Teléfono Celular',
    'numeric' => 'El Teléfono Celular debe contener sólo números',
    'min_length' => 'El Teléfono Celular tiene que tener más que 7 caracteres',
    'max_length' => 'El Teléfono Celular tiene que tener menos que 255 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_form_type' => array(
    'required' => 'Debe ingresar el Motivo de la consulta',
    'not_empty' => 'Debe ingresar un Motivo de la consulta',
    'length' => 'El Motivo de la consulta debe tener entre 1 caracteres',
    'numeric' => 'El Motivo de la consulta debe contener solamente números',
    'alpha' => 'El mensaje debe contener sólo letras',
    'min_length' => 'El Motivo de la consulta debe tener más de 1 caracteres',
    'max_length' => 'El Motivo de la consulta debe tener menos 1 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_message' => array(
    'required' => 'Debe ingresar un Mensaje',
    'not_empty' => 'Debe ingresar un Mensaje',
    'alpha' => 'El Mensaje debe contener sólo letras',
    'min_length' => 'El Mensaje debe ser más de 5 caracteres',
    'max_length' => 'El Mensaje debe tener menos de 700 caracteres',
    'default' => 'Contenido no válido'
  ),

  //  ENGLISH
  'eng_name' => array(
    'required' => 'You must enter a Name',
    'not_empty' => 'You must enter a Name',
    'alpha' => 'The Name must contain only letters',
    'min_length' => 'The Name must have more than 2 characters',
    'max_length' => 'The Name must be less than 50 characters',
    'default' => 'Invalid contents'
  ),
  'eng_email' => array(
    'required' => 'You must enter a Email',
    'not_empty' => 'You must enter a Email',
    'default' => 'The Email entered is not valid',
    'min_length' => 'The Email must be greater than 6 characters',
    'default' => 'Invalid contents'
  ),
  'eng_cell_phone' => array(
    'required' => 'You must enter a Cell. Phone',
    'not_empty' => 'You must enter a Cell. Phone',
    'numeric' => 'The Cell. Phone must contain only letters',
    'min_length' => 'The Cell. Phone debe ser más de 5 characters',
    'max_length' => 'The Cell. Phone must be less than 500 characters',
    'default' => 'Invalid contents'
  ),
  'eng_id_form_type' => array(
    'required' => 'You must enter a Interest',
    'not_empty' => 'You must enter a Interest',
    'alpha_numeric' => 'The Interest must contain only letters and numbers',
    'length' => 'The Interest it must be a caractere',
    'numeric' => 'The Interest it must contain only numbers',
    'min_length' => 'The Interest must have more than 1 characters',
    'max_length' => 'The Interest must be less than 3 characters',
    'default' => 'Invalid contents'
  ),
  'eng_mensaje' => array(
    'required' => 'You must enter a Message',
    'not_empty' => 'You must enter a Message',
    'alpha' => 'The Message must contain only letters',
    'min_length' => 'The Message debe ser más de 5 characters',
    'max_length' => 'The Message must be less than 700 characters',
    'default' => 'Invalid contents'
  ),


  // PORTUGUES
  'por_name' => array(
    'required' => 'Você deve digitar um Nome',
    'not_empty' => 'Você deve digitar um Nome',
    'alpha' => 'O Nome deve conter apenas letras',
    'min_length' => 'O Nome deve ser mais do que 2 personagens',
    'max_length' => 'O Nome deve ter menos de 50 personagem',
    'default' => 'Conteúdo inválido'
  ),
  'por_email' => array(
    'required' => 'Você deve digitar um Email',
    'not_empty' => 'Você deve digitar um Email',
    'default' => 'O Email digitado não é válido',
    'min_length' => 'O Email deve ser superior a 6 personagem',
    'default' => 'Conteúdo inválido'
  ),
  'por_cell_phone' => array(
    'required' => 'Você deve digitar um Celular',
    'not_empty' => 'Você deve digitar um Celular',
    'alpha' => 'O Celular deve conter apenas letras',
    'min_length' => 'O Celular deve ser mais de 2 personagem',
    'max_length' => 'O Celular deve ser inferior a 255 personagem',
    'default' => 'Conteúdo inválido'
  ),
  'por_id_form_type' => array(
    'required' => 'Você deve digitar um Interesse',
    'not_empty' => 'Você deve digitar um Interesse',
    'length' => 'O Interesse deve ser um caractere',
    'numeric' => 'O Interesse deve conter apenas números',
    'min_length' => 'O Interesse deve ser mais do que 1 personagem',
    'max_length' => 'O Interesse deve estar sob 3 personagem'
  ),
  'por_message' => array(
    'required' => 'Você deve digitar um Comentário',
    'not_empty' => 'Você deve digitar um Comentário',
    'alpha' => 'O Comentário deve conter apenas letras',
    'min_length' => 'O Comentário deve ser mais de 2 personagem',
    'max_length' => 'O Comentário deve ser inferior a 700 personagem',
    'default' => 'Conteúdo inválido'
  ),

);
