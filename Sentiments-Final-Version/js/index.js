document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById("formsContainer");
    
    // Fetch and load the content of register.php
    fetch("register.php")
        .then(response => response.text())
        .then(html => {
            container.innerHTML = html;
        });
    
    // Fetch and load the content of login.php
    fetch("Login.php")
        .then(response => response.text())
        .then(html => {
            container.innerHTML += html; // Append the content to the container
        });
});
function openForm(formType) {
    if (formType === 'login') {
      document.getElementById("id01").style.display = "block";
      document.getElementById("id02").style.display = "none";
    } else if (formType === 'register') {
      document.getElementById("id02").style.display = "block";
      document.getElementById("id01").style.display = "none";
    }
  }
  
  function closeForm(formType) {
    if (formType === 'login') {
      document.getElementById("id01").style.display = "none";
    } else if (formType === 'register') {
      document.getElementById("id02").style.display = "none";
    }
  }
  
  // Close the forms on page load
  document.addEventListener("DOMContentLoaded", function() {
    closeForm('login');
    closeForm('register');
  });

  
  


  