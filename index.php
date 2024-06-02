<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  
  $messages = array();

  if (!empty($_COOKIE['save'])) {
    setcookie('save', '', 100000);
    // Если есть параметр save, то выводим сообщение пользователю.
    $messages[] = 'Результаты сохранены.';
  }

  // Складываем признак ошибок в массив.
  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['phone'] = !empty($_COOKIE['phone_error']);
  $errors['year'] = !empty($_COOKIE['year_error']);
  $errors['gender'] = !empty($_COOKIE['gender_error']);
  $errors['lang'] = !empty($_COOKIE['lang_error']);
  $errors['bio'] = !empty($_COOKIE['bio_error']);

  // Выдаем сообщения об ошибках.
  if ($errors['name']) {
    setcookie('name_error', '', 100000);
    $messages[] = '<div class="pas error">Имя не заполнено или у него неверный формат!</div>';
  }
  if ($errors['email']) {
    setcookie('email_error', '', 100000);
    $messages[] = '<div class="pas error">Email не заполнен или у него неверный формат!</div>';
  }

  if ($errors['phone']) {
    setcookie('phone_error', '', 100000);
    $messages[] = '<div class="pas error">Введите телефон.</div>';
  }

  if ($errors['year']) {
    setcookie('year_error', '', 100000);
    $messages[] = '<div class="pas error">Выберите год!</div>';
  }
  if ($errors['gender']) {
    setcookie('gender', '', 100000);
    $messages[] = '<div class="pas error">Выберите пол!</div>';
  }

  if ($errors['lang']) {
    setcookie(';ang_error', '', 100000);
    $messages[] = '<div class="pas error">Выберите хотя бы один язык программирования!</div>';
  }
  if ($errors['bio']) {
    setcookie('bio_error', '', 100000);
    $messages[] = '<div class="pas error">Биография не заполнена или у неё неверный формат!</div>';
  }
  
  // Складываем предыдущие значения полей в массив, если есть.
  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['phone'] = empty($_COOKIE['phone_value']) ? '' : $_COOKIE['phone_value'];
  $values['year'] = empty($_COOKIE['year_value']) ? 0 : $_COOKIE['year_value'];
  $values['gender'] = empty($_COOKIE['gender']) ? '' : $_COOKIE['gender_value'];
  $values['Python'] = empty($_COOKIE['Python']) ? 0 : $_COOKIE['Python'];
  $values['C++'] = empty($_COOKIE['C++']) ? 0 : $_COOKIE['C++'];
  $values['Java'] = empty($_COOKIE['Java']) ? 0 : $_COOKIE['Java'];
  $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];

  // Включаем содержимое файла form.php.
  // В нем будут доступны переменные $messages, $errors и $values для вывода 
  // сообщений, полей с ранее заполненными данными и признаками ошибок.
  include('form.php');
}
else {
  //Регулярные выражения
  $bioregex = "/^\s*\w+[A-Za-zА-Яа-я\w\s\.,-]*$/";
  $nameregex = "/^\w+[A-Za-zА-Яа-я\w\s-]*$/";
  $mailregex = "/^[\w\.-]+@([\w-]+\.)+[\w-]{2,4}$/";
	
  // Проверяем ошибки.
  $errors = FALSE;
  if ((empty($_POST['name'])) || (!preg_match($nameregex,$_POST['name']))) {
    setcookie('name_error', '1', time() + 24 * 60 * 60);
    setcookie('name_value', '', 100000);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на год.
    setcookie('name_value', $_POST['name'], time() + 12 * 30 * 24 * 60 * 60);
    setcookie('name_error', '', 100000);
  }
  
  if ((empty($_POST['email'])) || (!preg_match($mailregex,$_POST['email']))) {
    setcookie('email_error', '1', time() + 24 * 60 * 60);
    setcookie('email_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('email_value', $_POST['email'], time() + 12 * 30 * 24 * 60 * 60);
    setcookie('email_error', '', 100000);
  }

  if ((empty($_POST['phone']))) {
    setcookie('phone_error', '1', time() + 24 * 60 * 60);
    setcookie('phone_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('phone_value', $_POST['phone'], time() + 12 * 30 * 24 * 60 * 60);
    setcookie('phone_error', '', 100000);
  }
  
  if (empty($_POST['year'])) {
    setcookie('year_error', '1', time() + 24 * 60 * 60);
    setcookie('year_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('year_value', intval($_POST['year']), time() + 12 * 30 * 24 * 60 * 60);
    setcookie('year_error', '', 100000);
  }
  
  if (!isset($_POST['gender'])) {
    setcookie('gender_error', '1', time() + 24 * 60 * 60);
    setcookie('gender_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('gender_value', $_POST['gender'], time() + 12 * 30 * 24 * 60 * 60);
    setcookie('gender_error','',100000);
  }
  
    
  if (!isset($_POST['lang'])) {
    setcookie('lang_error', '1', time() + 24 * 60 * 60);
    setcookie('Python', '', 100000);
    setcookie('C++', '', 100000);
    setcookie('Java', '', 100000);
    $errors = TRUE;
  }
  else {
    $Lang=$_POST['lang'];
    $apw=array(
      "Python"=>0,
      "C++"=>0,
      "Java"=>0,
    );
  foreach($Lang as $lng){
    if($lng=='Python'){setcookie('Python', 1, time() + 12 * 30 * 24 * 60 * 60); $apw['Python']=1;} 
    if($lng=='C++'){setcookie('C++', 1, time() + 12*30 * 24 * 60 * 60);$apw['C++']=1;} 
    if($lng=='Java'){setcookie('Java', 1, time() + 12*30 * 24 * 60 * 60);$apw['Java']=1;} 
    }
  foreach($apw as $c=>$val){
    if($val==0){
      setcookie($c,'',100000);
    }
  }
}
  
  if ((empty($_POST['bio'])) || (!preg_match($bioregex,$_POST['bio']))) {
    setcookie('bio_error', '1', time() + 24 * 60 * 60);
    setcookie('bio_value', '', 100000);
    $errors = TRUE;
  }
  else {
    setcookie('bio_value', $_POST['bio'], time() + 12 * 30 * 24 * 60 * 60);
    setcookie('bio_error', '', 100000);
  }
  
  if ($errors) {
    // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
    header('Location: index.php');
    exit();
  }
  else {
    // Удаляем Cookies с признаками ошибок.
    setcookie('name_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('year_error', '', 100000);
    setcookie('phone_error', '', 100000);
    setcookie('gender_error', '', 100000);
    setcookie('lang_error', '', 100000);
    setcookie('bio_error', '', 100000);
  }

$lang_separated=implode(' ',$Lang);
  
$errors = FALSE;
$name = $_POST["name"];
$mail = $_POST["email"];
$year = $_POST["year"];
$sex =	$_POST["gender"];
$phone = $_POST["phone"];
$biography = $_POST["bio"];	
$check1 = $_POST["check1"];

  // Сохранение в БД.
  $user = 'u67393';
  $pass = '4711369';
  $db = new PDO('mysql:host=localhost;dbname=u67393', $user, $pass,
  array(PDO::ATTR_PERSISTENT => true));
  try {
   $stmt = $db->prepare("INSERT INTO application (name, mail, year, sex, phone, lang, biography, check1) 
   VALUES (:name, :email, :year, :gender, :phone , :lang, :bio, :check1)");
  $stmt->bindParam(':name', $name_db);
  $stmt->bindParam(':email', $mail_db);
  $stmt->bindParam(':year', $year_db);
  $stmt->bindParam(':gender', $sex_db);
  $stmt->bindParam(':phone', $phone_db);
  $stmt->bindParam(':lang', $lang_db);
  $stmt->bindParam(':bio', $bio_db);
  $stmt->bindParam(':check1', $check_db);
  $name_db=$_POST["name"];
  $mail_db=$_POST["email"];
  $year_db=$_POST["year"];
  $sex_db=$_POST["gender"];
  $phone_db=$_POST["phone"];
  $lang_db=$lang_separated;
  $bio_db=$_POST["bio"];
  $check_db=$_POST["check1"];
  $stmt->execute();
  $power_id = $db->lastInsertId();

  $languages = $db->prepare("INSERT INTO langs SET lang_id = ?, langs = ?");
  $languages -> execute(array($power_id, $lang_separated));
  }
  catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    exit();
  }

  // Сохраняем куку с признаком успешного сохранения.
  setcookie('save', '1');

  // Делаем перенаправление.
  header('Location: index.php');
}