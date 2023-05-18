"use strict";

// (ORDER_MANAGEMENT) MAIN CLASS
class ORDER_MANAGEMENT {
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
          errHandler(output);
        }
      }
    };
    request.send(data);
  }
}

//  (DISPLAY)-->(ORDER MANAGEMENT) CLASS
class DISPLAY extends ORDER_MANAGEMENT {
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

//  (SEARCH)-->(ORDER MANAGEMENT) CLASS
class SEARCH extends ORDER_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // SEARCH LOAD DATA
  search_load_data() {
    this.loadAjax(this.data, this.search_true_handler, this.search_err_handler);
  }
  // (SEARCH) TRUE HANDLER FUNC
  search_true_handler(data) {
    display_table(data);
  }

  // (SEARCH) ERROR HANDLER FUNC
  search_err_handler() {
    let output = "";
    output += `<div class="alert alert-warning" role="alert">
      Cannot find Food name
    </div>`;

    document.getElementById("display").innerHTML = output;
  }
}

//CLASS SEARCH OUTER FUNC
const search_get_id = function () {
  const data = document.getElementById("search").value;

  console.log(data);

  if (data.length === 0) display();
  if (data.length !== 0) {
    let sch = new SEARCH("action=search" + "&search_data=" + data);
    sch.search_load_data();
  }
};

//  (BUTTON DISPLAY)-->(ORDER MANAGEMENT) CLASS
class BUTTON_DISPLAY extends ORDER_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  //BTN DISPLAY LOAD DATA
  btn_display_load_data() {
    this.loadAjax(
      this.data,
      this.btn_display_true_handler,
      this.btn_display_err_handler
    );
  }

  // (BTN DISPLAY) TRUE HANDLER FUNC
  btn_display_true_handler(data) {
    data = JSON.parse(data);
    let output = "";
    output += `<div class="dropdown">
    <button class="btn btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
      Vendor Search
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    
    <li><a class="dropdown-item" href="#" onclick="fetch_btn_search_get_data(${0})">All</a></li>
    `;

    for (let i = 0; i < data.length; i++) {
      output += `
              <li><a class="dropdown-item" href="#" onclick="fetch_btn_search_get_data(${data[i].vendor_id})">${data[i].vendor_name}</a></li>
              `;
    }
    output += `
    </ul>
    </div>`;
    document.getElementById("btn").innerHTML = output;
  }

  // (BTN DISPLAY) ERROR HANDLER FUNC
  btn_display_err_handler() {}
}

//CLASS BTN DISPLAY OUTER FUNCTION
const btn_display = function () {
  let btn_dsp = new BUTTON_DISPLAY("action=btn_display");
  btn_dsp.btn_display_load_data();
};

btn_display();

//  (FETCH_BTN_SEARCH)-->(ORDER MANAGEMENT) CLASS
class FETCH_BUTTON_SEARCH extends ORDER_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // FETCH_BTN_SEARCH LOAD DATA
  fetch_btn_search_load_data() {
    this.loadAjax(
      this.data,
      this.fetch_btn_search_true_handler,
      this.fetch_btn_search_err_handler
    );
  }
  // (FETCH_BTN_SEARCH) TRUE HANDLER FUNC
  fetch_btn_search_true_handler(data) {
    display_table(data);
  }
  // (FETCH_BTN_SEARCH) ERROR HANDLER FUNC
  fetch_btn_search_err_handler() {
    let output = "";
    output += `<div class="alert alert-warning" role="alert">
      Cannot find Food name
    </div>`;

    document.getElementById("display").innerHTML = output;
  }
}

//CLASS FETCH_BTN_SEARCH OUTER FUNCTION
const fetch_btn_search_get_data = function (data) {
  let f_btn_sch = new FETCH_BUTTON_SEARCH(
    "action=fetch_btn_search" + "&fetch_btn_search_data=" + data
  );
  f_btn_sch.fetch_btn_search_load_data();
};

//  (FETCH_MODAL)-->(ORDER_MANAGEMENT) CLASS
class FETCH_MODAL extends ORDER_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // FETCH_MODAL LOAD DATA
  fetch_modal_load_data() {
    this.loadAjax(
      this.data,
      this.fetch_modal_true_handler,
      this.fetch_modal_err_handler
    );
  }
  // (FETCH_MODAL) TRUE HANDLER FUNC
  fetch_modal_true_handler(data) {
    data = JSON.parse(data);
    for (let i = 0; i < data.length; i++) {
      // FETCH NAME AND PRICE
      document.getElementById(
        "food_name"
      ).innerHTML = `<div class="alert alert-primary" role="alert">
      ${data[i].food_menu_name} Price : RM ${data[i].food_menu_price}
    </div>`;

      //FETCH IMAGE
      document.getElementById("food_image").innerHTML = `<img src="${atob(
        data[i].food_menu_image
      )}" class="rounded float-start img-fluid" alt="...">`;

      // SET DATA TO MODAL DISPLAY (COUNT)
      document.getElementById("count").innerHTML = parseInt(1);
      document.getElementById("order_price").innerHTML =
        data[i].food_menu_price;
      // SET DATA TO MODAL INPUT (COUNT)
      document.getElementById("order_food_id").value = data[i].food_menu_id;
      document.getElementById("order_food_vendor_id").value =
        data[i].food_menu_vendor_id;
      document.getElementById("order_food_qty").value = parseInt(1);
      document.getElementById("order_food_price").value =
        data[i].food_menu_price;
      document.getElementById("order_total_price").value =
        data[i].food_menu_price;
      show_edit_modal_btn();
    }
  }
  // (FETCH_MODAL) ERROR HANDLER FUNC
  fetch_modal_err_handler() {}
}

