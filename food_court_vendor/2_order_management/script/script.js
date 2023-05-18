"use strict";
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
          // console.log(output);
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

//  (DISPLAY_ORDERS)-->(ORDER MANAGEMENT) CLASS
class DISPLAY_ORDERS extends ORDER_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // DISPLAY_ORDERS LOAD DATA
  display_orders_load_data() {
    this.loadAjax(
      this.data,
      this.display_orders_true_handler,
      this.display_orders_err_handler
    );
  }

  // (DISPLAY_ORDERSs) TRUE HANDLER FUNC
  display_orders_true_handler(data) {
    // console.log(data);
    display_table(data);
    setInterval(display_orders, 10000);
  }

  // (DISPLAY_ORDERSs) ERROR HANDLER FUNC
  display_orders_err_handler() {
    console.log("error");
    document.getElementById(
      "display_orders"
    ).innerHTML = `<div class="alert alert-success" role="alert">
    <h3>No Orders As For Now</h3>
  </div>`;
    setInterval(display_orders, 10000);
  }
}

//CLASS DISPLAY_ORDERS OUTER FUNCTION
const display_orders = function () {
  let dsp_orders = new DISPLAY_ORDERS("action=display_orders");
  dsp_orders.display_orders_load_data();
};

display_orders();

//  (COMPLETE_ORDER)-->(ORDER MANAGEMENT) CLASS
class COMPLETE_ORDER extends ORDER_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // COMPLETE_ORDER LOAD DATA
  complete_order_load_data() {
    this.loadAjax(
      this.data,
      this.complete_order_true_handler,
      this.complete_order_err_handler
    );
  }
  // (COMPLETE_ORDER) TRUE HANDLER FUNC
  complete_order_true_handler(data) {
    alert(data);
    if (data === "ok") {
      alert("updated");
      display_orders();
    }
  }
  // (COMPLETE_ORDER) ERROR HANDLER FUNC
  complete_order_err_handler() {}
}

//CLASS COMPLETE_ORDER OUTER FUNCTION
const complete_order_get_data = function (data) {
  // alert(data);
  let c_o = new COMPLETE_ORDER(
    "action=complete_order" + "&complete_order_data=" + data
  );
  c_o.complete_order_load_data();
};

// -------------------------------END OF FUNCTION----------------------------------

const display_table = function (data) {
  data = JSON.parse(data);
  let output = "";
  output += `<table class="table  table-striped">
            <tr>
              <th>#</th>
              <th>Order Date</th>
              <th>Order Time</th>
              <th>Table No</th>
              <th>Food Name</th>
              <th>Quantity</th>
              <th></th>
              </tr>
            `;
  for (let i = 0; i < data.length; i++) {
    output += `
            <tr>
            <td>${i + 1}</td>
            <td>${data[i].order_date}</td>
            <td>${data[i].order_time}</td>
            <td>${data[i].order_table_id}</td>
            <td>${data[i].food_menu_name}</td>
            <td>${data[i].order_food_qty}</td>
            <td><button class="btn btn-success" onclick="complete_order_get_data(${
              data[i].order_id
            })"
            })">Mark as Complete</button></td>
            <tr>
            `;
  }
  output += `
        </table>`;
  document.getElementById("display_orders").innerHTML = output;
};
