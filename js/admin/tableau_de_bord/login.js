const form = document.querySelector(".login form"),
  continueBtn = form.querySelector(".button input"),
  errorText = form.querySelector(".error-txt");

form.onsubmit = (e) => {
  e.preventDefault(); //Desactive le comportement par defaut
};

continueBtn.onclick = () => {
  // Ajax ci-dessous
  let xhr = new XMLHttpRequest(); // creation de l'objet XML
  //xhr.open prend deux paramétre la methode, url , async
  xhr.open("POST", "/SGRC/php/Page_login/login.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // xhr.reponse donne la reponse de l'url passer en paramétre
        let data = xhr.response;
        console.log(data);
        if (data === "success") {
          location.href =
            "/SGRC/view/admin/tableau_de_bord/tableau_de_bord.php";
        } else {
          errorText.textContent = data;
          errorText.style.display = "block";
        }
      }
    }
  };
  // Nous devrons envoyer les données du formulaire via ajax en php
  let formData = new FormData(form); // creation de l'objet formData
  xhr.send(formData); // envoi des donnée du formuliare en php
};