//CLASS FETCH_MODAL OUTER FUNCTION
const fetch_modal_get_data = function (data) {
  // alert("fetch modal data :" + data);
  let f_modal = new FETCH_MODAL(
    "action=fetch_modal" + "&fetch_modal_data=" + data
  );
  console.log(data);
  f_modal.fetch_modal_load_data();
};

const modal_calculate_price = function (data) {
  // A GET + COUNT INCR/DECR VALUE
  document.getElementById("count").innerHTML =
    parseInt(document.getElementById("count").innerHTML) + parseInt(data);

  // B SET COUNT VALUE
  const count = parseInt(document.getElementById("count").innerHTML);
  modal_calculate_price_counter(count);
  document.getElementById("order_food_qty").value = count;

  // C SET PRICE VALUE
  let ord_price =
    parseFloat(count) *
    parseFloat(document.getElementById("order_food_price").value);

  document.getElementById("order_price").innerHTML = ord_price.toFixed(2);
  document.getElementById("order_total_price").value =
    parseFloat(count) *
    parseFloat(document.getElementById("order_food_price").value);
};

// COUNTER INCR/DECR VALUE
const modal_calculate_price_counter = function (data) {
  if (data === parseInt(1)) {
    document.getElementById("decr").innerHTML = `
    <button
      class="btn btn-danger"
      onclick="modal_calculate_price(-1)"
      disabled
    >
      -
    </button>`;
  }
  if (data !== parseInt(1)) {
    document.getElementById("decr").innerHTML = `
    <button
      class="btn btn-danger"
      onclick="modal_calculate_price(-1)"
    >
      -
    </button>`;
  }
};

//  (INSERT)-->(ORDER_MANAGEMENT) CLASS
class INSERT extends ORDER_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // INSERT LOAD DATA
  insert_load_data() {
    this.loadAjax(this.data, this.insert_true_handler, this.insert_err_handler);
  }
  // (INSERT) TRUE HANDLER FUNC
  insert_true_handler(data) {
    // alert(data);
    if (data === "ok") {
      alert("Added To Order");
      document.getElementById("close").click();
      display_order();
    }
    if (data !== "ok") {
      alert("Item already in order");
      document.getElementById("close").click();
    }
  }
  // (INSERT) ERROR HANDLER FUNC
  insert_err_handler() {}
}

//CLASS INSERT OUTER FUNCTION
const insert_get_id = function (data) {
  return document.getElementById(data).value;
};

const insert_get_data = function () {
  const order_cust_id = insert_get_id("order_cust_id");
  const order_table_id = insert_get_id("order_table_id");
  const order_food_id = insert_get_id("order_food_id");
  const order_food_vendor_id = insert_get_id("order_food_vendor_id");
  const order_food_price = insert_get_id("order_food_price");
  const order_food_qty = insert_get_id("order_food_qty");
  const order_total_price = insert_get_id("order_total_price");

  insert_check_empty(
    order_cust_id,
    order_table_id,
    order_food_id,
    order_food_vendor_id,
    order_food_price,
    order_food_qty,
    order_total_price
  );
};

const insert_check_empty = function (
  order_cust_id,
  order_table_id,
  order_food_id,
  order_food_vendor_id,
  order_food_price,
  order_food_qty,
  order_total_price
) {
  if (
    order_cust_id.length === 0 ||
    order_table_id.length === 0 ||
    order_food_id.length === 0 ||
    order_food_vendor_id.length === 0 ||
    order_food_price.length === 0 ||
    order_food_qty.length === 0 ||
    order_total_price.length === 0
  ) {
    alert("input cannot be empty");
  }
  if (
    order_cust_id.length !== 0 &&
    order_table_id.length !== 0 &&
    order_food_id.length !== 0 &&
    order_food_vendor_id.length !== 0 &&
    order_food_price.length !== 0 &&
    order_food_qty.length !== 0 &&
    order_total_price.length !== 0
  ) {
    insert_assign_class(
      order_cust_id,
      order_table_id,
      order_food_id,
      order_food_vendor_id,
      order_food_price,
      order_food_qty,
      order_total_price
    );
  }
};

