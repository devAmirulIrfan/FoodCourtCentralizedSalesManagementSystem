"use strict";
"use strict";

// (MY PAY OUTS) MAIN CLASS
class PAY_OUTS {
  constructor(data) {
    this.data = data;
  }

  // SEND DATA JS--->PHP--->DB
  loadAjax(data, trueHandler, errHandler) {
    var request = new XMLHttpRequest();
    request.open("POST", "includes/includes.order_management.php", true);
    request.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );

    request.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        const output = this.responseText;
        try {
          console.log(output);
          trueHandler(output);
        } catch (err) {
          console.log(err.message);
          errHandler();
        }
      }
    };
    request.send(data);
  }
}

//  (DISPLAY_PAY_OUTS)-->(PAY_OUTS) CLASS
class DISPLAY_PAY_OUTS extends PAY_OUTS {
  constructor(data) {
    super(data);
  }
  // DISPLAY_PAY_OUTS LOAD DATA
  display_pay_outs_load_data() {
    this.loadAjax(
      this.data,
      this.display_pay_outs_true_handler,
      this.display_pay_outs_err_handler
    );
  }

  // (DISPLAY_PAY_OUTS) TRUE HANDLER FUNC
  display_pay_outs_true_handler(data) {
    display_table(data);
  }

  // (DISPLAY_PAY_OUTS) ERROR HANDLER FUNC
  display_pay_outs_err_handler() {
    console.log("error");
    document.getElementById(
      "display_orders"
    ).innerHTML = `<div class="alert alert-success" role="alert">
    <h3>No Orders As For Now</h3>
  </div>`;
    setInterval(display_orders, 10000);
  }
}

//CLASS DISPLAY_PAY OUTER FUNCTION
const display_pay_outs = function () {
  let dsp_pay_outs = new DISPLAY_PAY_OUTS("action=display_my_pay_outs");
  dsp_pay_outs.display_pay_outs_load_data();
};

display_pay_outs();

//  (FETCH_GET_PAY_OUT)-->(PAYMENT_VALIDATION) CLASS
class FETCH_GET_PAY_OUT extends PAY_OUTS {
  constructor(data) {
    super(data);
  }
  // FETCH_GET_PAY_OUT  LOAD DATA
  fetch_get_pay_out_load_data() {
    this.loadAjax(
      this.data,
      this.fetch_get_pay_out_true_handler,
      this.fetch_get_pay_out_err_handler
    );
  }
  // (FETCH_GET_PAY_OUT) TRUE HANDLER FUNC
  fetch_get_pay_out_true_handler(data) {
    display_modal(data);
    document.getElementById("modal").click();
  }
  // (FETCH_GET_PAY_OUT) ERROR HANDLER FUNC
  fetch_get_pay_out_err_handler() {
    let output = "";
    output += `
    <div class="alert alert-warning" role="alert">
      Cannot find student name
    </div>`;

    document.getElementById("display_modal_data").innerHTML = output;
  }
}

//CLASS FETCH_GET_PAY_OUT FUNC
const fetch_get_pay_out_get_data = function (data) {
  alert(data);
  let fetch_get_pay_out = new FETCH_GET_PAY_OUT(
    "action=fetch_get_pay_out" + "&fetch_get_pay_out_data=" + data
  );
  fetch_get_pay_out.fetch_get_pay_out_load_data();
};

// -------------------------------END OF FUNCTION----------------------------------

const display_table = function (data) {
  data = JSON.parse(data);
  let output = "";
  output += `<table class="table  table-striped">
            <tr>
              <th>#</th>
              <th>Pay Out Date</th>
              <th>Pay Out Amount RM</th>
              <th></th>
              </tr>
            `;
  for (let i = 0; i < data.length; i++) {
    output += `
            <tr>
            <td>${i + 1}</td>
            <td>${data[i].fund_release_date}</td>
            <td>${data[i].fund_release_vendor_collection_cut}</td>
            <td><button class="btn btn-success" onclick="fetch_get_pay_out_get_data(${
              data[i].fund_release_id
            })"
            })">View Detail</button></td>
            <tr>
            `;
  }
  output += `
        </table>`;
  document.getElementById("display_orders").innerHTML = output;
};

// DISPLAY THE MODAL DATA
const display_modal = function (data) {
  data = JSON.parse(data);
  let output = "";

  for (let i = 0; i < 1; i++) {
    output += `<center><h2>MALAKAT FOOD COURT</h2></center><br>`;
    output += `<center><h3>FUND RELEASE ON : ${data[i].fund_release_date}</h3></center>`;
    output += `<center><h3>( ${data[i].vendor_name} )</h3></center>`;
  }
  output += `<br><br><table class="table  table-striped">
            <tr>
              <th>#</th>
              <th>Order Date</th>
              <th>Food Menu</th>
              <th>Food Price</th>
              <th>Food Quantity</th>
              <th>Paid Price RM</th>
              </tr>
            `;
  for (let i = 0; i < data.length; i++) {
    output += `
            <tr>
            <td>${i + 1}</td>
            <td>${data[i].order_date}</td>
            <td>${data[i].food_menu_name}</td>
            <td>${data[i].order_food_price}</td>
            <td>${data[i].order_food_qty}</td>
            <td>${data[i].order_total_price}</td>
            <tr>
            `;
  }
  output += `
        </table>`;

  output += `<br><br><ul class="list-group list-group-flush">`;
  for (let i = 0; i < 1; i++) {
    output += `<li class="list-group-item"> <b>Total Vendor Collection : RM ${data[i].fund_release_vendor_collection}</b></li>`;
    output += `<li class="list-group-item"><b> 10 % Operator comission  : RM ${data[i].fund_release_operator_comision}</b></li>`;
    output += `<li class="list-group-item"><b> Total pay Out  : RM ${data[i].fund_release_vendor_collection_cut}</b></li>`;
    output += `<li class="list-group-item"><b> Fund Release Method  :  ${data[i].fund_release_method}</b></li>`;
    output += `<b> Remarks  :</b> <br> <b> ${data[i].fund_release_notes}</b>`;
  }
  output += ` </ul>`;
  document.getElementById("display_modal").innerHTML = output;
};

// GENERATING THE PDF
function generatePDF() {
  var element = document.getElementById("display_modal");
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
