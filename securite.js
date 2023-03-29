function envoyerMail() {
  var mail = document.getElementById("mail").value;
  var grade = "";
  var statut = document.querySelector('input[name="statut"]:checked').value;

  if (statut === "Elève") {
    grade = "1";
  } else if (statut === "Professeur") {
    grade = "2";
  }
  var lien =
    "http://localhost/EceBook/modifier_grade.php?grade=" +
    grade +
    "&mail=" +
    mail;

  Email.send({
    Host: "smtp.elasticemail.com",
    Username: "confirmation.noreply.enow@gmail.com",
    Password: "A2F1D47BEB846BFFE94469E005DF652366C3",
    To: mail,
    From: "confirmation.noreply.enow@gmail.com",
    Subject: "Lien de confirmation d'inscription",
    Body:
      "Cliqué sur le lien suivant pour validé votre inscription et être redirigé vers notre page connexion \n " +
      lien,
  }).then((message) => alert(message));
}

function convertToLowercase() {
  var emailField = document.getElementById("mail");
  emailField.value = emailField.value.toLowerCase();
}

function encode($mdp, $mail) {
  $salt = "@|-°+==00001ddQ"; //sorte de clé de hashage
  $crypt = md5($mdp.$salt.$mail); // ici pour hashé on concataine le mdp, le salt precedent et le mail afin de crée un mot de passe totalement introuvableme meme en connaissance le mail et le mdp de la personne
  return $crypt;
}

function mailAmi() {
  var idu = document.getElementById("idu").value;
  var ida = document.getElementById("ida").value;
  var mailu = document.getElementById("mailu").value;
  var nom = document.getElementById("nom").value;
  var prenom = document.getElementById("prenom").value;
  // alert( mailu + " " + nom + " " + prenom);
  //   var lien =
  //     "http://localhost/EceBook/valider_ami.php?idu=" + idu + "&ida=" + ida;

  Email.send({
    Host: "smtp.elasticemail.com",
    Username: "confirmation.noreply.enow@gmail.com",
    Password: "AF1D47BEB846BFFE94469E005DF652366C3",
    To: mailu,
    From: "confirmation.noreply.enow@gmail.com",
    Subject: prenom + " " + nom + " souhaite devenir votre ami!",
    Body:
      "Cliqué sur le lien suivant pour validé votre demande d'ami et être redirigé vers notre page d'acceuil \nhttp://localhost/EceBook/valider_ami.php?idu=" +
      idu +
      "&ida=" +
      ida,
  }).then((message) => alert(message));
}