const insert_assign_class = function (
  order_cust_id,
  order_table_id,
  order_food_id,
  order_food_vendor_id,
  order_food_price,
  order_food_qty,
  order_total_price
) {
  let ins = new INSERT(
    "action=insert" +
      "&order_cust_id=" +
      order_cust_id +
      "&order_table_id=" +
      order_table_id +
      "&order_food_id=" +
      order_food_id +
      "&order_food_vendor_id=" +
      order_food_vendor_id +
      "&order_food_price=" +
      order_food_price +
      "&order_food_qty=" +
      order_food_qty +
      "&order_total_price=" +
      order_total_price
  );
  ins.insert_load_data();
};

//  (DISPLAY ORDER)-->(ORDER MANAGEMENT) CLASS
class DISPLAY_ORDER extends ORDER_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // DISPLAY ORDER LOAD DATA
  display_order_load_data() {
    this.loadAjax(
      this.data,
      this.display_order_true_handler,
      this.display_order_err_handler
    );
  }

  // (DISPLAY ORDER) TRUE HANDLER FUNC
  display_order_true_handler(data) {
    //CALCULATING THE FOOD ORDER TOTAL PRICE
    let o_t_p = 0;
    let order_total_price = 0;

    data = JSON.parse(data);
    let output = "";
    output += `<table class="table  table-striped">
          <tr>
          <th>#</th>
            <th>Food Name</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Tot Price</th>
            <th></th>
            </tr>
          `;
    for (let i = 0; i < data.length; i++) {
      o_t_p = o_t_p + parseFloat(data[i].order_total_price);
      order_total_price = o_t_p.toFixed(2);
      output += `

          <tr>
          <td>${i + 1}</td>
          <td>${data[i].food_menu_name}</td>
          <td>${data[i].food_menu_price}</td>
          <td>${data[i].order_food_qty}</td>
          <td>${data[i].order_total_price}</td>
          <td>
          <button id="open" class="btn btn-danger" onclick="delete_get_data(${
            data[i].order_id
          })"
          })">X</button>
          </td>
          <tr>
          `;
    }
    output += `
      </table>`;

    output += `<div class="alert alert-success" role="alert">
    <h3> Total amount to be paid RM : ${order_total_price} </h3> <button type="button" class="btn btn-success" onclick="confirm_order_get_data(${order_total_price})"> Confirm order</button>
  </div>`;

    document.getElementById("display_orders").innerHTML = output;
  }

  // (DISPLAY) ERROR HANDLER FUNC
  display_order_err_handler(data) {
    // alert(data);
    let output = `<div class="alert alert-primary" role="alert">
    Your Order Is Empty
   </div>`;

    document.getElementById("display_orders").innerHTML = output;
  }
}

//CLASS DISPLAY OUTER FUNCTION
const display_order = function () {
  let dsp = new DISPLAY_ORDER("action=display_order");
  dsp.display_order_load_data();
};

display_order();

//  (DELETE)-->(ORDER MANAGEMENT) CLASS
class DELETE extends ORDER_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // DELETE LOAD DATA
  delete_load_data() {
    this.loadAjax(this.data, this.delete_true_handler, this.delete_err_handler);
  }
  // (DELETE) TRUE HANDLER FUNC
  delete_true_handler(data) {
    if (data === "ok") {
      display_order();
    }
  }
  // (DELETE) ERROR HANDLER FUNC
  delete_err_handler() {}
}

//CLASS DELETE OUTER FUNCTION
const delete_get_data = function (data) {
  let del = new DELETE("action=delete" + "&delete_data=" + data);
  del.delete_load_data();
};

class CONFIRM_ORDER extends ORDER_MANAGEMENT {
  constructor(data) {
    super(data);
  }

  // CONFIRM ORDER LOAD DATA
  confirm_order_load_data() {
    this.loadAjax(
      this.data,
      this.confirm_order_true_handler,
      this.confirm_order_err_handler
    );
  }
  // (CONFIRM ORDER) TRUE HANDLER FUNC
  confirm_order_true_handler(data) {
    location.replace("../2_payment_management");
  }
  // (DELETE) ERROR HANDLER FUNC
  confirm_order_err_handler() {}
}

const confirm_order_get_data = function (data) {
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

  let confirm_order = new CONFIRM_ORDER(
    "action=confirm_order" +
      "&order_total_price=" +
      data +
      "&current_time=" +
      startTime()
  );
  confirm_order.confirm_order_load_data();
};

// -------------------------------END OF FUNCTION----------------------------------

const display_table = function (data) {
  data = JSON.parse(data);
  let output = "";
  output += `<table class="table  table-striped">
          <tr>
          <th>#</th>
            <th>Category Id</th>
            <th>Name</th>
            <th>Price</th>
            <th></th>
            </tr>
          `;
  for (let i = 0; i < data.length; i++) {
    output += `
          <tr>
          <td>${i + 1}</td>
          <td>${data[i].vendor_name}</td>
          <td>${data[i].food_menu_name}</td>
          <td>${data[i].food_menu_price}</td>
          <td><button id="open" data-bs-toggle="modal" data-bs-target="#modal" class="btn btn-warning" onclick="fetch_modal_get_data(${
            data[i].food_menu_id
          })"
          })">View</button></td>
          <tr>
          `;
  }
  output += `
      </table>`;
  document.getElementById("display").innerHTML = output;
};
