const cart = [];

function addToCart(itemName, itemPrice) {
    const existingItem = cart.find(item => item.name === itemName);
    if (existingItem) {
        existingItem.quantity++;
    } else {
        cart.push({ name: itemName, price: itemPrice, quantity: 1 });
    }
    updateCart();
}

function removeFromCart(itemName) {
    const itemIndex = cart.findIndex(item => item.name === itemName);
    if (itemIndex !== -1) {
        cart[itemIndex].quantity--;
        if (cart[itemIndex].quantity === 0) {
            cart.splice(itemIndex, 1);
        }
    }
    updateCart();
}

function updateCart() {
    const cartList = document.getElementById('cart-list');
    cartList.innerHTML = '';
    let total = 0;

    cart.forEach(item => {
        const listItem = document.createElement('li');
        listItem.innerHTML = `
        ${item.name} - Rp. ${(item.price * item.quantity).toFixed(2)}
        <div class="quantity-buttons">
            <button onclick="removeFromCart('${item.name}')">-</button>
            <span>${item.quantity}</span>
            <button onclick="addToCart('${item.name}', ${item.price})">+</button>
        </div>
    `;
        cartList.appendChild(listItem);
        total += item.price * item.quantity;
    });

    document.getElementById('total').textContent = `Total: Rp. ${total.toFixed(2)}`;
}

document.getElementById('search').addEventListener('input', function() {
    const searchValue = this.value.toLowerCase();
    const items = document.querySelectorAll('.item-list li');
    items.forEach(item => {
        const itemName = item.querySelector('span').textContent.toLowerCase();
        if (itemName.includes(searchValue)) {
            item.style.display = 'flex';
        } else {
            item.style.display = 'none';
        }
    });
});

function showPatientModal() {
    document.getElementById('patientModal').style.display = 'block';
}

function closePatientModal() {
    document.getElementById('patientModal').style.display = 'none';
}

function filterPatients() {
    const searchValue = document.getElementById('searchPatient').value.toLowerCase();
    const patients = document.querySelectorAll('.patient-list li');
    patients.forEach(patient => {
        const patientText = patient.textContent.toLowerCase();
        if (patientText.includes(searchValue)) {
            patient.style.display = '';
        } else {
            patient.style.display = 'none';
        }
    });
}

function selectPatient(noRM, namaPasien) {
    document.getElementById('No_RM').value = noRM;
    document.getElementById('nama_pasien').value = namaPasien;
    closePatientModal();
}

function submitForm() {
    // Convert the cart array to JSON string
    const cartData = JSON.stringify(cart);
    // Assign the JSON string to a hidden input field in the form
    document.getElementById('cart-data').value = cartData;
    // Submit the form
    document.getElementById('checkout-form').submit();
}

function calculateTotal() {
    const cart = JSON.parse(document.getElementById('cart-data').value);
    let total = 0;
    cart.forEach(item => {
        total += item.price * item.quantity;
    });
    document.getElementById('total-value').value = total;
}
// Fungsi untuk mengatur nilai input tersembunyi total sebelum meng
function setTotalValue() {
    // Panggil fungsi untuk menghitung total
    calculateTotal();
    // Ambil nilai total yang telah dihitung
    const totalValue = document.getElementById('total-value').value;
    // Isi nilai total ke dalam input tersembunyi
    document.getElementById('total-value').value = totalValue;
}