const token = $('meta[name="csrf-token"]').attr('content');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': token
    }
})

$(document).ready(function (){
    $("#loginBtn").click(login);
    $("#form-submit").click(contact);
    $(".page-link").click(loadMoreProducts);
    $("#filterBtn").click(sortAndFilter);
    $("#registerBtn").click(register);
    $("#rating").change(rate);
    $(".addToCart").click(addToCart);
    $("#datum").change(filterDate);

    if(window.location.href == baseUrl+"/cart"){
        showProductsCart();
        showBoughtCart();
    }



})

var types = [];
var colors = [];
var brands = [];


function loadMoreProducts(e){
    e.preventDefault();
    types = [];
    $.each($("input[name='types']:checked"), function(){
        types.push($(this).val());
    });

    colors = [];
    $.each($("input[name='colors']:checked"), function(){
        colors.push($(this).val());
    });

    brands = [];
    $.each($("input[name='brands']:checked"), function(){
        brands.push($(this).val());
    });

    let sortValue = $('#sort').val();
    let search = $('#search').val();
    let page = $(this).data("page");
    getProducts(page, types, colors, brands, sortValue, search);
}

function sortAndFilter() {
    types = [];
    $.each($("input[name='types']:checked"), function(){
        types.push($(this).val());
    });

    colors = [];
    $.each($("input[name='colors']:checked"), function(){
        colors.push($(this).val());
    });

    brands = [];
    $.each($("input[name='brands']:checked"), function(){
        brands.push($(this).val());
    });

    let sortValue = $('#sort').val();
    let search = $('#search').val();
    getProducts(1, types, colors, brands, sortValue, search);
}

function getProducts(page, types, colors, brands, sortValue, search){
    const caller = arguments.callee.caller.name;

    $.ajax({
        url: baseUrl + "/products/filter",
        method: "get",
        data: {
            page : page,
            sortValue : sortValue,
            search : search,
            types : types,
            colors : colors,
            brands : brands
        },
        dataType: "json",
        success: function (response) {
            if(response.data.length > 0){
                showProducts(response.data);
                if(caller == 'sortAndFilter'){
                    changePagination(response.last_page, response.current_page);
                }
                if(caller == 'loadMoreProducts'){
                    changeActivePageLink(response.current_page);
                }
                $(".pagination").show();
            }
            else {
                $("#products").html("<div class='row mb-5'><div class='col-lg-12 d-flex justify-content-center'><h2>No products in this category!</h2></div></div>");
                $(".pagination").hide();
            }

        },
        error: function (xhr, status, err) {
            console.log(xhr.status)
        }
    })
}

function changePagination(totalLinks, currentPage){
    let html = "";
    for(let i = 1; i <= totalLinks; i++){
        if(i != currentPage){
            html += `<li class="page-item"><a class="page-link" id="link${i}" data-page="${i}" href="#">${i}</a></li>`;
        }else{
            html += `<li class="page-item active"><a class="page-link" id = "link${i}" data-page="${i}" href="#">${i}</a></li>`;
        }
    }
    $(".pagination").html(html);
    $(".page-link").click(loadMoreProducts);
}

function changeActivePageLink(currentPage){
    $('.page-item').removeClass('active');
    $('#link' + currentPage).parent().addClass('active');
}

function login() {
    var email, password, reEmail;
    var validate = true;

    email = document.getElementById('emailLogin').value;
    password = document.getElementById('passLogin').value;
    reEmail = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;


    if (email == "") {
        document.getElementById("emailLoginError").innerHTML = "Email is required!";
        validate = false;
    } else if (!reEmail.test(email)) {
        document.getElementById("emailLoginError").innerHTML = "Email is invalid!";
        validate = false;
    } else {
        document.getElementById("emailLoginError").innerHTML = "";
    }

    if (password == "") {
        document.getElementById("passLoginError").innerHTML = "Password is required!";
        validate = false;
    } else if (password.length < 8) {
        document.getElementById("passLoginError").innerHTML = "Password must have at least 8 characters!";
        validate = false;
    } else {
        document.getElementById("passLoginError").innerHTML = "";
    }

    if (validate) {
        $.ajax({
            url: baseUrl + "/login",
            method: "POST",
            data: {
                email: email,
                password: password,
                _token : token
            },
            success: function (data) {
                alert(data);
                window.location.replace(baseUrl)
            },
            error: function (xhr, status, err) {
                if(xhr.status == 400){
                    alert(xhr.responseJSON.errorMsg);
                }
            }
        })
    }
}

