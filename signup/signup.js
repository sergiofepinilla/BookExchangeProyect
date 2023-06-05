document.getElementById('signupForm').addEventListener('submit', function(e) {
    e.preventDefault();
  
    let signupName = document.getElementById('signupName').value.trim();
    let signupNick = document.getElementById('signupNick').value.trim();
    let signupEmail = document.getElementById('signupEmail').value.trim();
    let signupPwd = document.getElementById('signupPwd').value.trim();
    let signupRepwd = document.getElementById('signupRepwd').value.trim();
  
    //Campos Vacios
    if(!signupName || !signupNick || !signupEmail || !signupPwd || !signupRepwd) {
      alert("Por favor, llena todos los campos.");
      return;
    }
  
    // Limitar Nombre
    if(signupName.split(' ').length > 3) {
      alert("El nombre puede tener un máximo de 3 palabras.");
      return;
    }
  
    // Limitar Nick
    if(signupNick.split(' ').length > 1) {
      alert("El apodo puede tener un máximo de 1 palabra.");
      return;
    }
  
    // Regex Email
    let emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    if(!emailRegex.test(signupEmail)) {
      alert("Por favor, introduce un correo válido.");
      return;
    }
  
    // Match Pwd
    if(signupPwd !== signupRepwd) {
      alert("Las contraseñas no coinciden.");
      return;
    }
  
    // Enviar Form
    this.submit();
});

// Limitar Nombre
document.getElementById('signupName').addEventListener('input', function(e) {
    let words = this.value.split(' ');
    if(words.length > 3) {
      words.length = 3;
      this.value = words.join(' ');
    }
});

// Limitar Nick
document.getElementById('signupNick').addEventListener('input', function(e) {
    this.value = this.value.split(' ')[0];
});
