<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";


  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); // 1 argument= connection a la base de donnée, 2= utilisateur, 3=mdp
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage()); //va chercher la fonction getmessage() qui existe déjà
  }


// créer la table dans bdd si elle n'a pas déjà été créée
  $query = "CREATE TABLE IF NOT EXISTS `user`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
    `mail` VARCHAR(50) NOT NULL ,
    `password` INT(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;
  )";

  $request = $dB->prepare($query);
  $request->execute();
  $request->closeCursor(); // pour finir la requête


function insertUser($email, $passwordUser){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

  $result = emailExist($email);
  if($result == 'return ok'){
    $query = "INSERT INTO `user`(`mail`, `password`) VALUES (:mail,:password)";
    $passwordUser = password_hash($passwordUser, PASSWORD_DEFAULT);
    $arrayValue = [
      ':mail'=>$email,
      ':password'=>$passwordUser
    ];
    $request = $dB->prepare($query);
    if($request->execute($arrayValue)){
      return 'ok';
    }
  }else{
    return "l'email existe déjà. Veuillez vous connecter.";
  }
}

function emailExist($email){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

  $query = "SELECT `mail` FROM `user`";
  $request = $dB->prepare($query);
  $request->execute();

  while($donnees = $request->fetch()){
    if($donnees['mail'] == $email){
      return 'email existant';
    }else{
      return 'return ok';
    }
    $request->closeCursor();
  }
}

function connectUser($email, $passwordUser){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

  $query = "SELECT `password` FROM `user` WHERE `mail`=:mail";
  $request = $dB->prepare($query);
  $arrayValue = [
    ':mail'=>$email
  ];
  if($request->execute($arrayValue)){
    $donnees = $request->fetch();
    if(password_verify($passwordUser, $donnees['password'])){
      return 'connexion ok';
    }else{
      return 'password pas ok';
    }
    $request->closeCursor();
  }
}



// CREATION TABLES OF DIFFERENTES SECTION IN DB
function featured(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "CREATE TABLE IF NOT EXISTS `featured`(
    `id_featured` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
    `image` VARCHAR(255) NOT NULL , PRIMARY KEY (`id_featured`)) ENGINE = MyISAM;
  )";
  $request = $dB->prepare($query);
  $request->execute();
  $request->closeCursor();
}

function countries(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "CREATE TABLE IF NOT EXISTS `countries`(
    `id_countries` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
    `image` VARCHAR(255) NOT NULL ,
    `titre` VARCHAR(255) NOT NULL ,
    `contenu` TEXT NOT NULL , PRIMARY KEY (`id_countries`)) ENGINE = MyISAM;
  )";
  $request = $dB->prepare($query);
  $request->execute();
  $request->closeCursor();
}

function events(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "CREATE TABLE IF NOT EXISTS `events`(
    `id_events` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
    `date` DATE NOT NULL ,
    `titre` VARCHAR(255) NOT NULL ,
    `contenu` TEXT NOT NULL ,
    `horaires` TIME NOT NULL , PRIMARY KEY (`id_events`)) ENGINE = MyISAM;
  )";
  $request = $dB->prepare($query);
  $request->execute();
  $request->closeCursor();
}

function news(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "CREATE TABLE IF NOT EXISTS `news`(
    `id_news` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
    `image` VARCHAR(255) NOT NULL ,
    `date` DATE NOT NULL ,
    `titre` VARCHAR(255) NOT NULL , PRIMARY KEY (`id_news`)) ENGINE = MyISAM;
  )";
  $request = $dB->prepare($query);
  $request->execute();
  $request->closeCursor();
}

function services(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "CREATE TABLE IF NOT EXISTS `services`(
    `id_services` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
    `icone` VARCHAR(255) NOT NULL ,
    `titre` VARCHAR(255) NOT NULL ,
    `contenu` TEXT NOT NULL , PRIMARY KEY (`id_services`)) ENGINE = MyISAM;
  )";
  $request = $dB->prepare($query);
  $request->execute();
  $request->closeCursor();
}

function testimonial(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "CREATE TABLE IF NOT EXISTS `testimonial`(
    `id_testimonial` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
    `image` VARCHAR(255) NOT NULL ,
    `prenom` VARCHAR(255) NOT NULL ,
    `nom` VARCHAR(255) NOT NULL ,
    `metier` VARCHAR(255) NOT NULL ,
    `contenu` TEXT NOT NULL , PRIMARY KEY (`id_testimonial`)) ENGINE = MyISAM;
  )";
  $request = $dB->prepare($query);
  $request->execute();
  $request->closeCursor();
}

