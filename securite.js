function envoyerMail() {
  var mail = document.getElementById("mail").value;
  alert(mail);
  // Email.send({
  //   Host: "smtp.elasticemail.com",
  //   Username: "confirmation.noreply.enow@gmail.com",
  //   Password: "0518A897A5FBA4391DD7FCDE5334D54EBAB4",
  //   To: "pereira.matteo93@gmail.com",
  //   From: "confirmation.noreply.enow@gmail.com",
  //   Subject: "test",
  //   Body: "And this is the body",
  // }).then((message) => alert(message));
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
