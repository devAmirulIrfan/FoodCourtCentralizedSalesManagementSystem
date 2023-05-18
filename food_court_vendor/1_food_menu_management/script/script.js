"use strict";

// (FOOD MENU MANAGEMENT) MAIN CLASS
class FOOD_MENU_MANAGEMENT {
  constructor(data) {
    this.data = data;
  }

  // SEND DATA JS--->PHP--->DB
  loadAjax(data, trueHandler, errHandler) {
    var request = new XMLHttpRequest();
    request.open("POST", "includes/includes.food_menu_management.php", true);
    request.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    request.setRequestHeader("Content-Type", "multipart/form-data");

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

//  (DISPLAY)-->(FOOD MENU MANAGEMENT) CLASS
class DISPLAY extends FOOD_MENU_MANAGEMENT {
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

//  (search)-->(FOOD MENU MANAGEMENT) CLASS
class SEARCH extends FOOD_MENU_MANAGEMENT {
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
    Cannot find vendor name
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

//  (INSERT)-->(FOOD MENU MANAGEMENT) CLASS
class INSERT extends FOOD_MENU_MANAGEMENT {
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
      document.getElementById("food_menu_name").value = "";
      document.getElementById("food_menu_price").value = "";
      document.getElementById("select_food_menu_status").value = "active";
      document.getElementById("food_menu_image").value = "";
      document.getElementById("food_menu_image_name").value = "";
      document.getElementById("image_view").innerHTML = "";
      document.getElementById("base_64").value = "";
      document.getElementById("close").click();
      alert("New Food Menu Successfully Inserted!");
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
  const food_menu_name = insert_get_id("food_menu_name");
  const food_menu_image_name = insert_get_id("food_menu_image_name");
  const food_menu_price = insert_get_id("food_menu_price");
  const select_food_menu_status = insert_get_id("select_food_menu_status");

  insert_check_empty(
    food_menu_name,
    food_menu_image_name,
    food_menu_price,
    select_food_menu_status
  );
};
function insert_is_file_image(file) {
  const image_type = ["JPG", "JPEG", "PNG"];

  for (let i = 0; i < image_type.length; i++) {
    if (file.split(".").pop().toUpperCase() === image_type[i]) return true;
    if (file.split(".").pop().toUpperCase() !== image_type[i]) return false;
  }
}

const insert_check_empty = function (
  food_menu_name,
  food_menu_image_name,
  food_menu_price,
  select_food_menu_status
) {
  if (
    food_menu_name.length === 0 ||
    food_menu_image_name.length === 0 ||
    food_menu_price.length === 0 ||
    select_food_menu_status.length === 0
  ) {
    alert("input cannot be empty");
  }

  if (insert_is_file_image(food_menu_image_name) === false) {
    alert("please insert proper file image");
    alert(insert_is_file_image(food_menu_image_name));
  }

  if (
    food_menu_name.length !== 0 &&
    food_menu_image_name.length !== 0 &&
    insert_is_file_image(food_menu_image_name) === true &&
    food_menu_price.length !== 0 &&
    select_food_menu_status.length !== 0
  ) {
    insert_assign_class(
      food_menu_name,
      food_menu_image_name,
      food_menu_price,
      select_food_menu_status
    );
  }
};

const insert_assign_class = function (
  food_menu_name,
  food_menu_image_name,
  food_menu_price,
  select_food_menu_status
) {
  const food_menu_image = btoa(document.getElementById("base_64").value);
  console.log(food_menu_image);

  let ins = new INSERT(
    "action=insert" +
      "&food_menu_name=" +
      food_menu_name +
      "&food_menu_image_name=" +
      food_menu_image_name +
      "&food_menu_image=" +
      food_menu_image +
      "&food_menu_price=" +
      food_menu_price +
      "&select_food_menu_status=" +
      select_food_menu_status
  );
  ins.insert_load_data();
};

//  (FETCH_EDIT)-->(VENDOR MANAGEMENT) CLASS
class FETCH_EDIT extends FOOD_MENU_MANAGEMENT {
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
      document.getElementById("food_menu_id").value = data[i].food_menu_id;
      document.getElementById("food_menu_name").value = data[i].food_menu_name;
      document.getElementById("food_menu_price").value =
        data[i].food_menu_price;

      document.getElementById("food_menu_image_name").value =
        data[i].food_menu_image_name;

      document.getElementById("image_view").innerHTML = `<img src="${atob(
        data[i].food_menu_image
      )}" class="rounded float-start img-fluid" alt="...">`;

      document.getElementById("base_64").value = atob(data[i].food_menu_image);
      document.getElementById("select_food_menu_status").value =
        data[i].food_menu_status;
      document.getElementById("open").click();
      document.getElementById("title").innerHTML = "Edit Food Menu";
      show_edit_modal_btn();
    }
  }
  // (FETCH_EDIT) ERROR HANDLER FUNC
  fetch_edit_err_handler() {}
}

//CLASS FETCH_EDIT OUTER FUNCTION
const fetch_edit_get_data = function (data) {
  let f_edit = new FETCH_EDIT("action=fetch_edit" + "&fetch_edit_data=" + data);
  // alert(data);
  f_edit.fetch_edit_load_data();
};

//  (EDIT)-->(VENDOR MANAGEMENT) CLASS
class EDIT extends FOOD_MENU_MANAGEMENT {
  constructor(data) {
    super(data);
  }
  // EDIT LOAD DATA
  loadData() {
    this.loadAjax(this.data, this.edit_trueHandler, this.edit_errHandler);
  }

  // (EDIT) TRUE HANDLER FUNC
  edit_trueHandler(data) {
    // alert(data);
    if (data === "ok") {
      clear_modal_data();
      document.getElementById("close").click();
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
  const food_menu_id = edit_get_id("food_menu_id");
  const food_menu_name = edit_get_id("food_menu_name");
  const food_menu_image_name = edit_get_id("food_menu_image_name");
  const food_menu_price = edit_get_id("food_menu_price");
  const select_food_menu_status = edit_get_id("select_food_menu_status");

  edit_check_empty(
    food_menu_id,
    food_menu_name,
    food_menu_image_name,
    food_menu_price,
    select_food_menu_status
  );
};
function edit_is_file_image(file) {
  const image_type = ["JPG", "JPEG", "PNG"];

  for (let i = 0; i < image_type.length; i++) {
    if (file.split(".").pop().toUpperCase() === image_type[i]) return true;
    if (file.split(".").pop().toUpperCase() !== image_type[i]) return false;
  }
}

const edit_check_empty = function (
  food_menu_id,
  food_menu_name,
  food_menu_image_name,
  food_menu_price,
  select_food_menu_status
) {
  if (
    food_menu_id.length === 0 ||
    food_menu_name.length === 0 ||
    food_menu_image_name.length === 0 ||
    food_menu_price.length === 0 ||
    select_food_menu_status.length === 0
  ) {
    alert("input cannot be empty");
  }

  if (insert_is_file_image(food_menu_image_name) === false) {
    alert("please insert proper file image");
    alert(insert_is_file_image(food_menu_image_name));
  }

  if (
    food_menu_id.length !== 0 &&
    food_menu_name.length !== 0 &&
    food_menu_image_name.length !== 0 &&
    insert_is_file_image(food_menu_image_name) === true &&
    food_menu_price.length !== 0 &&
    select_food_menu_status.length !== 0
  ) {
    edit_assign_class(
      food_menu_id,
      food_menu_name,
      food_menu_image_name,
      food_menu_price,
      select_food_menu_status
    );
  }
};

const edit_assign_class = function (
  food_menu_id,
  food_menu_name,
  food_menu_image_name,
  food_menu_price,
  select_food_menu_status
) {
  const food_menu_image = btoa(document.getElementById("base_64").value);
  console.log(food_menu_image);

  let edit = new EDIT(
    "action=edit" +
      "&food_menu_id=" +
      food_menu_id +
      "&food_menu_name=" +
      food_menu_name +
      "&food_menu_image_name=" +
      food_menu_image_name +
      "&food_menu_image=" +
      food_menu_image +
      "&food_menu_price=" +
      food_menu_price +
      "&select_food_menu_status=" +
      select_food_menu_status
  );
  edit.loadData();
};

// ----------------------------------END OF CLASSES------------------------------------------

// DISPLAY FOOD MENU TABLE
const display_table = function (data) {
  data = JSON.parse(data);
  let output = "";
  output += `<table class="table  table-striped">
    <tr>
      <th>Id</th>
      <th>Category Id</th>
      <th>Name</th>
      <th>Price</th>
      <th>Status</th>
      <th></th>
      </tr>
    `;
  for (let i = 0; i < data.length; i++) {
    output += `
    <tr>
    <td>${data[i].food_menu_id}</td>
    <td>${data[i].food_menu_vendor_id}</td>
    <td>${data[i].food_menu_name}</td>
    <td>${data[i].food_menu_price}</td>
    <td>${data[i].food_menu_status}</td>
    <td><button class="btn btn-warning" onclick="fetch_edit_get_data(${data[i].food_menu_id})"
    })">Edit</button></td>
    <tr>
    `;
  }
  output += `
</table>`;
  document.getElementById("display").innerHTML = output;
};
// CLEAR MODAL DATA
const clear_modal_data = function () {
  document.getElementById("food_menu_id").value = "";
  document.getElementById("food_menu_name").value = "";
  document.getElementById("food_menu_price").value = "";
  document.getElementById("select_food_menu_status").value = "active";
  document.getElementById("food_menu_image").value = "";
  document.getElementById("food_menu_image_name").value = "";
  document.getElementById("image_view").innerHTML = "";
  document.getElementById("base_64").value = "";
};

// SHOW CREATE MODAL BTN
const show_create_modal_btn = function () {
  document.getElementById("title").innerHTML = "Create Food Menu";
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

// --------------------------------END OF FUNCTION -----------------------------------------

const change_to_base_64 = function () {
  const file = document.getElementById("food_menu_image").files[0];

  document.getElementById("food_menu_image_name").value =
    document.getElementById("food_menu_image").value;
  const reader = new FileReader();
  reader.readAsDataURL(file);

  // TURN IMAGE VALUE TO BASE 64
  reader.addEventListener("load", function () {
    document.getElementById("base_64").value = reader.result;

    // DISPLAY IN BASE 64 FORMAT
    document.getElementById("image_view").innerHTML = `<img src="${
      document.getElementById("base_64").value
    }" class="rounded float-start img-fluid" alt="...">`;
  });
};
