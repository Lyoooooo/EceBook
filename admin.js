$("#tri").on("click", function () {
  var val = $(this).val();
  console.log(val);
  trierPosts(val);
});

function trierPosts(val) {
  $.ajax({
    type: "POST",
    url: "triAdmin.php",
    data: { idd: val },
    success: function (data) {
      $("#afficherPosts").html(data);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
      alert("Une erreur s'est produite lors de la requête AJAX.");
    },
  });
}

