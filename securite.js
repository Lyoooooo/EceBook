function envoyerMail() {
  var mail = document.getElementById("mail").value;
  alert(mail);
  alert("coucou");
  Email.send({
    Host : "smtp.elasticemail.com",
    Username : "confirmation.noreply.enow@gmail.com",
    Password : "A2F1D47BEB846BFFE94469E005DF652366C3",
    To : 'leo.triffault@gmail.com',
    From : "confirmation.noreply.enow@gmail.com",
    Subject : "Yo bg",
    Body : "Ptit message depuis un bouton en despi"
  }).then(
    message => alert(message)
  );
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