function contact(){
    var name, email, subject, message;
    var validate = true;
    name = $("#name").val();
    email = $("#email").val();
    subject = $("#subject").val();
    message = $("#message").val();

    if(name == ''){
        $("#nameContactError").html('Name is required');
        validate = false;
    }
    else {
        $("#nameContactError").html('');
    }

    if(email == ''){
        $("#emailContactError").html('Email is required');
        validate = false;
    }
    else {
        $("#emailContactError").html('');
    }

    if(subject == ''){
        $("#subjectError").html('Subject is required');
        validate = false;
    }
    else {
        $("#subjectError").html('');
    }

    if(message == ''){
        $("#messageContactError").html('Message is required');
        validate = false;
    }
    else {
        $("#messageContactError").html('');
    }

    if(validate) {
        $.ajax({
            url: baseUrl + "/sendEmail",
            method: "POST",
            data: {
                name : name,
                email: email,
                subject: subject,
                message : message,
                _token : token
            },
            success: function (data) {
                alert(data);
                window.location.reload();
            },
            error: function (xhr, status, err) {
                console.log(xhr.status)
            }
        })
    }
}

function showProducts(products){
    let html = '';
    html += `<div class="row">`;
    for(let product of products){
        html += `<div class="col-lg-4 col-md-4 all des">
                    <div class="product-item">
                        <a href="products/${product.id}"><img src="assets/images/${product.main_image}" alt="${product.name }"></a>
                        <div class="down-content">
                            <a href="products/${product.id}"><h4>${ product.name }</h4></a>
                            <h6>$${ product.price }</h6>`
                            if(product.grade) {
                                html += `<ul class="stars">
                                    <li>
                                        <i class="fa fa-star "></i> ${product.grade}/5
                                    </li>
                                </ul>`
                            }
                            else {
                               html += `<ul class="stars">
                                    <li><i class="fa fa-star mr-2"></i>Be first to rate!</li>
                                </ul>`
                            }
                        html += `</div>
                    </div>
                </div>`
    };

    html += `</div>`;
    $("#products").html(html);
}

function register() {
    var name, last_name, address, email, password, confirm_password, active, role_id, reEmail, reName, reLastName;
    var validate = true;

    name = document.getElementById('registerName').value;
    last_name = document.getElementById('registerLastName').value;
    address = document.getElementById('address').value;
    email = document.getElementById('emailRegister').value;
    password = document.getElementById('passRegister').value;
    confirm_password = document.getElementById('confirmPass').value;
    role_id = document.getElementById('role_id').value;
    active = 1;
    reEmail = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
    reName = /^[A-Z][a-z]{1,13}$/;
    reLastName = /^([A-Z][a-z]{1,30}\s?)+$/;


    if (name == "") {
        document.getElementById("nameRegError").innerHTML = "Name is required!";
        validate = false;
    }
    else if(!reName.test(name)){
        document.getElementById("nameRegError").innerHTML = "Name must start with a capital letter!";
        validate = false;
    }
    else {
        document.getElementById("nameRegError").innerHTML = "";
    }

    if (last_name == "") {
        document.getElementById("lastNameRegError").innerHTML = "Last name is required!";
        validate = false;
    }
    else if(!reLastName.test(last_name)){
        document.getElementById("lastNameRegError").innerHTML = "Last name must start with a capital letter!";
        validate = false;
    }
    else {
        document.getElementById("lastNameRegError").innerHTML = "";
    }

    if (address == "") {
        document.getElementById("addressRegError").innerHTML = "Address is required!";
        validate = false;
    }
    else {
        document.getElementById("addressRegError").innerHTML = "";
    }

    if (email == "") {
        document.getElementById("emailLoginError").innerHTML = "Email is required!";
        validate = false;
    } else if (!reEmail.test(email)) {
        document.getElementById("emailLoginError").innerHTML = "Email is invalid!";
        validate = false;
    } else {
        document.getElementById("emailLoginError").innerHTML = "";
    }

    if (password == "") {
        document.getElementById("passRegError").innerHTML = "Password is required!";
        validate = false;
    } else if (password.length < 8) {
        document.getElementById("passRegError").innerHTML = "Password must have at least 8 characters!";
        validate = false;
    } else {
        document.getElementById("passRegError").innerHTML = "";
    }

    if(confirm_password != password) {
        document.getElementById("confPassRegError").innerHTML = "Passwords are not the same!";
        validate = false;
    }
    else {
        document.getElementById("confPassRegError").innerHTML = "";
    }

    if (validate) {
        $.ajax({
            url: baseUrl + "/register",
            method: "POST",
            data: {
                name : name,
                last_name : last_name,
                address : address,
                email: email,
                password: confirm_password,
                active : active,
                role_id : role_id,
                _token : token
            },
            success: function (data) {
                alert(data);
                window.location.reload();
            },
            error: function (xhr, status, err) {
                if(xhr.status == 400){
                    alert(xhr.responseJSON.errorMsg);
                }
            }
        })
    }
}

