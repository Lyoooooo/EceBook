function envoyerMail() {
  var mail = document.getElementById("mail").value;
  var grade = "";
  var statut = document.querySelector('input[name="statut"]:checked').value;

  // Déterminer le grade en fonction du statut
  if (statut === "Elève") {
    grade = "1";
  } else if (statut === "Professeur") {
    grade = "2";
  }

  // Créer le lien avec les paramètres GET pour le grade et le mail
  var lien =
    "http://localhost/EceBook/modifier_grade.php?grade=" +
    grade +
    "&mail=" +
    mail;

  Email.send({
    Host: "smtp.elasticemail.com",
    Username: "confirmation.noreply.enow@gmail.com",
    Password: "A2F1D47BEB846BFFE94469E005DF652366C3",
    To: "pereira.matteo93@gmail.com",
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
