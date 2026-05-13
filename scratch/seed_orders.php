<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

use Illuminate\Contracts\Console\Kernel;
$app->make(Kernel::class)->bootstrap();

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;

$user = User::first();
$products = Product::all();

if ($products->count() == 0) {
    echo "No hay productos en la base de datos para vender.\n";
    exit;
}

echo "Generando 37 pedidos de prueba...\n";

// Vamos a elegir 3 productos para que sean los "Top Ventas"
$topProducts = $products->random(min(3, $products->count()));

for ($i = 1; $i <= 37; $i++) {
    $order = Order::create([
        'user_id' => $user->id,
        'total' => 0,
        'status' => 'Entregado',
        'address' => 'Calle Falsa 123',
        'phone' => '600112233',
        'notes' => 'Pedido de prueba ' . $i
    ]);

    $totalOrder = 0;
    
    // Cada pedido tiene de 1 a 3 productos
    $numItems = rand(1, 3);
    
    for ($j = 0; $j < $numItems; $j++) {
        // Un 60% de probabilidad de que sea uno de los "Top"
        if (rand(1, 10) <= 6) {
            $product = $topProducts->random();
        } else {
            $product = $products->random();
        }
        
        $qty = rand(1, 2);
        $price = $product->precio_oferta ?? $product->precio;
        
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $qty,
            'price' => $price
        ]);
        
        $totalOrder += ($price * $qty);
    }
    
    $order->update(['total' => $totalOrder]);
}

echo "¡37 pedidos generados con éxito!\n";
