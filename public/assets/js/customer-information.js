const selectPayment = (paymentMethod) => {
    const paymentMethods = document.querySelectorAll(
        'input[name="payment_method"]'
    );
    paymentMethods.forEach((element) => {
        element.parentElement.style.backgroundColor = "#F1F2F6";
        element.parentElement.style.color = "#353535";
        element.checked = false;
        if (element.value === paymentMethod) {
            element.checked = true;
            element.parentElement.style.backgroundColor = "#FF801A";
            element.parentElement.style.color = "#FFFFFF";
        }
    });
};

document.addEventListener("DOMContentLoaded", () => {
    const paymentMethods = document.querySelectorAll(
        'input[name="payment_method"]'
    );
    paymentMethods.forEach((element) => {
        element.addEventListener("click", () => {
            selectPayment(element.value);
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const cartData = JSON.parse(localStorage.getItem("cart")) || [];
    const cartItems = document.querySelectorAll(".cart-item");
    cartItems.forEach((item) => {
        const productId = item.dataset.id;
        const cartProduct = cartData.find((cart) => cart.id === productId);

        if (!cartProduct) {
            item.remove();
        } else {
            const qtyElement = item.querySelector("#qty");
            const notesInput = item.querySelector("#notes");

            if (qtyElement) qtyElement.textContent = "x" + cartProduct.qty;
            if (notesInput) notesInput.value = cartProduct.notes || "";
        }
    });

    calculateTotal();
});

function calculateTotal() {
    const cartItems = document.querySelectorAll(".cart-item");
    let total = 0;
    cartItems.forEach((cartItem) => {
        const priceElement = cartItem.querySelector('p[id="price"]');
        const price = parseInt(
            priceElement.textContent.replace(/[^0-9]/g, ""),
            10
        );
        const qtyElement = cartItem.querySelector("#qty");
        const qty = parseInt(qtyElement.textContent.replace(/[^0-9]/g, ""), 10);
        total += price * qty;
    });
    document.getElementById(
        "totalAmount"
    ).textContent = `Rp ${total.toLocaleString("id-ID")}`;
}

// ===== Modifikasi submit form dengan validasi =====
const paymentForm = document.getElementById("Form");
const cartDataInput = document.getElementById("cart-data");

paymentForm.addEventListener("submit", (event) => {
    event.preventDefault();

    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const selectedPayment = document.querySelector(
        'input[name="payment_method"]:checked'
    );

    // Validasi cart tidak kosong
    if (cart.length === 0) {
        alert("Keranjang belanja Anda kosong!");
        return;
    }

    // Validasi metode pembayaran dipilih
    if (!selectedPayment) {
        alert("Silakan pilih metode pembayaran!");
        return;
    }

    // Validasi setiap item
    let invalidItem = false;
    cart.forEach((item) => {
        if (!item.id || !item.qty || item.qty <= 0) {
            invalidItem = true;
        }
        if (!item.notes) {
            item.notes = "";
        }
    });

    if (invalidItem) {
        alert("Terdapat item di keranjang yang tidak valid!");
        return;
    }

    // Semua valid, simpan cart ke hidden input dan submit
    cartDataInput.value = JSON.stringify(cart);
    paymentForm.submit();
    localStorage.removeItem("cart");
});
