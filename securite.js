function envoyerMail() {
  Email.send({
    Host: "smtp.elasticemail.com",
    Username: "confirmation.noreply.enow@gmail.com",
    Password: "ArLtMpNnAkJk4Project",
    To: "pereira.matteo93@gmail.com",
    From: "confirmation.noreply.enow@gmail.com",
    Subject: "This is the subject",
    Body: "And this is the body",
  }).then((message) => alert(message));
  alert(Email);
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