function createTable(){
  featured();
  countries();
  events();
  news();
  services();
  testimonial();
}

createtable();


// INSERTION IN DATABASE
function featuredInsert($image){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "INSERT INTO `featured`(`image`) VALUES (:image)";
  $arrayValue = [
    ':image' =>$image
  ];
  $request = $dB->prepare($query);
  $request->execute($arrayValue);
  $request->closeCursor();
}

function servicesInsert($title,$content,$icon){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "INSERT INTO `services`(`icone`,`titre`, `contenu`) VALUES (:icon,:title, :contenu )";
  $arrayValue = [
    ':icon' =>$icon,
    ':title' =>$title,
    ':contenu' =>$content
  ];
  $request = $dB->prepare($query);
  $request->execute($arrayValue);
  $request->closeCursor();
}

function newsInsert($date,$title,$image){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "INSERT INTO `news`(`image`,`date`, `titre`) VALUES (:image,:date, :title )";
  $arrayValue = [
    ':image' =>$image,
    ':date' =>$date,
    ':title' =>$title
  ];
  $request = $dB->prepare($query);
  $request->execute($arrayValue);
  $request->closeCursor();
}

function eventsInsert($date,$title,$content,$hours){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "INSERT INTO `events`(`date`, `titre`, `contenu`, `horaires`) VALUES (:date,:title,:contenu,:hours)";
  $arrayValue = [
    ':date' =>$date,
    ':title' =>$title,
    ':contenu' =>$content,
    ':hours' =>$hours
  ];
  $request = $dB->prepare($query);
  $request->execute($arrayValue);
  $request->closeCursor();
}

function countriesInsert($title,$content,$image){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "INSERT INTO `countries`(`image`,`titre`, `contenu`) VALUES (:image,:title,:content)";
  $arrayValue = [
    ':image' =>$image,
    ':title' =>$title,
    ':content' =>$content
  ];
  $request = $dB->prepare($query);
  $request->execute($arrayValue);
  $request->closeCursor();
}

function testimonialInsert($firstname,$lastname,$job,$content,$image){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "INSERT INTO `testimonial`(`image`,`prenom`, `nom`, `metier`, `contenu`) VALUES (:image,:firstname,:lastname,:job,:content)";
  $arrayValue = [
    ':image' =>$image,
    ':firstname' =>$firstname,
    ':lastname' =>$lastname,
    ':job' =>$job,
    ':content' =>$content
  ];
  $request = $dB->prepare($query);
  $request->execute($arrayValue);
  $request->closeCursor();
}


// DELETE IN DATABASE
function featuredDelete($id){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "DELETE FROM `featured` WHERE `id_featured`=:id";
  $request = $dB->prepare($query);
  $arrayValue = [
    ':id' =>$id
  ];
  $request->execute($arrayValue);
  $request->closeCursor();
}

function servicesDelete($id){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "DELETE FROM `services` WHERE `id_services`=:id";
  $request = $dB->prepare($query);
  $arrayValue = [
    ':id' =>$id
  ];
  $request->execute($arrayValue);
  $request->closeCursor();
}

function newsDelete($id){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "DELETE FROM `news` WHERE `id_news`=:id";
  $request = $dB->prepare($query);
  $arrayValue = [
    ':id' =>$id
  ];
  $request->execute($arrayValue);
  $request->closeCursor();
}

function eventsDelete($id){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "DELETE FROM `events` WHERE `id_events`=:id";
  $request = $dB->prepare($query);
  $arrayValue = [
    ':id' =>$id
  ];
  $request->execute($arrayValue);
  $request->closeCursor();
}

function countriesDelete($id){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "DELETE FROM `countries` WHERE `id_countries`=:id";
  $request = $dB->prepare($query);
  $arrayValue = [
    ':id' =>$id
  ];
  $request->execute($arrayValue);
  $request->closeCursor();
}

function testimonialDelete($id){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "DELETE FROM `testimonial` WHERE `id_testimonial`=:id";
  $request = $dB->prepare($query);
  $arrayValue = [
    ':id' =>$id
  ];
  $request->execute($arrayValue);
  $request->closeCursor();
}

// EDIT TO UPDATE
function countriesEdit($id){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "SELECT * from `countries` WHERE `id_countries` = $id";
  $request = $dB->prepare($query);
  $request->execute();
  $updateCountries = $request->fetch();
  $request->closeCursor();
  return $updateCountries;
}

