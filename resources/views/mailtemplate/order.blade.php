<h1>New order from {{ $name }}</h1>
<div>
    <label>OrderId:</label>
    <span>{{ $order_id }}</span>
    <br>
    <label>Customer Name:</label>
    <span>{{ $name }}</span>
    <br>
    <label>Amount in GBP:</label>
    <span>{{ $coin_cost }}</span>
    <br>
    <label>Amount in {{ $tag }}:</label>
    <span>{{ $coin_price }}</span>
    <br>
    <label>Fee:</label>
    <span>{{ $fee }}</span>
    <br>
    <label>Wallet address:</label>
    <span>{{ $wallet }}</span>
    
</div>