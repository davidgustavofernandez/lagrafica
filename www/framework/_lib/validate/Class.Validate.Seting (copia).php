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
    'max_length' => 'El Nombre debe tener menos de 150 caracteres',
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
    'max_length' => 'El Mensaje debe tener menos de 500 caracteres',
    'default' => 'Contenido no válido'
  ),




  'esp_id_user' => array(
    'required' => 'Debe ingresar un Usuario',
    'not_empty' => 'Debe ingresar un Usuario',
    'alpha_numeric' => 'El Usuario debe contener sólo letras e números',
    'numeric' => 'El Usuario debe contener sólos números',
    'min_length' => 'El Usuario debe tener más de 6 caracteres',
    'max_length' => 'El Usuario debe tener menos de 9 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_setting_country_language' => array(
    'required' => 'Debe ingresar un País',
    'not_empty' => 'Debe ingresar un País',
    'length' => 'El País deve ser un caractere',
    'numeric' => 'El País deve conter apenas números',
    'min_length' => 'El País tiene que tener más que 1 caracteres',
    'max_length' => 'El País deve estar sob 3 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_first_name' => array(
    'required' => 'Debe ingresar un Nombre',
    'not_empty' => 'Debe ingresar un Nombre',
    'alpha' => 'El Nombre debe contener sólo letras',
    'min_length' => 'El Nombre tiene que tener más que 2 caracteres',
    'max_length' => 'El Nombre debe tener menos de 20 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_last_name' => array(
    'required' => 'Debe ingresar un Apellido',
    'not_empty' => 'Debe ingresar un Apellido',
    'alpha' => 'El Apellido debe contener sólo letras',
    'min_length' => 'El Apellido tiene que tener más que 2 caracteres',
    'max_length' => 'El Apellido debe tener menos de 50 caracteres',
    'default' => 'Contenido no válido'
  ),
  
  'esp_password' => array(
    'required' => 'Debe ingresar una Contraseña',
    'not_empty' => 'Debe ingresar una Contraseña',
    'alpha_numeric' => 'La Contraseña  debe contener sólo letras y números',
    'alpha_dash' => 'La Contraseña debe contener solo caracteres alfabéticos, números o guiones',
    'min_length' => 'La Contraseña tiene que tener más que 6 caracteres',
    'max_length' => 'La Contraseña tiene que tener menos que 20 caracteres',
    'default' => 'Contenido no válido'
  ),
  
  
  
  
  'esp_id_user_type' => array(
    'required' => 'Debe ingresar el Tipo de usuario',
    'not_empty' => 'Debe ingresar un Tipo de usuario',
    'length' => 'El Tipo de usuario debe tener entre 1 caracteres',
    'numeric' => 'El Tipo de usuario debe contener solamente números',
    'min_length' => 'El Tipo de usuario debe tener más de 1 caracteres',
    'max_length' => 'El Tipo de usuario debe tener menos 1 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_patient' => array(
    'required' => 'Debe ingresar el Paciente',
    'not_empty' => 'Debe ingresar un Paciente',
    'length' => 'El Paciente debe tener entre 1 caracteres',
    'numeric' => 'El Paciente debe contener solamente números',
    'min_length' => 'El Paciente debe tener más de 1 caracteres',
    'max_length' => 'El Paciente debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_user' => array(
    'required' => 'Debe ingresar el Profesional',
    'not_empty' => 'Debe ingresar un Profesional',
    'length' => 'El Profesional debe tener entre 1 caracteres',
    'numeric' => 'El Profesional debe contener solamente números',
    'min_length' => 'El Profesional debe tener más de 1 caracteres',
    'max_length' => 'El Profesional debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_health_insurance' => array(
    'required' => 'Debe ingresar la Obra Social',
    'not_empty' => 'Debe ingresar un Obra Social',
    'length' => 'La Obra Social debe tener entre 1 caracteres',
    'numeric' => 'La Obra Social debe contener solamente números',
    'min_length' => 'La Obra Social debe tener más de 1 caracteres',
    'max_length' => 'La Obra Social debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_quantity' => array(
    'required' => 'Debe ingresar la Cantidad de turnos',
    'not_empty' => 'Debe ingresar un Cantidad de turnos',
    'length' => 'La Cantidad de turnos debe tener entre 1 caracteres',
    'numeric' => 'La Cantidad de turnos debe contener solamente números',
    'min_length' => 'La Cantidad de turnos debe tener más de 1 caracteres',
    'max_length' => 'La Cantidad de turnos debe tener menos 1 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_appointment' => array(
    'required' => 'Debe ingresar El Turno',
    'not_empty' => 'Debe ingresar El Turno',
    'length' => 'El Turno debe tener entre 1 caracteres',
    'numeric' => 'El Turno debe contener solamente números',
    'min_length' => 'El Turno debe tener más de 1 caracteres',
    'max_length' => 'El Turno debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_appointment_date' => array(
    'required' => 'Debe ingresar Un Día y hora',
    'not_empty' => 'Debe ingresar Un Día y hora',
    'length' => 'Día y hora debe tener entre 1 caracteres',
    'numeric' => 'Día y hora debe contener solamente números',
    'validateDate' => 'Día y hora inválido',
    'min_length' => 'Día y hora debe tener más de 1 caracteres',
    'max_length' => 'Día y hora debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_start_date' => array(
    'required' => 'Debe ingresar Un Día y hora',
    'not_empty' => 'Debe ingresar Un Día y hora',
    'length' => 'Día y hora debe tener entre 1 caracteres',
    'numeric' => 'Día y hora debe contener solamente números',
    'validateDate' => 'Día y hora inválido',
    'min_length' => 'Día y hora debe tener más de 1 caracteres',
    'max_length' => 'Día y hora debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_patient_cardtype' => array(
    'required' => 'Debe ingresar el Tipo de identificación',
    'not_empty' => 'Debe ingresar el Tipo de identificación',
    'length' => 'El Tipo de identificación debe tener entre 1 caracteres',
    'numeric' => 'El Tipo de identificación debe contener solamente números',
    'min_length' => 'El Tipo de identificación debe tener más de 1 caracteres',
    'max_length' => 'El Tipo de identificación debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_idcard' => array(
    'required' => 'Debe ingresar Número de Identificación',
    'not_empty' => 'Debe ingresar Número de Identificación',
    'length' => 'Número de Identificación debe tener entre 1 caracteres',
    'numeric' => 'Número de Identificación debe contener solamente números',
    'min_length' => 'Número de Identificación debe tener más de 1 caracteres',
    'max_length' => 'Número de Identificación debe tener menos 1 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_birthday' => array(
    'required' => 'Debe ingresar La Fecha de Nacimiento',
    'not_empty' => 'Debe ingresar La Fecha de Nacimiento',
    'length' => 'La Fecha de Nacimiento debe tener entre 1 caracteres',
    'numeric' => 'La Fecha de Nacimiento debe contener solamente números',
    'validateDate' => 'La Fecha de Nacimiento inválido',
    'min_length' => 'La Fecha de Nacimiento debe tener más de 1 caracteres',
    'max_length' => 'La Fecha de Nacimiento debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_age' => array(
    'required' => 'Debe ingresar la Edad',
    'not_empty' => 'Debe ingresar la Edad',
    'length' => 'La Edad debe tener entre 1 caracteres',
    'numeric' => 'La Edad debe contener solamente números',
    'min_length' => 'La Edad debe tener más de 1 caracteres',
    'max_length' => 'La Edad debe tener menos 1 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_patient_maritalstate' => array(
    'required' => 'Debe ingresar el Estado Civil',
    'not_empty' => 'Debe ingresar el Estado Civil',
    'length' => 'El Estado Civil debe tener entre 1 caracteres',
    'numeric' => 'El Estado Civil debe contener solamente números',
    'min_length' => 'El Estado Civil debe tener más de 1 caracteres',
    'max_length' => 'El Estado Civil debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_health_insurance' => array(
    'required' => 'Debe ingresar la Obra Social',
    'not_empty' => 'Debe ingresar la Obra Social',
    'length' => 'La Obra Social debe tener entre 1 caracteres',
    'numeric' => 'La Obra Social debe contener solamente números',
    'min_length' => 'La Obra Social debe tener más de 1 caracteres',
    'max_length' => 'La Obra Social debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_affiliate_number' => array(
    'required' => 'Debe ingresar el Numero de Afiliado',
    'not_empty' => 'Debe ingresar el Numero de Afiliado',
    'length' => 'El Numero de Afiliado debe tener entre 1 caracteres',
    'numeric' => 'El Numero de Afiliado debe contener solamente números',
    'min_length' => 'El Numero de Afiliado debe tener más de 1 caracteres',
    'max_length' => 'El Numero de Afiliado debe tener menos 1 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_ocupation' => array(
    'required' => 'Debe ingresar La Ocupación',
    'not_empty' => 'Debe ingresar La Ocupación',
    'alpha' => 'La Ocupación debe contener sólo letras',
    'min_length' => 'La Ocupación tiene que tener más que 2 caracteres',
    'max_length' => 'La Ocupación debe tener menos de 20 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_address' => array(
    'required' => 'Debe ingresar Una Dirección',
    'not_empty' => 'Debe ingresar Una Dirección',
    'alpha' => 'Dirección debe contener sólo letras',
    'min_length' => 'Dirección tiene que tener más que 2 caracteres',
    'max_length' => 'Dirección debe tener menos de 20 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_country_province' => array(
    'required' => 'Debe ingresar una Provincia',
    'not_empty' => 'Debe ingresar una Provincia',
    'length' => 'Provincia debe tener entre 1 caracteres',
    'numeric' => 'Provincia debe contener solamente números',
    'min_length' => 'Provincia debe tener más de 1 caracteres',
    'max_length' => 'Provincia debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_country_province_locality' => array(
    'required' => 'Debe ingresar una Localidad',
    'not_empty' => 'Debe ingresar una Localidad',
    'length' => 'Localidad debe tener entre 1 caracteres',
    'numeric' => 'Localidad debe contener solamente números',
    'min_length' => 'Localidad debe tener más de 1 caracteres',
    'max_length' => 'Localidad debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_localidad' => array(
    'required' => 'Debe ingresar una Localidad',
    'not_empty' => 'Debe ingresar una Localidad',
    'alpha' => 'Localidad debe contener sólo letras',
    'min_length' => 'Localidad tiene que tener más que 2 caracteres',
    'max_length' => 'Localidad debe tener menos de 20 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_phone_help' => array(
    'required' => 'Debe ingresar un Teléfono de Emergencias',
    'not_empty' => 'Debe ingresar un Teléfono de Emergencias',
    'numeric' => 'El Teléfono de Emergencias debe contener sólo números',
    'min_length' => 'El Teléfono de Emergencias tiene que tener más que 7 caracteres',
    'max_length' => 'El Teléfono de Emergencias tiene que tener menos que 255 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_current_illness' => array(
    'required' => 'Debe ingresar la Enfermedad Actual',
    'not_empty' => 'Debe ingresar la Enfermedad Actual',
    'alpha' => 'la Enfermedad Actual debe contener sólo letras',
    'min_length' => 'la Enfermedad Actual tiene que tener más que 2 caracteres',
    'max_length' => 'la Enfermedad Actual debe tener menos de 20 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_previous_treatment' => array(
    'required' => 'Debe ingresar el Tratamiento Anterior',
    'not_empty' => 'Debe ingresar el Tratamiento Anterior',
    'alpha' => 'El Tratamiento Anterior debe contener sólo letras',
    'min_length' => 'El Tratamiento Anterior tiene que tener más que 2 caracteres',
    'max_length' => 'El Tratamiento Anterior debe tener menos de 20 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_previous_medication' => array(
    'required' => 'Debe ingresar la Medicación Previa',
    'not_empty' => 'Debe ingresar la Medicación Previa',
    'alpha' => 'Medicación Previa debe contener sólo letras',
    'min_length' => 'Medicación Previa tiene que tener más que 2 caracteres',
    'max_length' => 'Medicación Previa debe tener menos de 20 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_dsmiv_code' => array(
    'required' => 'Debe ingresar le Código DSM IV',
    'not_empty' => 'Debe ingresar el Código DSM IV',
    'alpha' => 'Código DSM IV debe contener sólo letras',
    'min_length' => 'Código DSM IV tiene que tener más que 2 caracteres',
    'max_length' => 'Código DSM IV debe tener menos de 20 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_dsmiv_detail' => array(
    'required' => 'Debe ingresar le Detalle de DSM IV',
    'not_empty' => 'Debe ingresar el Detalle de DSM IV',
    'alpha' => 'Detalle de DSM IV debe contener sólo letras',
    'min_length' => 'Detalle de DSM IV tiene que tener más que 2 caracteres',
    'max_length' => 'Detalle de DSM IV debe tener menos de 20 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_dsmiv_code2' => array(
    'required' => 'Debe ingresar le Código DSM IV',
    'not_empty' => 'Debe ingresar el Código DSM IV',
    'alpha' => 'Código DSM IV debe contener sólo letras',
    'min_length' => 'Código DSM IV tiene que tener más que 2 caracteres',
    'max_length' => 'Código DSM IV debe tener menos de 20 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_dsmiv_detail2' => array(
    'required' => 'Debe ingresar le Detalle de DSM IV',
    'not_empty' => 'Debe ingresar el Detalle de DSM IV',
    'alpha' => 'Detalle de DSM IV debe contener sólo letras',
    'min_length' => 'Detalle de DSM IV tiene que tener más que 2 caracteres',
    'max_length' => 'Detalle de DSM IV debe tener menos de 20 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_psychology_therapy' => array(
    'required' => 'Debe ingresar Psicología',
    'not_empty' => 'Debe ingresar Psicología',
    'length' => 'Psicología debe tener entre 1 caracteres',
    'numeric' => 'Psicología debe contener solamente números',
    'min_length' => 'Psicología debe tener más de 1 caracteres',
    'max_length' => 'Psicología debe tener menos 1 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_consultation_reason' => array(
    'required' => 'Debe ingresar Motivo de la consulta',
    'not_empty' => 'Debe ingresar Motivo de la consulta',
    'alpha' => 'Motivo de la consulta debe contener sólo letras',
    'min_length' => 'Motivo de la consulta tiene que tener más que 1 caracteres',
    'max_length' => 'Motivo de la consulta debe tener menos de 255 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_prescription_medication' => array(
    'required' => 'Debe ingresar Medicación Recetada',
    'not_empty' => 'Debe ingresar Medicación Recetada',
    'alpha' => 'Medicación Recetada debe contener sólo letras',
    'min_length' => 'Medicación Recetada tiene que tener más que 1 caracteres',
    'max_length' => 'Medicación Recetada debe tener menos de 255 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_derivation' => array(
    'required' => 'Debe ingresar Derivación',
    'not_empty' => 'Debe ingresar Derivación',
    'alpha' => 'Derivación debe contener sólo letras',
    'min_length' => 'Derivación tiene que tener más que 2 caracteres',
    'max_length' => 'Derivación debe tener menos de 20 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_general_considerations' => array(
    'required' => 'Debe ingresar Consideraciones Generales',
    'not_empty' => 'Debe ingresar Consideraciones Generales',
    'alpha' => 'Consideraciones Generales debe contener sólo letras',
    'min_length' => 'Consideraciones Generales tiene que tener más que 2 caracteres',
    'max_length' => 'Consideraciones Generales debe tener menos de 20 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_patient_name' => array(
    'required' => 'Debe ingresar un Nombre del Paciente',
    'not_empty' => 'Debe ingresar un Nombre del Paciente',
    'alpha' => 'El Nombre del Paciente debe contener sólo letras',
    'min_length' => 'El Nombre del Paciente tiene que tener más que 2 caracteres',
    'max_length' => 'El Nombre del Paciente debe tener menos de 150 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_tracing' => array(
    'required' => 'Debe ingresar una Evaluación',
    'not_empty' => 'Debe ingresar una Evaluación',
    'alpha' => 'La Evaluación debe contener sólo letras',
    'min_length' => 'La Evaluación tiene que tener más que 2 caracteres',
    'max_length' => 'La Evaluación debe tener menos de 1500 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_user_gender' => array(
    'required' => 'Debe ingresar el Tipo Sexo',
    'not_empty' => 'Debe ingresar el Tipo Sexo',
    'length' => 'El Tipo Sexo debe tener entre 1 caracteres',
    'numeric' => 'El Tipo Sexo debe contener solamente números',
    'min_length' => 'El Tipo Sexo debe tener más de 1 caracteres',
    'max_length' => 'El Tipo Sexo debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_patient_id_patient_cardtype' => array(
    'required' => 'Debe ingresar el Tipo de identificación',
    'not_empty' => 'Debe ingresar el Tipo de identificación',
    'length' => 'El Tipo de identificación debe tener entre 1 caracteres',
    'numeric' => 'El Tipo de identificación debe contener solamente números',
    'min_length' => 'El Tipo de identificación debe tener más de 1 caracteres',
    'max_length' => 'El Tipo de identificación debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_patient_idcard' => array(
    'required' => 'Debe ingresar Número de Identificación',
    'not_empty' => 'Debe ingresar Número de Identificación',
    'length' => 'Número de Identificación debe tener entre 1 caracteres',
    'numeric' => 'Número de Identificación debe contener solamente números',
    'min_length' => 'Número de Identificación debe tener más de 1 caracteres',
    'max_length' => 'Número de Identificación debe tener menos 1 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_patient_id_patient_cardtype_name' => array(
    'required' => 'Debe ingresar un Tipo de Documento',
    'not_empty' => 'Debe ingresar un Tipo de Documento',
    'alpha' => 'El Tipo de Documento debe contener sólo letras',
    'min_length' => 'El Tipo de Documento tiene que tener más que 1 caracteres',
    'max_length' => 'El Tipo de Documento debe tener menos de 150 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_patient_id_health_insurance' => array(
    'required' => 'Debe ingresar la Obra Social',
    'not_empty' => 'Debe ingresar un Obra Social',
    'length' => 'La Obra Social debe tener entre 1 caracteres',
    'numeric' => 'La Obra Social debe contener solamente números',
    'min_length' => 'La Obra Social debe tener más de 1 caracteres',
    'max_length' => 'La Obra Social debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_patient_id_copayment_activity' => array(
    'required' => 'Debe ingresar un Tipo de Actividad',
    'not_empty' => 'Debe ingresar un Tipo de Actividad',
    'alpha' => 'El Tipo de Actividad debe contener sólo letras',
    'numeric' => 'Tipo de Actividad debe contener solamente números',
    'min_length' => 'El Tipo de Actividad tiene que tener más que 1 caracteres',
    'max_length' => 'El Tipo de Actividad debe tener menos de 150 caracteres',
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
  'esp_date_copayment' => array(
    'required' => 'Debe ingresar una Fecha para el Turno',
    'not_empty' => 'Debe ingresar una Fecha para el Turno',
    'length' => 'Fecha para el Turno debe tener entre 1 caracteres',
    'numeric' => 'Fecha para el Turno debe contener solamente números',
    'validateDate' => 'Fecha para el Turno inválida',
    'min_length' => 'Fecha para el Turno debe tener más de 1 caracteres',
    'max_length' => 'Fecha para el Turno debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_patient_email' => array(
    'required' => 'Debe ingresar un Email del paciente',
    'not_empty' => 'Debe ingresar un Email del paciente',
    'default' => 'El Email del paciente que introdujo no es válido',
    'email' => 'El Email del paciente no es válido',
    'min_length' => 'El Email del paciente deve ser superior a 6 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_appointment_hour' => array(
    'required' => 'Debe ingresar un Horario',
    'not_empty' => 'Debe ingresar un Horario',
    'alpha' => 'El Horario debe contener sólo letras',
    'min_length' => 'El Horario tiene que tener más que 2 caracteres',
    'max_length' => 'El Horario debe tener menos de 150 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_waiting_specialist' => array(
    'required' => 'Debe ingresar una Especialidad',
    'not_empty' => 'Debe ingresar una Especialidad',
    'alpha' => 'Especialidad debe contener sólo letras',
    'min_length' => 'Especialidad tiene que tener más que 1 caracteres',
    'max_length' => 'Especialidad debe tener menos de 150 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_patient_name' => array(
    'required' => 'Debe ingresar un Nombre de paciente',
    'not_empty' => 'Debe ingresar un Nombre de paciente',
    'alpha' => 'Nombre de paciente debe contener sólo letras',
    'min_length' => 'Nombre de paciente tiene que tener más que 2 caracteres',
    'max_length' => 'Nombre de paciente debe tener menos de 255 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_date_admission' => array(
    'required' => 'Debe ingresar una Fecha de Ingreso',
    'not_empty' => 'Debe ingresar una Fecha de Ingreso',
    'length' => 'Fecha de Ingreso debe tener entre 1 caracteres',
    'numeric' => 'Fecha de Ingreso debe contener solamente números',
    'validateDate' => 'Fecha de Ingreso inválida',
    'min_length' => 'Fecha de Ingreso debe tener más de 1 caracteres',
    'max_length' => 'Fecha de Ingreso debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_user_name' => array(
    'required' => 'Debe ingresar un Nombre del Profesional que deriva',
    'not_empty' => 'Debe ingresar un Nombre del Profesional que deriva',
    'alpha' => 'Nombre del Profesional que deriva debe contener sólo letras',
    'min_length' => 'Nombre del Profesional que deriva tiene que tener más que 2 caracteres',
    'max_length' => 'Nombre del Profesional que deriva debe tener menos de 255 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_equal1_id_user' => array(
    'required' => 'Debe ingresar un Profesional Externo Derivado',
    'not_empty' => 'Debe ingresar un Profesional Externo Derivado',
    'alpha_numeric' => 'El Profesional Externo Derivado debe contener sólo letras e números',
    'min_length' => 'El Profesional Externo Derivado debe tener más de 6 caracteres',
    'max_length' => 'El Profesional Externo Derivado debe tener menos de 9 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_equal1_name' => array(
    'required' => 'Debe ingresar un Nombre del Profesional Externo Derivado',
    'not_empty' => 'Debe ingresar un Nombre del Profesional Externo Derivado',
    'alpha' => 'Nombre del Profesional Externo Derivado debe contener sólo letras',
    'min_length' => 'Nombre del Profesional Externo Derivado tiene que tener más que 2 caracteres',
    'max_length' => 'Nombre del Profesional Externo Derivado debe tener menos de 255 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_dni' => array(
    'required' => 'Debe ingresar un DNI',
    'not_empty' => 'Debe ingresar un DNI',
    'numeric' => 'El DNI debe contener sólo números',
    'min_length' => 'El DNI tiene que tener más que 7 caracteres',
    'max_length' => 'El DNI tiene que tener menos que 20 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_drifting_professional' => array(
    'required' => 'Debe ingresar un Profesional que deriva',
    'not_empty' => 'Debe ingresar un Profesional que deriva',
    'alpha' => 'Profesional que deriva debe contener sólo letras',
    'min_length' => 'Profesional que deriva tiene que tener más que 2 caracteres',
    'max_length' => 'Profesional que deriva debe tener menos de 50 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_current_treating_professional' => array(
    'required' => 'Debe ingresar un Profesional tratante',
    'not_empty' => 'Debe ingresar un Profesional tratante',
    'alpha' => 'Profesional tratante debe contener sólo letras',
    'min_length' => 'Profesional tratante tiene que tener más que 2 caracteres',
    'max_length' => 'Profesional tratante debe tener menos de 50 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_next_treating_professional' => array(
    'required' => 'Debe ingresar Qué profesional lo va a tratar',
    'not_empty' => 'Debe ingresar Qué profesional lo va a tratar',
    'alpha' => 'Qué profesional lo va a tratar debe contener sólo letras',
    'min_length' => 'Qué profesional lo va a tratar tiene que tener más que 2 caracteres',
    'max_length' => 'Qué profesional lo va a tratar debe tener menos de 50 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_observation' => array(
    'required' => 'Debe ingresar una Observación',
    'not_empty' => 'Debe ingresar una Observación',
    'alpha' => 'Observación debe contener sólo letras',
    'min_length' => 'Observación tiene que tener más que 2 caracteres',
    'max_length' => 'Observación debe tener menos de 255 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_user_specialist' => array(
    'required' => 'Debe ingresar el Tipo de especialidad',
    'not_empty' => 'Debe ingresar un Tipo de especialidad',
    'length' => 'El Tipo de especialidad debe tener entre 1 caracteres',
    'numeric' => 'El Tipo de especialidad debe contener solamente números',
    'min_length' => 'El Tipo de especialidad debe tener más de 1 caracteres',
    'max_length' => 'El Tipo de especialidad debe tener menos 1 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_user_license_type' => array(
    'required' => 'Debe ingresar un Tipo de Licencia',
    'not_empty' => 'Debe ingresar un Tipo de Licencia',
    'length' => 'El Tipo de Licencia debe tener entre 1 caracteres',
    'numeric' => 'El Tipo de Licencia debe contener solamente números',
    'alpha' => 'Tipo de Licencia debe contener sólo letras',
    'min_length' => 'El Tipo de Licencia debe tener más de 1 caracteres',
    'max_length' => 'El Tipo de Licencia debe tener menos 1 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_detail' => array(
    'required' => 'Debe ingresar un Detalle',
    'not_empty' => 'Debe ingresar un Detalle',
    'alpha' => 'Detalle debe contener sólo letras',
    'min_length' => 'Detalle tiene que tener más que 2 caracteres',
    'max_length' => 'Detalle debe tener menos de 255 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_quantity' => array(
    'required' => 'Debe ingresar un La cantidad de Días',
    'not_empty' => 'Debe ingresar un La cantidad de Días',
    'numeric' => 'La cantidad de Días debe contener sólo números',
    'min_length' => 'La cantidad de Días tiene que tener más que 1 caracteres',
    'max_length' => 'La cantidad de Días tiene que tener menos que 2 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_admission' => array(
    'required' => 'Debe ingresar una Admisión',
    'not_empty' => 'Debe ingresar una Admisión',
    'length' => 'Admisión deve ser un caractere',
    'numeric' => 'Admisión deve conter apenas números',
    'min_length' => 'Admisión tiene que tener más que 1 caracteres',
    'max_length' => 'Admisión deve estar sob 3 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_license_start' => array(
    'required' => 'Debe ingresar una Fecha de Inicio',
    'not_empty' => 'Debe ingresar una Fecha de Inicio',
    'length' => 'Fecha de Inicio debe tener entre 1 caracteres',
    'numeric' => 'Fecha de Inicio debe contener solamente números',
    'validateDate' => 'Fecha de Inicio inválida',
    'min_length' => 'Fecha de Inicio debe tener más de 1 caracteres',
    'max_length' => 'Fecha de Inicio debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_license_end' => array(
    'required' => 'Debe ingresar una Fecha de Finalización',
    'not_empty' => 'Debe ingresar una Fecha de Finalización',
    'length' => 'Fecha de Finalización debe tener entre 1 caracteres',
    'numeric' => 'Fecha de Finalización debe contener solamente números',
    'validateDate' => 'Fecha de Finalización inválida',
    'min_length' => 'Fecha de Finalización debe tener más de 1 caracteres',
    'max_length' => 'Fecha de Finalización debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_user_availability' => array(
    'required' => 'Debe ingresar una Disponibilidad',
    'not_empty' => 'Debe ingresar una Disponibilidad',
    'alpha_numeric' => 'La Disponibilidad debe contener sólo letras e números',
    'numeric' => 'La Disponibilidad debe contener sólo números',
    'min_length' => 'La Disponibilidad debe tener más de 1 caracteres',
    'max_length' => 'La Disponibilidad debe tener menos de 9 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_user_availability_module' => array(
    'required' => 'Debe ingresar un Modulo',
    'not_empty' => 'Debe ingresar un Modulo',
    'alpha_numeric' => 'El Modulo debe contener sólo letras e números',
    'numeric' => 'El Modulo debe contener sólo números',
    'min_length' => 'El Modulo debe tener más de 1 caracteres',
    'max_length' => 'El Modulo debe tener menos de 9 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_user_availability_day' => array(
    'required' => 'Debe ingresar un Día',
    'not_empty' => 'Debe ingresar un Día',
    'alpha_numeric' => 'El Día debe contener sólo letras e números',
    'numeric' => 'El Día debe contener sólo números',
    'min_length' => 'El Día debe tener más de 1 caracteres',
    'max_length' => 'El Día debe tener menos de 9 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_date_from' => array(
    'required' => 'Debe ingresar un Día de inicio',
    'not_empty' => 'Debe ingresar un Día de inicio',
    'length' => 'Día de inicio debe tener entre 1 caracteres',
    'numeric' => 'Día de inicio debe contener solamente números',
    'validateTime' => 'Día de inicio inválida',
    'min_length' => 'Día de inicio debe tener más de 10 caracteres',
    'max_length' => 'Día de inicio debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_date_to' => array(
    'required' => 'Debe ingresar un Día de Finalización',
    'not_empty' => 'Debe ingresar un Día de Finalización',
    'length' => 'Día de Finalización debe tener entre 1 caracteres',
    'numeric' => 'Día de Finalización debe contener solamente números',
    'validateTime' => 'Día de Finalización inválida',
    'min_length' => 'Día de Finalización debe tener más de 10 caracteres',
    'max_length' => 'Día de Finalización debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_attends_from' => array(
    'required' => 'Debe ingresar Una Hora de inicio',
    'not_empty' => 'Debe ingresar Una Hora de inicio',
    'length' => 'Hora de inicio debe tener entre 1 caracteres',
    'numeric' => 'Hora de inicio debe contener solamente números',
    'validateTime' => 'Hora de inicio inválida',
    'min_length' => 'Hora de inicio debe tener más de 8 caracteres',
    'max_length' => 'Hora de inicio debe tener menos 8 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_attend_to' => array(
    'required' => 'Debe ingresar Una Hora de Finalización',
    'not_empty' => 'Debe ingresar Una Hora de Finalización',
    'length' => 'Hora de Finalización debe tener entre 1 caracteres',
    'numeric' => 'Hora de Finalización debe contener solamente números',
    'validateTime' => 'Hora de Finalización inválida',
    'min_length' => 'Hora de Finalización debe tener más de 8 caracteres',
    'max_length' => 'Hora de Finalización debe tener menos 8 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_availability_time' => array(
    'required' => 'Debe seleccionar al menos un Tratamiento',
    'not_empty' => 'Debe ingresar Una Minutos',
    'length' => 'Minutos debe tener entre 1 caracteres',
    'numeric' => 'Minutos debe contener solamente números',
    'validateTime' => 'Minutos inválida',
    'min_length' => 'Minutos debe tener más de 1 caracteres',
    'max_length' => 'Minutos debe tener menos 2 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_user_availability_treatment' => array(
    'required' => 'Debe seleccionar al menos un Tratamiento',
    'not_empty' => 'Debe seleccionar al menos un Tratamiento',
    'length' => 'Tratamiento debe tener entre 1 caracteres',
    'numeric' => 'Tratamiento debe contener solamente números',
    'validateNumericArray' => 'Tratamiento inválido',
    'min_length' => 'Tratamiento debe tener más de 1 caracteres',
    'max_length' => 'Tratamiento debe tener menos 2 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_user_avatar' => array(
    'required' => 'Debe ingresar un Avatar',
    'not_empty' => 'Debe ingresar un Avatar',
    'alpha_numeric' => 'El Avatar debe contener sólo letras e números',
    'numeric' => 'El Avatar debe contener sólos números',
    'min_length' => 'El Avatar debe tener más de 1 caracteres',
    'max_length' => 'El Avatar debe tener menos de 2 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_minutes' => array(
    'required' => 'Debe ingresar los Minutos del tratamiento',
    'not_empty' => 'Debe ingresar al menos un Minuto del tratamiento',
    'length' => 'Minutos del tratamiento debe tener entre 1 caracteres',
    'numeric' => 'Minutos del tratamiento debe contener solamente números',
    'validateTime' => 'Minutos del tratamiento inválida',
    'min_length' => 'Minutos del tratamiento debe tener más de 1 caracteres',
    'max_length' => 'Minutos del tratamiento debe tener menos 3 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_province_name' => array(
    'required' => 'Debe ingresar un Nombre de Provincia',
    'not_empty' => 'Debe ingresar un Nombre de Provincia',
    'alpha' => 'El Nombre de Provincia debe contener sólo letras',
    'min_length' => 'El Nombre de Provincia tiene que tener más que 2 caracteres',
    'max_length' => 'El Nombre de Provincia debe tener menos de 150 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_enrollment_type' => array(
    'required' => 'Debe ingresar un Tipo de Matricula',
    'not_empty' => 'Debe ingresar un Tipo de Matricula',
    'length' => 'El Tipo de Matricula debe tener entre 1 caracteres',
    'numeric' => 'El Tipo de Matricula debe contener solamente números',
    'min_length' => 'El Tipo de Matricula debe tener más de 1 caracteres',
    'max_length' => 'El Tipo de Matricula debe tener menos 10 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_enrollment' => array(
    'required' => 'Debe ingresar una Matricula',
    'not_empty' => 'Debe ingresar una Matricula',
    'length' => 'La Matricula Matricula debe tener entre 1 caracteres',
    'numeric' => 'La Matricula Matricula debe contener solamente números',
    'min_length' => 'La Matricula Matricula debe tener más de 1 caracteres',
    'max_length' => 'La Matricula Matricula debe tener menos 15 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_cuit_cuil' => array(
    'required' => 'Debe ingresar un CUIT / CUIL',
    'not_empty' => 'Debe ingresar un CUIT / CUIL',
    'numeric' => 'El CUIT / CUIL debe contener sólo números',
    'min_length' => 'El CUIT / CUIL tiene que tener más que 9 caracteres',
    'max_length' => 'El CUIT / CUIL tiene que tener menos que 13 caracteres',
    'default' => 'Contenido no válido'
  ),
  'esp_id_user_gallery' => array(
    'required' => 'Debe ingresar un Id de galería',
    'not_empty' => 'Debe ingresar un Id de galería',
    'alpha_numeric' => 'El Id de galería debe contener sólo letras e números',
    'numeric' => 'El Id de galería debe contener sólos números',
    'min_length' => 'El Id de galería debe tener más de 6 caracteres',
    'max_length' => 'El Id de galería debe tener menos de 9 caracteres',
    'default' => 'Contenido no válido'
  ),






  //  ENGLISH
  'eng_id_user' => array(
    'required' => 'You must enter a User',
    'not_empty' => 'You must enter a User',
    'alpha_numeric' => 'The Usere must contain only letters and numbers',
    'numeric' => 'The User it must contain only numbers',
    'min_length' => 'The User must have more than 1 characters',
    'max_length' => 'The User must be less than 3 characters',
    'default' => 'Invalid contents'
  ),
  'eng_id_setting_country_language' => array(
    'required' => 'You must enter a Country',
    'not_empty' => 'You must enter a Country',
    'alpha_numeric' => 'The Country must contain only letters and numbers',
    'length' => 'The Country it must be a caractere',
    'numeric' => 'The Country it must contain only numbers',
    'min_length' => 'The Country must have more than 1 characters',
    'max_length' => 'The Country must be less than 3 characters',
    'default' => 'Invalid contents'
  ),
  'eng_first_name' => array(
    'required' => 'You must enter a First Name',
    'not_empty' => 'You must enter a First Name',
    'alpha' => 'The First Name must contain only letters',
    'min_length' => 'The First Name must have more than 2 characters',
    'max_length' => 'The First Name must be less than 20 characters',
    'default' => 'Invalid contents'
  ),
  'eng_last_name' => array(
    'required' => 'You must enter a Last Name',
    'not_empty' => 'You must enter a Last Name',
    'alpha' => 'The Last Name must contain only letters',
    'min_length' => 'The Last Name must have more than 2 characters',
    'max_length' => 'The Last Name must be less than 20 characters',
    'default' => 'Invalid contents'
  ),
  'eng_email' => array(
    'required' => 'You must enter a Email',
    'not_empty' => 'You must enter a Email',
    'default' => 'The Email entered is not valid',
    'min_length' => 'The Email must be greater than 6 characters',
    'default' => 'Invalid contents'
  ),
  'eng_password' => array(
    'required' => 'You must enter an Password',
    'not_empty' => 'You must enter an Password',
    'alpha_numeric' => 'The Password must contain only letters and numbers',
    'alpha_dash' => 'The Password must contain only alphabetical characters, numbers, underscores and dashes',
    'min_length' => 'The Password must have more than 6 characters',
    'max_length' => 'The Password tiene que tener menos que 20 characters',
    'default' => 'Invalid contents'
  ),
  'esp_cell_phone' => array(
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
    'max_length' => 'The Message must be less than 500 characters',
    'default' => 'Invalid contents'
  ),
  'eng_name' => array(
    'required' => 'You must enter a Name',
    'not_empty' => 'You must enter a Name',
    'alpha' => 'The Name must contain only letters',
    'min_length' => 'The Name must have more than 2 characters',
    'max_length' => 'The Name must be less than 20 characters',
    'default' => 'Invalid contents'
  ),
  'eng_phone' => array(
    'required' => 'You must enter a Phone',
    'not_empty' => 'You must enter a Phone',
    'numeric' => 'The Phone must contain only letters',
    'min_length' => 'The Phone debe ser más de 5 characters',
    'max_length' => 'The Phone must be less than 255 characters',
    'default' => 'Invalid contents'
  ),
  'eng_id_user_type' => array(
    'required' => 'You must enter a User Type',
    'not_empty' => 'You must enter a User Type',
    'alpha_numeric' => 'The User Type must contain only letters and numbers',
    'length' => 'The User Type it must be a caractere',
    'numeric' => 'The User Type it must contain only numbers',
    'min_length' => 'The User Type must have more than 1 characters',
    'max_length' => 'The User Type must be less than 3 characters',
    'default' => 'Invalid contents'
  ),




  // PORTUGUES
  'por_id_user' => array(
    'required' => 'Você deve digitar o usuário',
    'not_empty' => 'Você deve digitar o usuário',
    'length' => 'O usuário deve ser um caractere',
    'numeric' => 'O usuário deve conter apenas números',
    'min_length' => 'O usuário deve ser mais do que 1 personagem',
    'max_length' => 'O usuário deve estar sob 3 personagem'
  ),
  'por_id_setting_country_language' => array(
    'required' => 'Você deve digitar um País',
    'not_empty' => 'Você deve digitar um País',
    'length' => 'O País deve ser um caractere',
    'numeric' => 'O País deve conter apenas números',
    'min_length' => 'O País deve ser mais do que 1 personagem',
    'max_length' => 'O País deve estar sob 3 personagem'
  ),
  'por_first_name' => array(
    'required' => 'Você deve digitar um Nome',
    'not_empty' => 'Você deve digitar um Nome',
    'alpha' => 'O Nome deve conter apenas letras',
    'min_length' => 'O Nome deve ser mais do que 2 personagens',
    'max_length' => 'O Nome deve ter menos de 20 personagem',
    'default' => 'Conteúdo inválido'
  ),
  'por_last_name' => array(
    'required' => 'Você deve digitar um Sobrenome',
    'not_empty' => 'Você deve digitar um Sobrenome',
    'alpha' => 'O Sobrenome deve conter apenas letras',
    'min_length' => 'O Sobrenome deve ser mais do que 2 personagem',
    'max_length' => 'O Sobrenome deve ter menos de 20 personagem',
    'default' => 'Conteúdo inválido'
  ),
  'por_email' => array(
    'required' => 'Você deve digitar um Email',
    'not_empty' => 'Você deve digitar um Email',
    'default' => 'O Email digitado não é válido',
    'min_length' => 'O Email deve ser superior a 6 personagem',
    'default' => 'Conteúdo inválido'
  ),
  'por_password' => array(
    'required' => 'Você deve digitar uma Senha',
    'not_empty' => 'Você deve digitar uma Senha',
    'alpha_numeric' => 'A Senha deve conter apenas letras e números',
    'alpha_dash' => 'A Senha deve conter apenas letras caracteres, números, underscores and dashes',
    'min_length' => 'A Senha deve ter mais de 6 personagem',
    'max_length' => 'A Senha deve ter menos de 20 personagem',
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
    'max_length' => 'O Comentário deve ser inferior a 500 personagem',
    'default' => 'Conteúdo inválido'
  ),
  'por_name' => array(
    'required' => 'Você deve digitar um Nome',
    'not_empty' => 'Você deve digitar um Nome',
    'alpha' => 'O Nome deve conter apenas letras',
    'min_length' => 'O Nome deve ser mais do que 2 personagens',
    'max_length' => 'O Nome deve ter menos de 20 personagem',
    'default' => 'Conteúdo inválido'
  ),
  'por_cephone' => array(
    'required' => 'Você deve digitar um Phone',
    'not_empty' => 'Você deve digitar um Phone',
    'alpha' => 'O Phone deve conter apenas letras',
    'min_length' => 'O Phone deve ser mais de 2 personagem',
    'max_length' => 'O Phone deve ser inferior a 500 personagem',
    'default' => 'Conteúdo inválido'
  ),
  'por_id_user_type' => array(
    'required' => 'Você deve digitar um Tipo de usuário',
    'not_empty' => 'Você deve digitar um Tipo de usuário',
    'length' => 'O Tipo de usuário deve ser um caractere',
    'numeric' => 'O Tipo de usuário deve conter apenas números',
    'min_length' => 'O Tipo de usuário deve ser mais do que 1 personagem',
    'max_length' => 'O Tipo de usuário deve estar sob 3 personagem'
  ),

);