function featuredEdit($id){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "SELECT * from `featured` WHERE `id_featured` = $id";
  $request = $dB->prepare($query);
  $request->execute();
  $updateFeatured = $request->fetch();
  $request->closeCursor();
  return $updateFeatured;
}

function eventsEdit($id){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "SELECT * from `events` WHERE `id_events` = $id";
  $request = $dB->prepare($query);
  $request->execute();
  $updateEvents = $request->fetch();
  $request->closeCursor();
  return $updateEvents;
}

function newsEdit($id){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "SELECT * from `news` WHERE `id_news` = $id";
  $request = $dB->prepare($query);
  $request->execute();
  $updateNews = $request->fetch();
  $request->closeCursor();
  return $updateNews;
}

function servicesEdit($id){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "SELECT * from `services` WHERE `id_services` = $id";
  $request = $dB->prepare($query);
  $request->execute();
  $updateServices = $request->fetch();
  $request->closeCursor();
  return $updateServices;
}

function testimonialEdit($id){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "SELECT * from `testimonial` WHERE `id_testimonial` = $id";
  $request = $dB->prepare($query);
  $request->execute();
  $updateTestimonial = $request->fetch();
  $request->closeCursor();
  return $updateTestimonial;
}

// UPDATE IN DATABASE
function countriesUpdate($id,$new_title,$new_content,$new_image){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "UPDATE `countries` SET `image`= :image,`titre`= :title ,`contenu`= :content WHERE `id_countries`=:id";
  $request = $dB->prepare($query);
  $arrayValue = [
    ':id' =>$id,
    ':image' =>$new_image,
    ':title' =>$new_title,
    ':content' =>$new_content
  ];
  $request->execute($arrayValue);
  $request->closeCursor();
}

function featuredUpdate($id,$new_image){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "UPDATE `featured` SET `image`= :image WHERE `id_featured`=:id";
  $arrayValue = [
    ':id' =>$id,
    ':image' =>$new_image
  ];
  $request = $dB->prepare($query);
  $request->execute($arrayValue);
  $request->closeCursor();
}

function eventsUpdate($id,$new_date,$new_title,$new_content,$new_hours){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "UPDATE `events` SET `date`= :date,`titre`= :title ,`contenu`= :content, `horaires`= :hours WHERE `id_events`=:id";
  $arrayValue = [
    ':id' =>$id,
    ':date' =>$new_date,
    ':title' =>$new_title,
    ':content' =>$new_content,
    ':hours' =>$new_hours
  ];
  $request = $dB->prepare($query);
  $request->execute($arrayValue);
  $request->closeCursor();
}

function newsUpdate($id,$new_date,$new_title,$new_image){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "UPDATE `news` SET `image`= :image,`titre`= :title ,`date`= :date WHERE `id_news`=:id";
  $arrayValue = [
    ':id' =>$id,
    ':image' =>$new_image,
    ':title' =>$new_title,
    ':date' =>$new_date
  ];
  $request = $dB->prepare($query);
  $request->execute($arrayValue);
  $request->closeCursor();
}

function servicesUpdate($id,$new_content,$new_title,$new_icone){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "UPDATE `services` SET `icone`= :icon,`titre`= :title ,`contenu`= :content WHERE `id_services`=:id";
  $arrayValue = [
    ':id' =>$id,
    ':icon' =>$new_icone,
    ':title' =>$new_title,
    ':content' =>$new_content
  ];
  $request = $dB->prepare($query);
  $request->execute($arrayValue);
  $request->closeCursor();
}

function testimonialUpdate($id,$new_firstname,$new_lastname,$new_job,$new_content,$new_image){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";
  try{
    $dB = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(Exception $e){
    die('erreur:' . $e->getMessage());
  }
  $query = "UPDATE `testimonial` SET `image`= :image,`prenom`= :firstname,`nom`= :lastname, `metier`= :job, `contenu`= :content WHERE `id_testimonial`=:id";
  $arrayValue = [
    ':id' =>$id,
    ':image' =>$new_image,
    ':firstname' =>$new_firstname,
    ':lastname' =>$new_lastname,
    ':job' =>$new_job,
    ':content' =>$new_content
  ];
  $request = $dB->prepare($query);
  $request->execute($arrayValue);
  $request->closeCursor();
}
 ?>
