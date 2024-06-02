<style>
	
body{
  background-image: url("bab.png");
  background-size: no-repeat;
  display: block;
  justify-content:center;
  margin-top:2%;
  margin-bottom:5%;
}
	
.main{  
  padding: 40px;
  width: 250px;
  margin-left: auto;
  margin-right: auto;
   background: linear-gradient(135deg,#c0baf8,#ff3b3b,#42e700);
   animation: animate 2.5s linear infinite;
  background-color: 	;
  border: 2px solid #26527C;
}
@keyframes animate{
  100%{filter: hue-rotate(360deg);}
}

h1{
  margin-left: 25%;
  margin-right: 25%;
}

p{
  padding: 5%;
  border: 1px solid #26527C;
  border-radius: 3px;
}

.button {
  display: flex;
  align-items: center;
  justify-content: center;
}

.pas{
    margin:2%;
    padding: 5%;
    border: 1px solid;
    border-color: #00FA9A	;
    border-radius: 3px;
}
	
.error {
    border-color: #32CD32;
  }
	
</style>

<body>
    <div class="main">
    <?php
       if (!empty($messages)) {
          print('<div id="messages">');
          // Выводим все сообщения.
          foreach ($messages as $message) {
          print($message);
       }
       print('</div>');
       }
    ?>
    <h1>Форма</h1>
    
    <form action="index.php" method="POST">
            <div class="pas <?php if ($errors['name']) {print 'error';} ?>" >
                Имя:
                <input name="name" placeholder="Введите имя" 
                 value="<?php print $values['name']; ?>" />
            </div>

            <div class="pas <?php if ($errors['email']) {print 'error';} ?>">
                E-mail:
                <input name="email" type="email" placeholder="Введите почту" value="<?php print $values['email']; ?>"
	            >
            </div>

            <div class="pas <?php if ($errors['phone']) {print 'error';} ?>">
                Телефон:
                <input name="phone" type="phone" placeholder="Введите телефон" value="<?php print $values['phone']; ?>"
	            >
            </div>

            <div class="pas" >
                Год рождения:
                <input type="date" class="form-control" aria-describedby="basic-addon3"  name="year" value="<?php print $values['year']; ?>"/>
            </div>

            <div class="pas <?php if ($errors['gender']) {print 'error';} ?>"> 
                Пол:<br>
                <input type="radio" name="gender" value="male"  <?php if($values['gender']=="male") {print 'checked';} ?>/>
                Мужской
                <input type="radio" name="gender" value="female" <?php if($values['gender']=="female") {print 'checked';} ?>/>
                Женский
            </div>

            <div class="pas <?php if ($errors['lang']) {print 'error';} ?>">
                Выберите любимый язык программирования:
                
                    <select name="lang[]" multiple="multiple">
                    <?php if ($errors['lang']) {print 'class="error"';} ?> >
                    <option value="Python" <?php if($values['Python']==1){print 'selected';} ?>>Python</option>
                    <option value="C++" <?php if($values['C++']==1){print 'selected';} ?>>C++</option>
                    <option value="Java" <?php if($values['Java']==1){print 'selected';} ?>>Java</option>
                    </select>
                
            </div>

            <div class="pas <?php if ($errors['bio']) {print 'error';} ?>">
                Биография:
                <textarea name="bio"><?php print $values['bio']; ?></textarea>
            </div>

            <div class="pas">
            <input type="checkbox" name="check1" required value="on" /> С контактом ознакомлен(а)
            </div>


            <p class = "button">
                <input type="submit" value="Отправить" />
            </p>
        </form>
    </div>
</body>