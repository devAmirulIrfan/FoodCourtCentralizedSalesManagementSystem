"use strict";

// (PAYMENT_RELEASE) MAIN CLASS
class PAYMENT_RELEASE {
  constructor(data) {
    this.data = data;
  }

  // SEND DATA JS--->PHP--->DB
  loadAjax(data, trueHandler, errHandler) {
    var request = new XMLHttpRequest();
    request.open("POST", "includes/includes.payment_release.php", true);
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
          errHandler(output);
        }
      }
    };
    request.send(data);
  }
}

//  (DISPLAY)-->(PAYMENT_RELEASE) CLASS
class DISPLAY extends PAYMENT_RELEASE {
  constructor(data) {
    super(data);
  }
  // DISPLAY LOAD DATA
  display_load_data() {
    this.loadAjax(
      this.data,
      this.display_true_handler,
      this.display_err_handler
    );
  }

  // (DISPLAY) TRUE HANDLER FUNC
  display_true_handler(data) {
    display_table(data);
    // console.log(data);
  }

  // (DISPLAY) ERROR HANDLER FUNC
  display_err_handler() {
    document.getElementById(
      "display"
    ).innerHTML = `<div class="alert alert-success" role="alert">
    <h3>No Payment to be released As For Now</h3>
  </div>`;
  }
}

//CLASS DISPLAY OUTER FUNCTION
const display = function () {
  let dsp = new DISPLAY("action=display");
  dsp.display_load_data();
};

display();

//  (GET_FUND_MODAL)-->(PAYMENT_RELEASE) CLASS
class GET_FUND_MODAL extends PAYMENT_RELEASE {
  constructor(data) {
    super(data);
  }
  // GET_FUND_MODAL LOAD DATA
  get_fund_modal_load_data() {
    this.loadAjax(
      this.data,
      this.get_fund_modal_true_handler,
      this.get_fund_modal_err_handler
    );
  }
  // (GET_FUND_MODAL) TRUE HANDLER FUNC
  get_fund_modal_true_handler(data) {
    set_modal_data(data);
    document.getElementById("modal").click();
  }
  // (GET_FUND_MODAL) ERROR HANDLER FUNC
  get_fund_modal_err_handler() {}
}

//CLASS GET_FUND_MODAL OUTER FUNCTION
const get_fund_modal_get_data = function (data) {
  let get_fund_modal = new GET_FUND_MODAL(
    "action=get_fund_modal" + "&get_fund_modal_data=" + data
  );
  get_fund_modal.get_fund_modal_load_data();
};

//  (RELEASE_FUND)-->(PAYMENT_RELEASE) CLASS
class RELEASE_FUND extends PAYMENT_RELEASE {
  constructor(data) {
    super(data);
  }
  // RELEASE_FUND LOAD DATA
  release_fund_load_data() {
    this.loadAjax(
      this.data,
      this.release_fund_true_handler,
      this.release_fund_err_handler
    );
  }
  // (RELEASE_FUND) TRUE HANDLER FUNC
  release_fund_true_handler(data) {
    if (data === "ok") {
      alert("fund received");
      document.getElementById("modal").click();
      document.getElementById("fund_release_notes").value = "";
      display();
    }
    // display();
  }
  // (RELEASE_FUND) ERROR HANDLER FUNC
  release_fund_err_handler() {}
}

//CLASS RELEASE_FUND OUTER FUNCTION
const release_fund_get_data = function () {
  const fund_release_vendor_id = document.getElementById(
    "fund_release_vendor_id"
  ).value;
  const fund_release_method = document.getElementById(
    "fund_release_method"
  ).value;
  const fund_release_vendor_collection = document.getElementById(
    "fund_release_vendor_collection"
  ).value;
  const fund_release_vendor_collection_cut = document.getElementById(
    "fund_release_vendor_collection_cut"
  ).value;
  const fund_release_operator_comision = document.getElementById(
    "fund_release_operator_comision"
  ).value;
  const fund_release_notes =
    document.getElementById("fund_release_notes").value;

  if (
    confirm(
      "Confirm release fund with " + fund_release_method + " payment method ?"
    )
  ) {
    let rel = new RELEASE_FUND(
      "action=release_fund" +
        "&fund_release_vendor_id=" +
        fund_release_vendor_id +
        "&fund_release_vendor_collection=" +
        fund_release_vendor_collection +
        "&fund_release_vendor_collection_cut=" +
        fund_release_vendor_collection_cut +
        "&fund_release_operator_comision=" +
        fund_release_operator_comision +
        "&fund_release_method=" +
        fund_release_method +
        "&fund_release_notes=" +
        fund_release_notes
    );
    rel.release_fund_load_data();
  }
};

// -------------------------------END OF FUNCTION----------------------------------

const display_table = function (data) {
  data = JSON.parse(data);
  let output = "";
  output += `<table class="table  table-striped">
            <tr>
              <th>#</th>
              <th>Vendor</th>
              <th>Total Collection</th>
              <th>Fund To Be Released</th>
              <th>Operator Comission</th>
              <th></th>
              </tr>
            `;
  for (let i = 0; i < data.length; i++) {
    output += `
            <tr>
            <td>${i + 1}</td>
            <td>${data[i].vendor_name}</td>
            <td>RM${data[i].total_collection}</td>
            <td>RM${data[i].total_collection_cut}</td>
            <td>RM${data[i].operator_commision}</td>
            <td><button class="btn btn-success" onclick="get_fund_modal_get_data(
            ${data[i].vendor_id})"
            })">View</button>
            </td>
            <tr>
            `;
  }
  output += `
        </table>`;
  document.getElementById("display").innerHTML = output;
};

//SET MODAL DATA
const set_modal_data = function (data) {
  let output = ``;
  output += `<ul class="list-group list-group-flush">`;

  data = JSON.parse(data);
  for (let i = 0; i < data.length; i++) {
    document.getElementById("title").innerHTML = data[i].vendor_name;
    document.getElementById("fund_release_vendor_id").value =
      data[i].order_food_vendor_id;
    document.getElementById("fund_release_vendor_collection").value =
      data[i].total_collection;
    document.getElementById("fund_release_vendor_collection_cut").value =
      data[i].total_collection_cut;
    document.getElementById("fund_release_operator_comision").value =
      data[i].operator_commision;

    // SET THE DATA IN THE MODAL
    output += `<li class="list-group-item"><center><b>VENDOR COLLECTION : RM${data[i].total_collection}</b></center></li>`;
    output += `<li class="list-group-item"><center><b>OPERATOR 10% COMISSION : RM${data[i].operator_commision}</b></center></li>`;
    output += `<li class="list-group-item"><center><h4><b> <mark>FUND TO BE RELEASED :  RM${data[i].total_collection_cut} </mark></h4></b></center></li>`;
  }
  output += ` </ul>`;

  document.getElementById("modal_display").innerHTML = output;
};