function rate(){
    var rating, product_id;
    rating = $("#rating").val();
    product_id = $("#product_id").val();

    $.ajax({
        url: baseUrl + "/rate",
        method: "POST",
        data: {
            rating : rating,
            product_id : product_id,
            _token : token
        },
        success: function (data) {
            alert(data);
            window.location.reload();
        },
        error: function (xhr, status, err) {
            console.log(xhr.status);
        }
    })
}

function addToCart(){
    let id = this.dataset.id;
    let size = $("input[name='size']:checked").data('idsize');
    let quantity = $("#var-value").html();

    if(id != null && size != null && quantity != null) {
        $.ajax({
            url: baseUrl+"/cart/addToCart",
            method: "post",
            type: "json",
            data: {
                id : id,
                size : size,
                quantity : quantity
            },
            success: function(data){
                alert(data)
            },
            error: function(xhr, err, status){
                console.log(status);
            }
        })
    }
    else {
        alert("Pick a size please");
    }

}

function showCart(products){
    let html = "";

    products.forEach(element => {
        html += `<div class="row mt-5">
                       <div class="col-lg-4">
                           <div class="card">
                               <img class="card-img img-fluid" src="assets/images/${element.main_image}" alt="${element.name}">
                           </div>
                       </div>
                       <div class="col-lg-8">
                           <div class="card border-0">
                               <div class="card-body">
                                    <h3>${element.name}</h3>
                                    <ul class="list-inline mt-3">
                                        <li class="list-inline-item">
                                            <h6 class="mt-3">Brand:</h6>
                                        </li>
                                        <li class="list-inline-item">
                                            <p class="text-muted"><strong> ${element.brand} </strong></p>
                                        </li>
                                    </ul>
                                    <ul class="list-inline mt-3">
                                        <li class="list-inline-item">
                                            <h6>Size you picked:</h6>
                                        </li>
                                        <li class="list-inline-item">
                                            <p class="text-muted"><strong> ${element.size} </strong></p>
                                        </li>
                                    </ul>
                                    <p class="text-muted mt-3 mb-3">$${element.price} &nbsp; x &nbsp; ${element.quantity} &nbsp; = &nbsp; $${element.price * element.quantity}.00</p>
                                    <button type="submit" class="btn btn-lg float-right mt-5 removeCart" data-idproductsize="${element.id}" name="removeCart">Remove</button>
                                    <button type="button" class="btn btn-lg float-right mt-5 mr-2 buy" data-idcart="${element.cart_id}" data-idproductsize="${element.id}" >Buy</button>
                                </div>
                            </div>
                        </div>
                    </div>`
        })

    $("#productsCart").html(html);
    $(".removeCart").click(removeFromCart);
    $(".buy").click(buyProduct);


}

