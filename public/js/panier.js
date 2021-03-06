// ************************************************
// Shopping Cart API
// ************************************************
var cart = [];
var shoppingCart = (function() {
    // =============================
    // Private methods and properties
    // =============================


    // Constructor
    function Item(name, price, count) {
        this.name = name;
        this.price = price;
        this.count = count;
    }

    // Save cart
    function saveCart() {
        sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
    }

    // Load cart
    function loadCart() {
        cart = JSON.parse(sessionStorage.getItem('shoppingCart'));
    }
    if (sessionStorage.getItem("shoppingCart") != null) {
        loadCart();
    }


    // =============================
    // Public methods and properties
    // =============================
    var obj = {};

    // Add to cart
    obj.addItemToCart = function(name, price, count) {
        for(var item in cart) {
            if(cart[item].name === name) {
                cart[item].count ++;
                saveCart();
                return;
            }
        }
        var item = new Item(name, price, count);
        cart.push(item);
        saveCart();
    }
    // Set count from item
    obj.setCountForItem = function(name, count) {
        for(var i in cart) {
            if (cart[i].name === name) {
                cart[i].count = count;
                break;
            }
        }
    };
    // Remove item from cart
    obj.removeItemFromCart = function(name) {
        for(var item in cart) {
            if(cart[item].name === name) {
                cart[item].count --;
                if(cart[item].count === 0) {
                    cart.splice(item, 1);
                }
                break;
            }
        }
        saveCart();
    }

    // Remove all items from cart
    obj.removeItemFromCartAll = function(name) {
        for(var item in cart) {
            if(cart[item].name === name) {
                cart.splice(item, 1);
                break;
            }
        }
        saveCart();
    }

    // Clear cart
    obj.clearCart = function() {
        cart = [];
        saveCart();
    }

    // Count cart
    obj.totalCount = function() {
        var totalCount = 0;
        for(var item in cart) {
            totalCount += cart[item].count;
        }
        return totalCount;
    }

    // Total cart
    obj.totalCart = function() {
        var totalCart = 0;
        for(var item in cart) {
            totalCart += cart[item].price * cart[item].count;
        }
        return Number(totalCart.toFixed(2));
    }

    // List cart
    obj.listCart = function() {
        var cartCopy = [];
        for(i in cart) {
            item = cart[i];
            itemCopy = {};
            for(p in item) {
                itemCopy[p] = item[p];

            }
            itemCopy.total = Number(item.price * item.count).toFixed(2);
            cartCopy.push(itemCopy)
        }
        return cartCopy;
    }

    // cart : Array
    // Item : Object/Class
    // addItemToCart : Function
    // removeItemFromCart : Function
    // removeItemFromCartAll : Function
    // clearCart : Function
    // countCart : Function
    // totalCart : Function
    // listCart : Function
    // saveCart : Function
    // loadCart : Function
    return obj;
})();


// *****************************************
// Triggers / Events
// ***************************************** 
// Add item
$('.add-to-cart').click(function(event) {
    event.preventDefault();
    var name = $(this).data('name');
    var price = Number($(this).data('price'));
    shoppingCart.addItemToCart(name, price, 1);
    displayCart();
});

// Clear items
$('.clear-cart').click(function() {
    shoppingCart.clearCart();
    displayCart();
});


function displayCart() {
    var cartArray = shoppingCart.listCart();
    var output = "";
    output += "<thead>"
    +"<tr>"
        + "<th scope='col'>Qtés</th>"
        + "<th scope='col'>Produits</th>"
        + "<th scope='col'>Prix</th>"
        + "<th scope='col'></th>"
        + "<th scope='col'>Total</th>"
        + "<th scope='col'></th>"
    +"</tr>"
   + "</thead>"
    for(var i in cartArray) {
        output += "<tr>"
            + "<td>" + cartArray[i].count +  " x </td>"
            + "<td>" + cartArray[i].name + "</td>"
            + "<td>" + cartArray[i].price.toFixed(2) +  " € </td>"
            + "<td><div class='input-group'><button class='minus-item input-group-addon btn btn-warning' data-name=" + cartArray[i].name + ">-</button>"
            //+ "<input type='number' class='item-count form-control' data-name='" + cartArray[i].name + "' value='" + cartArray[i].count + "'>"
            + "<button class='plus-item ml-1 btn btn-success input-group-addon' data-name=" + cartArray[i].name + ">+</button></div></td>"
            + " = "
            + "<td>" + cartArray[i].total + " €</td>"
            + "<td><button class='delete-item btn btn-secondary' data-name=" + cartArray[i].name + "><i class=\"fas fa-trash-alt\"></i></button></td>"
            +  "</tr>";
    }
    $('.show-cart').html(output);
    $('.total-cart').html(shoppingCart.totalCart().toFixed(2));
    $('.total-count').html(shoppingCart.totalCount());
}

// Delete item button

$('.show-cart').on("click", ".delete-item", function(event) {
    var name = $(this).data('name');
    shoppingCart.removeItemFromCartAll(name);
    displayCart();
});


// -1
$('.show-cart').on("click", ".minus-item", function(event) {
    var name = $(this).data('name');
    shoppingCart.removeItemFromCart(name);
    displayCart();
});
// +1
$('.show-cart').on("click", ".plus-item", function(event) {
    var name = $(this).data('name');
    shoppingCart.addItemToCart(name);
    displayCart();
});

// Item count input
$('.show-cart').on("change", ".item-count", function(event) {
    var name = $(this).data('name');
    var count = Number($(this).val());
    shoppingCart.setCountForItem(name, count);
    displayCart();


    //-------------- PAYPAL ------------


});
paypal.Button.render({


    // Configure environment
    env: 'sandbox',
    client: {
        sandbox: 'AWCTbrT9vOb_4_QQ1-mP0in98lFJ-GYXbqgjTQjdac2L80MEWnNJxIsKiwG5Tg8_1W3qR345EGRz3UAQ',
        production: 'ASqv13M1H4H2dff9lfIUKyyq0By1MEUfaWuxox0yIg_ewVPY4k0k55lGIkljxdlLAT4fzvrZugRH6Km1'
    },

    // Customize button (optional)
    locale: 'fr_FR',
    style: {
        size: 'large',
        color: 'blue',
        shape: 'rect',
        label: 'pay',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
        return actions.payment.create({
            transactions: [{
                amount: {
                    total:   shoppingCart.totalCart().toFixed(2),
                    currency: 'EUR'
                }
            }]
        });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {

        return actions.payment.execute().then(function() {
            // Show a confirmation message to the buyer
           window.alert('Merci pour votre achat!');
            shoppingCart.clearCart();

            });

    }

}, '#paypal');


displayCart();