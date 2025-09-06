document.addEventListener("DOMContentLoaded", function () {
    const cartItems = document.querySelectorAll(".cart-item");
    let cartData = JSON.parse(localStorage.getItem("cart")) || [];

    // Load cart data ke halaman
    cartItems.forEach((item) => {
        const productId = item.dataset.id;
        const cartProduct = cartData.find((cart) => cart.id === productId);

        if (!cartProduct) {
            item.remove(); // hapus item jika tidak ada di cart
        } else {
            const qtyElement = item.querySelector("#qty");
            const notesInput = item.querySelector("#notes");

            if (qtyElement) qtyElement.textContent = "x" + cartProduct.qty;
            if (notesInput) notesInput.value = cartProduct.notes || "";
        }
    });

    calculateTotal();

    const checkoutBtn = document.querySelector('[data-checkout="true"]');

    // ===== Fungsi validasi cart =====
    function isCartValid() {
        cartData = JSON.parse(localStorage.getItem("cart")) || [];
        if (cartData.length === 0) return false;
        for (let item of cartData) {
            if (!item.id || !item.qty || item.qty <= 0) return false;
            if (!item.notes) item.notes = "";
        }
        return true;
    }

    // ===== Validasi saat DOM load =====
    if (!isCartValid()) {
        checkoutBtn.classList.add("opacity-50", "pointer-events-none");
        checkoutBtn.title = "Keranjang tidak valid!";
    }

    // ===== Validasi saat tombol diklik =====
    checkoutBtn.addEventListener("click", function (e) {
        if (!isCartValid()) {
            e.preventDefault();
            alert("Keranjang belanja Anda kosong atau ada item tidak valid!");
            return;
        }

        // Semua valid, redirect ke halaman informasi
        window.location.href = checkoutBtn.getAttribute("href");
    });
});

// ===== Hitung total cart =====
function calculateTotal() {
    const prices = document.querySelectorAll('p[id="price"]');
    let total = 0;
    prices.forEach((priceElement) => {
        const price = parseInt(
            priceElement.textContent.replace(/[^0-9]/g, ""),
            10
        );
        const qtyElement = priceElement.closest(".flex").querySelector("#qty");
        const qty = qtyElement
            ? parseInt(qtyElement.textContent.replace(/[^0-9]/g, ""), 10)
            : 1;
        total += price * qty;
    });
    document.getElementById(
        "totalAmount"
    ).textContent = `Rp ${total.toLocaleString("id-ID")}`;
}