function buyProduct() {
    var id = this.dataset.idcart;
    var product_size_id = this.dataset.idproductsize;

    $.ajax({
        url: baseUrl + "/cart/buy",
        method: "post",
        data: {
            id : id,
            product_size_id : product_size_id,
            _token : token
        },
        success: function(data){
            alert("Thank you for buying our products!");
            if(data.length > 0){
                showCart(data);
                showBoughtCart();
            }
            else {
                $("#productsCart").html("<div class='d-flex align-items-center justify-content-center' id='emptyCart'><h1>Your cart is empty</h1></div>");
                showBoughtCart();
            }
        },
        error: function(xhr, err, status){
            console.log(status);
        }
    })

}

function showBought(products){
    let html = '';
    html += `<div class="row mt-5 border-top"><div class="col-lg-12 text-center mt-5"><h3>Recently bought</h3></div></div>
             <div class="row mt-5 d-flex justify-content-evenly">`

    products.forEach(element => {
        html += `<div class="col-lg-4">
                    <img class="img-fluid" alt="${element.name}" src="assets/images/${element.main_image}"/>
                    <h3 class="mt-3">${element.name}</h3>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <h6 class="mt-3">Price
                        </li>
                        <li class="list-inline-item">
                            <p class="text-muted"><strong> $${element.price} </strong></p>
                        </li>
                    </ul>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <h6 class="mt-3">Brand
                        </li>
                        <li class="list-inline-item">
                            <p class="text-muted"><strong> ${element.brand} </strong></p>
                        </li>
                    </ul>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <h6 class="mt-3">Size
                        </li>
                        <li class="list-inline-item">
                            <p class="text-muted"><strong> ${element.size} </strong></p>
                        </li>
                    </ul>
                 </div>`
    })

    html += `</div>`;
    $("#bought").html(html);
}

function showBoughtCart(){
    $.ajax({
        url: baseUrl + "/cart/showBought",
        method: "GET",
        type: "json",
        success: function(data){
            if(data.length > 0){
                showBought(data);
            }
            else {
                $("#bought").html("");
            }
        },
        error: function(xhr, err, status){
            console.log(status);
        }
    })
}

function showProductsCart(){
    $.ajax({
        url: baseUrl + "/showCart",
        method: "GET",
        type: "json",
        success: function(data){
            if(data.length > 0){
                showCart(data);
            }
            else {
                $("#productsCart").html("<div class='d-flex align-items-center justify-content-center' id='emptyCart'><h1>Your cart is empty</h1></div>");
            }
        },
        error: function(xhr, err, status){
            console.log(status);
        }
    })
}

function removeFromCart(){
    let id = this.dataset.idproductsize;

    $.ajax({
        url: baseUrl + "/cart/delete",
        method: "delete",
        type: "json",
        data: {
            id : id
        },
        success: function(data){
            alert("Successfully removed from cart.");
            if(data.length > 0){
                showCart(data);
            }
            else {
                $("#productsCart").html("<div class='d-flex align-items-center justify-content-center' id='emptyCart'><h1>Your cart is empty</h1></div>");
            }
        },
        error: function(xhr, err, status){
            console.log(status);
        }
    })

}

function showAdmin(data){
    let html = '';
    data.forEach(el => {
        html += `<tr>
                        <th scope="row">${el.user_id }</th>`
                        if(el.product_id != null) {
                           html += `<th scope="row">${el.product_id}</th>`
                        }
                        else {
                            html += `<th scope="row"><i class="fa fa-times" aria-hidden="true"></i></th>`
                        }
                        html += `<td>${el.name }</td>
                        <td>${ el.action }</td>
                        <td>${ el.date }</td>
                    </tr>`
    });

    $("#tableBody").html(html);
}

function filterDate(){
    let datum = $("#datum").val();

    $.ajax({
        url: baseUrl + "/date",
        method: "get",
        success: function(data){
            data = data.filter(el => {
                if(el.date == datum){
                    return true;
                }
            })

            showAdmin(data);
        },
        error: function(xhr, err, status){
            if(xhr.status == 400){
                console.log(xhr.responseJSON);
            }
        }
    })
}
