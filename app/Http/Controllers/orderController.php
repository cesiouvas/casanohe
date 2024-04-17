<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use App\Models\Orders;
use App\Models\Products;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Http\Request;

class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Orders::select('users.*', 'orders.*', 'orders.id as orderId')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->orderBy('orders.created_at')
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($userId)
    {
        $user = User::findOrFail($userId);

        //$products = Products::get();

        $sc = ShoppingCart::select('shoppingcart.quantity as scquantity', 'products.*')
            ->leftjoin('products', 'products.id', '=', 'shoppingcart.product_id')
            ->where('user_id', $userId)
            ->get();

        return view('orders.create', compact('user', 'sc'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'costeTotal' => 'required',
            'userId' => 'required',
        ]);

        // Crear pedido
        Orders::create([
            'totalPrice' => $request->costeTotal,
            'user_id' => $request->userId,
            'order_status' => 0
        ]);

        // Obtener el último pedido realizado por el usuario
        $lastOrder = Orders::where('user_id', $request->userId)
            ->orderByDesc('created_at')
            ->first();

        // Obtener las líneas de pedido del carrito de compras
        $cartLines = ShoppingCart::where('user_id', $request->userId)->get();

        // Procesar cada línea del carrito de compras
        foreach ($cartLines as $cartLine) {
            // Actualizar la cantidad de productos
            $product = Products::findOrFail($cartLine->product_id);
            $newQuantity = $product->quantity - $cartLine->quantity;

            $product->update([
                'quantity' => $newQuantity
            ]);

            // Crear línea de pedido
            OrderProduct::create([
                'quantity' => $cartLine->quantity,
                'product_id' => $cartLine->product_id,
                'order_id' => $lastOrder->id
            ]);
        }

        // Limpiar el carrito de compras después de completar el pedido
        ShoppingCart::where('user_id', $request->userId)->delete();

        // Redireccionar o devolver una respuesta según sea necesario
        return redirect()->route('users.index')
            ->with('success', 'order created!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Orders::findOrFail($id);

        $orderLines = OrderProduct::select('order_product.quantity as line_quantity', 'order_product.*', 'products.*')
        ->leftJoin('products', 'products.id', '=', 'order_product.product_id')
            ->where('order_product.order_id', '=', $id)
            ->get();

            //dd($orderLines);

        $user = User::findOrFail($order->user_id);

        return view('orders.show', compact('order', 'orderLines', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
