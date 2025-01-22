//form change when selecting a role
const roleSelect = document.getElementById("role");
const playerInputs = document.getElementById("playerInputs");
const judgeInputs = document.getElementById("judgeInputs");

// Add an event listener to the role select element
roleSelect.addEventListener('change', (event) => {
  // Hide all inputs
  playerInputs.style.display = 'none';
  judgeInputs.style.display = 'none';

  // Show inputs based on the selected role
  if (event.target.value === 'player') {
      playerInputs.style.display = '';
  } else if (event.target.value === 'judge') {
      judgeInputs.style.display = '';
  }
});
//form validation
let forms = document.querySelectorAll (".needs-validation");

      Array.prototype.slice.call (forms).forEach (function(form)
      {
        form.addEventListener ("submit", function(event)
        {
        if (!form.checkValidity())
          {
          event.preventDefault();
          event.stopPropagation();
          }
          form.classList.add("was-validated");
        });
      });

//calculate batdey
function calculateAge() {
  const birthday = new Date(document.getElementById("birthday").value);
  const ageInMilliseconds = Date.now() - birthday.getTime();
  const ageDate = new Date(ageInMilliseconds);
  const age = Math.abs(ageDate.getUTCFullYear() - 1970);
  document.getElementById("age").value = age;
}

//calculate weight class
document.addEventListener("DOMContentLoaded", function () {
  // Bind the input event to the weight input
  document
    .getElementById("weight")
    .addEventListener("input", updateWeightClass);
});

function updateWeightClass() {
  // Get the value of the weight input
  var weight = document.getElementById("weight").value;

  // Calculate the weight class based on the weight value
  var weightClass = "";
  if (weight < 45) {
    weightClass = "Pinweight";
  } else if (weight >= 45 && weight < 50) {
    weightClass = "Bantamweight";
  } else if (weight >= 50 && weight < 55) {
    weightClass = "Featherweight";
  } else if (weight >= 55 && weight < 60) {
    weightClass = "Extra Lightweight";
  } else if (weight >= 60 && weight < 66) {
    weightClass = "Half Lightweight";
  } else {
    weightClass = "Invalid Weight Class";
  }

  // Set the value of the weight class input
  document.getElementById("weightClass").value = weightClass;
}