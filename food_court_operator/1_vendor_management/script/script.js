"use strict";

// (VENDOR MANAGEMENT) MAIN CLASS
class VENDOR_MANAGEMENT {
  constructor(data) {
    this.data = data;
  }

  // SEND DATA JS--->PHP--->DB
  loadAjax(data, trueHandler, errHandler) {
    var request = new XMLHttpRequest();
    request.open("POST", "includes/includes.vendor_management.php", true);
    request.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );

    request.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        const output = this.responseText;
        try {
          // alert(output);
          console.log(output);
          trueHandler(output);
        } catch (err) {
          errHandler();
        }
      }
    };
    request.send(data);
  }
}

//  (DISPLAY)-->(VENDOR MANAGEMENT) CLASS
class DISPLAY extends VENDOR_MANAGEMENT {
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
    const output = display_table_func(data);
    document.getElementById("display").innerHTML = output;
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

//  (SEARCH)-->(VENDOR MANAGEMENT) CLASS
class SEARCH extends VENDOR_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // SEARCH LOAD DATA
  search_load_data() {
    this.loadAjax(this.data, this.search_true_handler, this.search_err_handler);
  }
  // (SEARCH) TRUE HANDLER FUNC
  search_true_handler(data) {
    const output = display_table_func(data);
    document.getElementById("display").innerHTML = output;
  }

