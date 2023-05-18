"use strict";

// GET ID VAL
const get_id = (id_val) => {
  return document.getElementById(id_val).value;
};

//CHECK (FC_VENDOR/FC_OPERATOR) EMPTY INPUT Y/N ?
const check_empty = function (user, username, password) {
  if (user.length === 0 || username.length === 0 || password.length === 0) {
    alert("input cannot be empty");
  } else if (user.length != 0 || username.length != 0 || password.length != 0) {
    assign_class(user, username, password);
  }
};

//  ASSIGN (USER) (FC_VENDOR/FC_OPERATOR/FC_CUST)
const assign_class = function (user, username, password) {
  if (user === "vendor") {
    let vendor = new VENDOR(
      user,
      "role=" + user + "&username=" + username + "&password=" + password
    );
    vendor.vendor_load_data();
  }
  if (user === "operator") {
    let operator = new OPERATOR(
      user,
      "role=" + user + "&username=" + username + "&password=" + password
    );

    operator.operator_load_data();
  }
};

// GET USERS (FC_VENDOR/FC_OPERATOR/FC_CUST)
const get_users = function (val) {
  if (val === 1) {
    // FOR (FC_VENDOR/FC_OPERATOR)
    const user = get_id("select");
    const username = get_id("username");
    const password = get_id("password");

    // CHECK (FC_VENDOR/FC_OPERATOR) EMPTY ?
    check_empty(user, username, password);
  }

  if (val === 2) {
    // FOR (FC_CUST)
    const user = "customer";
    const tableNumber = get_id("selectTable");

    let customer = new CUSTOMER(
      user,
      "role=" + user + "&tableNumber=" + tableNumber
    );
    customer.customer_load_data();
  }
};

// (USERS) MAIN CLASS
class USERS {
  constructor(user, data) {
    this.user = user;
    this.data = data;
  }

  // SEND DATA JS--->PHP--->DB
  loadAjax(data, trueHandler, errHandler) {
    var request = new XMLHttpRequest();
    request.open("POST", "main/includes/includes.userLogin.php", true);
    request.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );

    request.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        const output = this.responseText;
        try {
          console.log(output);
          if (output === "1") trueHandler();
          else errHandler();
        } catch (err) {
          console.log(err.message);
        }
      }
    };
    request.send(data);
  }
}

// (USERS)-->(CUSTOMER) CLASS
class CUSTOMER extends USERS {
  constructor(user, data) {
    super(user, data);
  }

  // FC_CUST LOAD DATA
  customer_load_data() {
    this.loadAjax(
      this.data,
      this.customer_true_handler,
      this.customer_err_handler
    );
  }

  // (FC_CUST) TRUE HANDLER FUNC
  customer_true_handler() {
    window.location.replace("food_court_customer/1_order_management");
  }

  // (FC_CUST) ERROR HANDLER FUNC
  customer_err_handler() {
    alert("Wrong username or password");
  }
}

//  (USERS)-->(VENDOR) CLASS
class VENDOR extends USERS {
  constructor(user, data) {
    super(user, data);
  }

  // (FC_VENDOR) LOAD DATA
  vendor_load_data() {
    this.loadAjax(this.data, this.vendor_true_handler, this.vendor_err_handler);
  }

  // (FC_VENDOR) TRUE HANDLER FUNC
  vendor_true_handler() {
    location.replace("food_court_vendor");
  }
  // (FC_VENDOR) ERROR HANDLER FUNC
  vendor_err_handler() {
    alert("Wrong username or password");
  }
}

//  (USERS)-->(FC_OPERATOR) CLASS
class OPERATOR extends USERS {
  constructor(user, data) {
    super(user, data);
  }

  // FC_OPERATOR LOAD DATA
  operator_load_data() {
    alert(this.user + this.data);
    this.loadAjax(
      this.data,
      this.operator_true_handler,
      this.operator_err_handler
    );
  }

  // (FC_OPERATOR) TRUE HANDLER FUNC
  operator_true_handler() {
    location.replace("food_court_operator");
  }

  // (FC_OPERATOR) ERROR HANDLER FUNC
  operator_err_handler() {
    alert("Wrong password");
  }
}
