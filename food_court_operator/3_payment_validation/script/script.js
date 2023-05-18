"use strict";

// (PAYMENT_VALIDATION) MAIN CLASS
class PAYMENT_VALIDATION {
  constructor(data) {
    this.data = data;
  }

  // SEND DATA JS--->PHP--->DB
  loadAjax(data, trueHandler, errHandler) {
    var request = new XMLHttpRequest();
    request.open("POST", "includes/includes.payment_validation.php", true);
    request.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );

    request.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        const output = this.responseText;
        try {
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

//  (DISPLAY)-->(PAYMENT_VALIDATION) CLASS
class DISPLAY extends PAYMENT_VALIDATION {
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
    console.log(data);
    display_table(data);
  }

  // (DISPLAY) ERROR HANDLER FUNC
  display_err_handler() {
    display();
  }
}

//CLASS DISPLAY OUTER FUNCTION
const display = function () {
  let dsp = new DISPLAY("action=display");
  dsp.display_load_data();
};

display();

//  (UPDATE)-->(PAYMENT_VALIDATION) CLASS
class UPDATE extends PAYMENT_VALIDATION {
  constructor(data) {
    super(data);
  }
  // UPDATE QR LOAD DATA
  update_load_data() {
    this.loadAjax(this.data, this.update_true_handler, this.update_err_handler);
  }
  // (UPDATE) TRUE HANDLER FUNC
  update_true_handler(data) {
    if (data === "ok") {
      clear_modal();
      alert("data updated successfully");
      display();
    }
  }
  // (UPDATE) ERROR HANDLER FUNC
  update_err_handler() {
    let output = "";
    output += `
    <div class="alert alert-warning" role="alert">
      Cannot find student name
    </div>`;

    document.getElementById("display_modal_data").innerHTML = output;
  }
}

//CLASS UPDATE FUNC
const update_get_data = function (data) {
  const payment_id = document.getElementById("payment_id").value;
  const payment_method = document.getElementById("payment_method").value;

  function checkTime(i) {
    if (i < 10) {
      i = "0" + i;
    }
    return i;
  }

  function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    let time = h + ":" + m + ":" + s;
    return time;
  }

  console.log(payment_id + payment_method + startTime());

  let update = new UPDATE(
    "action=update" +
      "&payment_id=" +
      payment_id +
      "&payment_method=" +
      payment_method +
      "&payment_time=" +
      startTime()
  );
  update.update_load_data();
};

//  (SEARCH)-->(PAYMENT_VALIDATION) CLASS
class SEARCH extends PAYMENT_VALIDATION {
  constructor(data) {
    super(data);
  }
  // SEARCH LOAD DATA
  search_load_data() {
    this.loadAjax(this.data, this.search_true_handler, this.search_err_handler);
  }
  // (SEARCH) TRUE HANDLER FUNC
  search_true_handler(data) {
    display_modal(data);
  }
  // (SEARCH) ERROR HANDLER FUNC
  search_err_handler() {
    let output = "";
    output += `
    <div class="alert alert-warning" role="alert">
      Cannot find student name
    </div>`;

    document.getElementById("display_modal_data").innerHTML = output;
  }
}

//CLASS SEARCH OUTER FUNC
const search_get_id = function (data) {
  // alert(data);
  let sch = new SEARCH("action=search" + "&search_data=" + data);
  sch.search_load_data();
};

//  (SEARCH_TABLE)-->(PAYMENT_VALIDATION) CLASS
class SEARCH_TABLE extends PAYMENT_VALIDATION {
  constructor(data) {
    super(data);
  }
  // SEARCH_TABLE LOAD DATA
  search_table_load_data() {
    this.loadAjax(
      this.data,
      this.search_table_true_handler,
      this.search_table_err_handler
    );
  }
  // (SEARCH_TABLE) TRUE HANDLER FUNC
  search_table_true_handler(data) {
    display_table(data);
  }
  // (SEARCH_TABLE) ERROR HANDLER FUNC
  search_table_err_handler() {
    let output = "";
    output += `
    <div class="alert alert-warning" role="alert">
      Cannot find student name
    </div>`;

    document.getElementById("display_modal_data").innerHTML = output;
  }
}

//CLASS SEARCH_TABLE OUTER FUNC
const search_table_get_id = function (data) {
  let sch_table = new SEARCH_TABLE(
    "action=search_table" + "&search_table_data=" + data
  );
  sch_table.search_table_load_data();
};

// -------------------------------END OF FUNCTION----------------------------------

// DISPLAY TABLE
const display_table = function (data) {
  data = JSON.parse(data);
  let output = "";
  output += `<table class="table  table-striped">
          <tr>
            <th>#</th>
            <th>Payment ID</th>
            <th>Table No</th>
            <th>Payment Amount</th>
            <th></th>
            </tr>
          `;
  for (let i = 0; i < data.length; i++) {
    output += `
          <tr>
          <td>${i + 1}</td>
          <td>${data[i].payment_id}</td>
          <td>${data[i].payment_table_id}</td>
          <td>${data[i].payment_amount}</td>
          <td><button id="open" data-bs-toggle="modal" data-bs-target="#modal" class="btn btn-warning" onclick="search_get_id(${
            data[i].payment_id
          })"
          })">View</button></td>
          <tr>
          `;
  }
  output += `
      </table>`;
  document.getElementById("display").innerHTML = output;
};

// DISPLAY FOOD MENU TABLE
const display_modal = function (data) {
  data = JSON.parse(data);
  let output = ``;
  output += `<ul class="list-group list-group-flush">`;
  for (let i = 0; i < 1; i++) {
    //SET PAYMENT ID DATA
    document.getElementById("payment_id").value = data[i].payment_id;
    // OUTPUT IN MODAL SCREEN
    output += `<li class="list-group-item"><center><h2><b>PAYMENT ID : ${data[i].payment_id}</h2></b></center></li>`;
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
  document.getElementById("display_modal_data").innerHTML = output;

  document.getElementById("show_invoice").click();
};

//CLEAR MODAL
const clear_modal = function () {
  document.getElementById("show_invoice").click();
  document.getElementById("display_modal_data").innerHTML = "";
  document.getElementById("payment_id").value = "";
};
