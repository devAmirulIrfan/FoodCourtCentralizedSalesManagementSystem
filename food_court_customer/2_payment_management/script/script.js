"use strict";
class PAYMENT_MANAGEMENT {
  constructor(data) {
    this.data = data;
  }

  // SEND DATA JS--->PHP--->DB
  loadAjax(data, trueHandler, errHandler) {
    var request = new XMLHttpRequest();
    request.open("POST", "includes/includes.payment_management.php", true);
    request.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    request.setRequestHeader("Content-Type", "multipart/form-data");

    request.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        const output = this.responseText;
        try {
          trueHandler(output);
        } catch (err) {
          errHandler();
        }
      }
    };
    request.send(data);
  }
}

//  (DISPLAY_INVOICE)-->(PAYMENT_MANAGEMENT) CLASS
class DISPLAY_INVOICE extends PAYMENT_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // DISPLAY_INVOICE LOAD DATA
  display_invoice_load_data() {
    this.loadAjax(
      this.data,
      this.display_invoice_true_handler,
      this.display_invoice_err_handler
    );
  }

  // (DISPLAY_INVOICE) TRUE HANDLER FUNC
  display_invoice_true_handler(data) {
    display_table(data);
  }

  // (DISPLAY_INVOICE) ERROR HANDLER FUNC
  display_invoice_err_handler() {}
}

//CLASS DISPLAY_INVOICE OUTER FUNCTION
const display_invoice = function () {
  let dsp_invoice = new DISPLAY_INVOICE("action=display_invoice");
  dsp_invoice.display_invoice_load_data();
};

display_invoice();

// --------------------------------------------------------------------------

// DISPLAY FOOD MENU TABLE
const display_table = function (data) {
  data = JSON.parse(data);
  let output = ``;

  for (let i = 0; i < 1; i++) {
    // OF THE CUSTOMER JUST ORDERED
    if (data[i].payment_status === "") {
      output += `<ul class="list-group list-group-flush">`;
      for (let i = 0; i < 1; i++) {
        document.getElementById(
          "alert"
        ).innerHTML = `<div class="alert alert-danger" role="alert">
      Do not exit the page until the payment is completed
     </div>`;
        document.getElementById("qrcode").innerHTML = "";
        new QRCode(document.getElementById("qrcode"), data[i].payment_id);
        output += `<li class="list-group-item"><center><h2><b>INVOICE</h2></b></center></li>`;
        output += `<li class="list-group-item">Payment Date : ${data[i].payment_date}</li>`;
        output += `<li class="list-group-item">Table ID :${data[i].payment_table_id}</li>`;
      }
      for (let i = 0; i < data.length; i++) {
        output += `<li class="list-group-item">${data[i].food_menu_name} ( RM ${data[i].food_menu_price} x ${data[i].order_food_qty} )</li>`;
      }
      for (let i = 0; i < 1; i++) {
        output += `<li class="list-group-item"> Total Price : RM ${data[i].payment_amount}</li>`;
      }
      output += ` </ul>`;

      document.getElementById("display").innerHTML = output;
      setInterval(display_invoice, 10000);
    }

    // IF THE CUSTOMER HAVE MADE THE PAYMENT
    if (data[i].payment_status === "PAID") {
      output += `<ul class="list-group list-group-flush">`;
      for (let i = 0; i < 1; i++) {
        document.getElementById(
          "alert"
        ).innerHTML = `<div class="alert alert-success" role="alert">
      Thank You For Your Payment
     </div>`;
        document.getElementById("qrcode").innerHTML = "";
        new QRCode(document.getElementById("qrcode"), data[i].payment_id);
        output += `<li class="list-group-item"><center><h2><b>RECEIPT</h2></b></center></li>`;
        output += `<li class="list-group-item">Payment ID : ${data[i].payment_id}</li>`;
        output += `<li class="list-group-item">Payment Date : ${data[i].payment_date}</li>`;
        output += `<li class="list-group-item">Table ID :${data[i].payment_table_id}</li>`;
      }
      for (let i = 0; i < data.length; i++) {
        output += `<li class="list-group-item">${data[i].food_menu_name} ( RM ${data[i].food_menu_price} x ${data[i].order_food_qty} )</li>`;
      }
      for (let i = 0; i < 1; i++) {
        output += `<li class="list-group-item"> Total Price : RM ${data[i].payment_amount}</li>`;
      }
      output += ` </ul>`;

      document.getElementById("display").innerHTML = output;

      //GENERATE THE PDF
      generatePDF();

      // REDIRECT TO ANOTHER LOCATION
      const timeOut = setTimeout(replaceLocation, 10000);
    }
  }
};
// GENERATING THE PDF
function generatePDF() {
  var element = document.getElementById("card");
  var opt = {
    margin: 1,
    filename: `${"RECEIPT"}.pdf`,
    image: { type: "jpeg", quality: 0.98 },
    html2canvas: { scale: 2 },
    jsPDF: { unit: "in", format: "letter", orientation: "portrait" },
  };

  // New Promise-based usage:
  html2pdf().set(opt).from(element).save();
}

// REPLACE THE LOCATION AFTER RECEIPT IS DOWNLOADED
const replaceLocation = function () {
  window, location.replace("../../");
};
