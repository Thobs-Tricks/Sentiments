// cart.js

$(document).ready(function() {
    $(".add-to-cart").click(function() {
        var productId = $(this).data("product-id");
        addToCart(productId);
    });

    $(".remove-from-cart").click(function() {
        var productId = $(this).data("product-id");
        removeFromCart(productId);
    });

    function addToCart(productId) {
        $.ajax({
            url: "add_to_cart.php",
            type: "POST",
            data: { productId: productId },
            success: function(response) {
                updateCartCount();
            }
        });
    }

    function removeFromCart(productId) {
        $.ajax({
            url: "remove_cart.php",
            type: "POST",
            data: { productId: productId },
            success: function(response) {
                updateCartCount();
            }
        });
    }

    // Function to update the cart count
function updateCartCount() {
    $.ajax({
        url: 'update_cart.php',
        method: 'POST',
        data: { update_count: true }, // Add a flag to indicate an update
        success: function (response) {
            // Update the cart count in the HTML
            $('#cartCount').text(response.cartCount);
        },
        error: function () {
            console.error("Failed to update the cart count.");
        }
    });
}

// Add event listeners for updating the cart
$('.update-quantity').on('click', function () {
    // Handle updating quantity logic here
    // After successfully updating the quantity, call updateCartCount()
    updateCartCount();
});

$('.remove-item').on('click', function () {
    // Handle removing item logic here
    // After successfully removing the item, call updateCartCount()
    updateCartCount();
});
});

    

