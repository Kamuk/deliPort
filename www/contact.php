<?php 

//======================================================================
// Variables
//======================================================================


//E-mail address. Enter your email
define("__TO__", "info@deliport.ru");

//Success message
define('__SUCCESS_MESSAGE__', "Ваше сообщение успешно отправлено, мы ответим в скором времени. Спасибо!");

//Error message 
define('__ERROR_MESSAGE__', "Ваше сообщение не было отправлено, попробуйте снова. Либо позвоните по телефону 8(965)360-45-63");

//Messege when one or more fields are empty
define('__MESSAGE_EMPTY_FIELDS__', "Пожалуйста, заполните все поля.");


//======================================================================
// Do not change
//======================================================================

//E-mail validation
// function check_email($email){
//     if(!@eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
//         return false;
//     } else {
//         return true;
//     }
// }

//Send mail
function send_mail($to,$subject,$message,$headers){
	if(@mail($to,$subject,$message,$headers)){
		echo json_encode(array('info' => 'success', 'msg' => __SUCCESS_MESSAGE__));
	} else {
		echo json_encode(array('info' => 'error', 'msg' => __ERROR_MESSAGE__));
	}
}

//Get data form and send mail
if (isset($_POST['name']) and isset($_POST['phone']) and isset($_POST['emaild']) and isset($_POST['whence']) and isset($_POST['where']) and isset($_POST['weight']) and isset($_POST['date'])){
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$mail = $_POST['emaild'];
	$whence = $_POST['whence'];
	$where = $_POST['where'];
	$weight = $_POST['weight'];
	$date = $_POST['date'];
	$subjectForm = 'Заявка от клиента deliPort: ';

	if($name === '') {
		echo json_encode(array('info' => 'error', 'msg' => "Пожалуйста введите имя."));
		exit();
	} else if($mail === ''){
		echo json_encode(array('info' => 'error', 'msg' => "Пожалуйста введите корректный e-mail."));
		exit();
	} else {
		$to = __TO__;
		$subject = $subjectForm . ' ' . $name;
		$message = '
		<html>
		<head>
		  <title>Mail from '. $name .'</title>
		</head>
		<body>
		  <table style="width: 500px; font-family: arial; font-size: 14px;" border="1">
			<tr style="height: 32px;">
			  <th align="right" style="width:150px; padding-right:5px;">ФИО:</th>
			  <td align="left" style="padding-left:5px; line-height: 20px;">'. $name .'</td>
			</tr>
			<tr style="height: 32px;">
			  <th align="right" style="width:150px; padding-right:5px;">Мобильный:</th>
			  <td align="left" style="padding-left:5px; line-height: 20px;">'. $phone .'</td>
			</tr>
			<tr style="height: 32px;">
			  <th align="right" style="width:150px; padding-right:5px;">E-mail:</th>
			  <td align="left" style="padding-left:5px; line-height: 20px;">'. $mail .'</td>
			</tr>
			<tr style="height: 32px;">
			  <th align="right" style="width:150px; padding-right:5px;">Откуда:</th>
			  <td align="left" style="padding-left:5px; line-height: 20px;">'. $whence .'</td>
			</tr>
			<tr style="height: 32px;">
			  <th align="right" style="width:150px; padding-right:5px;">Куда:</th>
			  <td align="left" style="padding-left:5px; line-height: 20px;">'. $where  .'</td>
			</tr>
			<tr style="height: 32px;">
			  <th align="right" style="width:150px; padding-right:5px;">Вес посылки:</th>
			  <td align="left" style="padding-left:5px; line-height: 20px;">'. $weight  .'</td>
			</tr>
			<tr style="height: 32px;">
			  <th align="right" style="width:150px; padding-right:5px;">Желаемая дата прибытия:</th>
			  <td align="left" style="padding-left:5px; line-height: 20px;">'. $date  .'</td>
			</tr>
		  </table>
		</body>
		</html>
		';

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: ' . $mail . "\r\n";

		send_mail($to,$subject,$message,$headers);
	}
} else {
	echo json_encode(array('info' => 'error', 'msg' => __MESSAGE_EMPTY_FIELDS__));
}
 ?>