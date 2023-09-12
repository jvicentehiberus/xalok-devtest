/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "./styles/app.css";

import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.bundle.js";

import validator from "validator";

document.addEventListener("DOMContentLoaded", function () {
  document
    .querySelector('form[name="vehicle"]')
    .addEventListener("submit", function (event) {
      event.preventDefault();

      var uuidInput = document.getElementById("vehicle_Uuid");
      var brandInput = document.getElementById("vehicle_Brand");
      var modelInput = document.getElementById("vehicle_Model");
      var plateInput = document.getElementById("vehicle_Plate");
      var licenseRequiredInput = document.getElementById(
        "vehicle_LicenseRequired"
      );

      var uuidRegex = /^[0-9]+$/;
      var brandRegex = /^[a-zA-Z\s]+$/;
      var modelRegex = /^[a-zA-Z\s]+$/;
      var plateRegex = /^[a-zA-Z0-9\s]+$/;
      var licenseRequiredRegex = /^[YN]$/;

      if (!uuidRegex.test(uuidInput.value)) {
        alert("El campo Uuid debe contener solo números.");
        event.preventDefault();
        return;
      }

      if (!brandRegex.test(brandInput.value)) {
        alert("El campo Brand debe contener solo letras y espacios.");
        event.preventDefault();
        return;
      }

      if (!modelRegex.test(modelInput.value)) {
        alert("El campo Model debe contener solo letras y espacios.");
        event.preventDefault();
        return;
      }

      if (!plateRegex.test(plateInput.value)) {
        alert("El campo Plate debe contener letras, números y espacios.");
        event.preventDefault();
        return;
      }

      if (!licenseRequiredRegex.test(licenseRequiredInput.value)) {
        alert('El campo License required debe contener "Y" o "N".');
        event.preventDefault();
        return;
      }
      this.submit();
    });
});
