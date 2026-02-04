<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order and Payment - Minimal Cafe</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f7f3e9;
            font-family: 'Kanit', sans-serif;
        }
        .sidebar {
            background-color: #3e3e3e;
            color: #ffffff;
            width: 200px;
            height: 100vh;
            padding-top: 20px;
            position: fixed;
            left: 0;
            top: 0;
        }
        .sidebar h3 {
            color: #ffffff;
            margin-bottom: 20px;
            text-align: center;
        }
        .sidebar a {
            color: #ffffff;
            text-decoration: none;
            padding: 10px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #575757;
            border-radius: 8px;
            padding-left: 10px;
        }
        .content {
            margin-left: 220px;
            padding: 40px;
        }
        .product-list .list-group-item {
            background-color: #ffffff;
            border-radius: 8px;
            margin-bottom: 10px;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .category-name {
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: #6b4f4f;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 2px solid #a67c52;
            padding-bottom: 5px;
        }
        .product-list h5 {
            font-weight: bold;
            color: #6b4f4f;
        }
        .order-summary {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-add-to-order {
            background-color: #3e8e41;
            color: white;
            border: none;
            transition: background-color 0.2s ease-in-out;
        }
        .btn-add-to-order:hover, .btn-add-to-order:focus {
            background-color: #357a38;
            outline: none;
        }
        .btn-success {
            background-color: #a67c52;
            border: none;
        }
        .btn-success:hover {
            background-color: #8b6442;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Coffee POS</h3>
        <a href="{{ route('sales.index') }}">Order and Payment</a>
        <a href="{{ route('sales.history') }}">Sales History</a>
        <a href="{{ route('categories.index') }}">Category</a>
        <a href="{{ route('products.index') }}">Products</a>
    </div>

    <div class="container mt-4 content">
        <h2>Order and Payment</h2>
        <div class="row">
            <div class="col-md-8">
                <h4>Menu</h4>
                @foreach($categories as $category)
                    <div class="category-name">{{ $category->name }}</div>
                    <div class="mb-4 product-list list-group">
                        @foreach($category->products as $product)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50" class="mr-3">
                                    <div>
                                        <h5 class="mb-1">{{ $product->name }}</h5>
                                    </div>
                                </div>
                                <button class="btn btn-success btn-add-to-order" onclick="showDrinkTypeModal('{{ $product->name }}', {{ $product->price_hot }}, {{ $product->price_cold }}, {{ $product->price_blend }})">Add to Order</button>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
    
            <div class="col-md-4">
                <h4>Current Order</h4>
                <div class="p-3 order-summary">
                    <ul id="orderList" class="mb-3 list-group"></ul>
                    <div class="d-flex justify-content-between">
                        <span>Subtotal:</span>
                        <span id="subtotal">$0.00</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Vat:</span>
                        <span id="vat">$0.00</span>
                    </div>
                    <div class="d-flex justify-content-between font-weight-bold">
                        <span>Discount:</span>
                        <input type="number" id="discountInput" value="0" min="0" onchange="updateOrder()" />
                    </div>
                    <div class="d-flex justify-content-between font-weight-bold">
                        <span>Total:</span>
                        <span id="total">$0.00</span>
                    </div>
                    <button class="mt-3 btn btn-primary btn-block" onclick="placeOrder()">Place Order</button>
                </div>
            </div>
            <div class="modal fade" id="drinkTypeModal" tabindex="-1" aria-labelledby="drinkTypeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="drinkTypeModalLabel">Select Drink Type</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <button class="btn btn-secondary btn-block" onclick="selectDrinkType('hot')">Hot</button>
                            <button class="btn btn-secondary btn-block" onclick="selectDrinkType('cold')">Cold</button>
                            <button class="btn btn-secondary btn-block" onclick="selectDrinkType('blend')">Blend</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let order = [];
        let subtotal = 0;
        const vaxRate = 0.07;
        let selectedProduct = {};

        function showDrinkTypeModal(name, price_hot, price_cold, price_blend) {
            selectedProduct = { name, price_hot, price_cold, price_blend };
            document.querySelector('#drinkTypeModal .btn-secondary:nth-child(1)').onclick = () => selectDrinkType('Hot', price_hot);
            document.querySelector('#drinkTypeModal .btn-secondary:nth-child(2)').onclick = () => selectDrinkType('Cold', price_cold);
            document.querySelector('#drinkTypeModal .btn-secondary:nth-child(3)').onclick = () => selectDrinkType('Blend', price_blend);

            $('#drinkTypeModal').modal('show'); // เปิด modal
        }

        function selectDrinkType(type, price) {
            order.push({ name: selectedProduct.name, type, price, quantity: 1 });
            updateOrder();
            $('#drinkTypeModal').modal('hide');
        }
    
        function addToOrder(name, price) {
            const item = order.find(item => item.name === name);
            if (item) {
                item.quantity += 1;
            } else {
                order.push({ name, price, quantity: 1 });
            }
            updateOrder();
        }
    
        function updateOrder() {
            const orderList = document.getElementById('orderList');
            orderList.innerHTML = '';
            subtotal = 0;
    
            order.forEach((item, index) => {
                subtotal += item.price * item.quantity;
                const listItem = document.createElement('li');
                listItem.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                listItem.innerHTML = `
                    <div>${item.name} - $${item.price.toFixed(2)}</div>
                    <div class="d-flex align-items-center">
                        <button onclick="changeQuantity(${index}, -1)" class="btn btn-sm btn-light">-</button>
                        <span class="mx-2">${item.quantity}</span>
                        <button onclick="changeQuantity(${index}, 1)" class="btn btn-sm btn-light">+</button>
                    </div>
                `;
                orderList.appendChild(listItem);
            });
    
            const vat = subtotal * vaxRate;
            const discount = parseFloat(document.getElementById('discountInput').value) || 0;
            const total = subtotal + vat - discount;
    
            document.getElementById('subtotal').innerText = `$${subtotal.toFixed(2)}`;
            document.getElementById('vat').innerText = `$${vat.toFixed(2)}`;
            document.getElementById('total').innerText = `$${total.toFixed(2)}`;
        }
    
        function changeQuantity(index, amount) {
            const item = order[index];
            if (item) {
                item.quantity += amount;
                if (item.quantity <= 0) {
                    order.splice(index, 1);
                }
                updateOrder();
            }
        }
    
        function placeOrder() {
            if (order.length === 0) {
                alert("No items in the order!");
                return;
            }

            // สร้างรายการ order พร้อมรวม VAT
            const orderWithVat = order.map(item => {
                const totalPriceWithVat = item.price * (1 + vaxRate);
                return {
                    ...item,
                    price: totalPriceWithVat.toFixed(2) // รวม VAT ในราคาสินค้า
                };
            });

            console.log("Order data being sent:", orderWithVat); // ตรวจสอบข้อมูลคำสั่งซื้อที่ส่งไป

            fetch("{{ route('sales.placeOrder') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-Token": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ orders: orderWithVat })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Order placed successfully!");
                    order = [];  // รีเซ็ตคำสั่งซื้อหลังจากสั่งซื้อสำเร็จ
                    updateOrder();
                } else {
                    alert("Failed to place order: " + data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred while placing the order.");
            });
        }


    </script>
</body>
</html>