  search_err_handler() {
    document.getElementById(
      "display"
    ).innerHTML = `<div class="alert alert-warning" role="alert">
    Cannot find food vendor name .
  </div>`;
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

//  (INSERT)-->(VENDOR MANAGEMENT) CLASS
class INSERT extends VENDOR_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // INSERT LOAD DATA
  insert_load_data() {
    this.loadAjax(this.data, this.insert_true_handler, this.insert_err_handler);
  }
  // (INSERT) TRUE HANDLER FUNC
  insert_true_handler(data) {
    if (data === "ok") {
      document.getElementById("vendor_username").value = "";
      document.getElementById("vendor_password").value = "";
      document.getElementById("vendor_name").value = "";
      document.getElementById("vendor_desc").value = "";
      document.getElementById("close").click();
      alert("New Vendor Successfully Inserted!");
      display();
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
  const vendor_username = insert_get_id("vendor_username");
  const vendor_password = insert_get_id("vendor_password");
  const vendor_name = insert_get_id("vendor_name");
  const vendor_desc = insert_get_id("vendor_desc");
  // alert(vendor_username + vendor_password + vendor_name + vendor_desc);
  insert_check_empty(
    vendor_username,
    vendor_password,
    vendor_name,
    vendor_desc
  );
};

const insert_check_empty = function (
  vendor_username,
  vendor_password,
  vendor_name,
  vendor_desc
) {
  if (
    vendor_username.length === 0 ||
    vendor_password.length === 0 ||
    vendor_name.length === 0 ||
    vendor_desc.length === 0
  ) {
    alert("input cannot be empty");
  }
  if (
    vendor_username.length !== 0 &&
    vendor_password.length !== 0 &&
    vendor_name.length !== 0 &&
    vendor_desc.length !== 0
  ) {
    insert_assign_class(
      vendor_username,
      vendor_password,
      vendor_name,
      vendor_desc
    );
  }
};

const insert_assign_class = function (
  vendor_username,
  vendor_password,
  vendor_name,
  vendor_desc
) {
  let ins = new INSERT(
    "action=insert" +
      "&vendor_username=" +
      vendor_username +
      "&vendor_password=" +
      vendor_password +
      "&vendor_name=" +
      vendor_name +
      "&vendor_desc=" +
      vendor_desc
  );
  ins.insert_load_data();
};

//  (FETCH_EDIT)-->(VENDOR MANAGEMENT) CLASS
class FETCH_EDIT extends VENDOR_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // FETCH_EDIT LOAD DATA
  fetch_edit_load_data() {
    this.loadAjax(
      this.data,
      this.fetch_edit_true_handler,
      this.fetch_edit_err_handler
    );
  }
  // (FETCH_EDIT) TRUE HANDLER FUNC
  fetch_edit_true_handler(data) {
    console.log(data);
    data = JSON.parse(data);
    for (let i = 0; i < data.length; i++) {
      document.getElementById("vendor_id").value = data[i].vendor_id;
      document.getElementById("vendor_username").value =
        data[i].vendor_username;
      document.getElementById("vendor_password").value =
        data[i].vendor_password;
      document.getElementById("vendor_name").value = data[i].vendor_name;
      document.getElementById("vendor_desc").value = data[i].vendor_description;
      document.getElementById("open").click();
      document.getElementById("title").innerHTML = "Edit Food Vendor";
      show_edit_modal_btn();
    }
  }
  // (FETCH_EDIT) ERROR HANDLER FUNC
  fetch_edit_err_handler() {}
}

//CLASS FETCH_EDIT OUTER FUNCTION
const fetch_edit_get_data = function (data) {
  let f_edit = new FETCH_EDIT("action=fetch_edit" + "&fetch_edit_data=" + data);
  f_edit.fetch_edit_load_data();
};

//  (EDIT)-->(VENDOR MANAGEMENT) CLASS
class EDIT extends VENDOR_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // EDIT LOAD DATA
  loadData() {
    this.loadAjax(this.data, this.edit_trueHandler, this.edit_errHandler);
  }
  // (EDIT) TRUE HANDLER FUNC
  edit_trueHandler(data) {
    console.log(data);
    if (data === "ok") {
      document.getElementById("vendor_username").value = "";
      document.getElementById("vendor_password").value = "";
      document.getElementById("vendor_name").value = "";
      document.getElementById("vendor_desc").value = "";
      document.getElementById("close").click();
      alert("Data Successfully Updated!");
      display();
    }
  }
  // (EDIT) ERROR HANDLER FUNC
  edit_errHandler() {}
}

//CLASS EDIT OUTER FUNCTION
const edit_get_id = function (data) {
  return document.getElementById(data).value;
};

const edit_get_data = function () {
  const vendor_id = edit_get_id("vendor_id");
  const vendor_username = edit_get_id("vendor_username");
  const vendor_password = edit_get_id("vendor_password");
  const vendor_name = edit_get_id("vendor_name");
  const vendor_desc = edit_get_id("vendor_desc");
  edit_check_empty(
    vendor_id,
    vendor_username,
    vendor_password,
    vendor_name,
    vendor_desc
  );
};

const edit_check_empty = function (
  vendor_id,
  vendor_username,
  vendor_password,
  vendor_name,
  vendor_desc
) {
  if (
    vendor_id.length === 0 ||
    vendor_username.length === 0 ||
    vendor_password.length === 0 ||
    vendor_name.length === 0 ||
    vendor_desc.length === 0
  ) {
    alert("input cannot be empty");
  }
  if (
    vendor_id.length !== 0 &&
    vendor_username.length !== 0 &&
    vendor_password.length !== 0 &&
    vendor_name.length !== 0 &&
    vendor_desc.length !== 0
  ) {
    edit_assign_class(
      vendor_id,
      vendor_username,
      vendor_password,
      vendor_name,
      vendor_desc
    );
  }
};

const edit_assign_class = function (
  vendor_id,
  vendor_username,
  vendor_password,
  vendor_name,
  vendor_desc
) {
  let edit = new EDIT(
    "action=edit" +
      "&vendor_id=" +
      vendor_id +
      "&vendor_username=" +
      vendor_username +
      "&vendor_password=" +
      vendor_password +
      "&vendor_name=" +
      vendor_name +
      "&vendor_desc=" +
      vendor_desc
  );
  edit.loadData();
};

// ----------------------------------END OF CLASSES------------------------------------------

// CLEAR MODAL DATA
const clear_modal_data = function () {
  document.getElementById("vendor_id").value = "";
  document.getElementById("vendor_username").value = "";
  document.getElementById("vendor_password").value = "";
  document.getElementById("vendor_name").value = "";
  document.getElementById("vendor_desc").value = "";
};

// SHOW CREATE MODAL BTN
const show_create_modal_btn = function () {
  document.getElementById("title").innerHTML = "Create New Food Vendor";
  var show_create = document.getElementById("btn_create");
  var hide_edit = document.getElementById("btn_edit");
  show_create.style.display = "block";
  hide_edit.style.display = "none";
};

// SHOW EDIT MODAL BTN
const show_edit_modal_btn = function () {
  var show_edit = document.getElementById("btn_edit");
  var hide_create = document.getElementById("btn_create");
  show_edit.style.display = "block";
  hide_create.style.display = "none";
};

const display_table_func = function (data) {
  data = JSON.parse(data);
  let output = "";
  output += `<table class="table  table-striped">
      <tr>
        <th>Vendor Id</th>
        <th>Username</th>
        <th>Password</th>
        <th>Vendor Name</th>
        <th>Payment Account</th>
        <th></th>
        </tr>
      `;
  for (let i = 0; i < data.length; i++) {
    output += `
      <tr>
      <td>${data[i].vendor_id}</td>
      <td>${data[i].vendor_username}</td>
      <td>${data[i].vendor_password}</td>
      <td>${data[i].vendor_name}</td>
      <td>${data[i].vendor_description}</td>
      <td><button class="btn btn-warning" onclick="fetch_edit_get_data(${data[i].vendor_id})"
      })">Edit</button></td>
      <tr>
      `;
  }
  output += `
  </table>`;

  return output;
};
