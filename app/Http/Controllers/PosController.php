<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;


class PosController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(['category', 'unit'])->get();

        $customers = Customer::all()->sortBy('name');

        $carts = $this->getCartItems();

        return view('pos.index', [
            'products' => $products,
            'customers' => $customers,
            'carts' => $carts,
        ]);
    }

    public function addCartItem(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|string',
            'selling_price' => 'required|numeric',
        ]);

        Cart::add(
            $validatedData['id'],
            $validatedData['name'],
            1, // Assuming quantity is always 1 when adding
            $validatedData['selling_price'],
            1 // Assuming tax is always 1 when adding
        );

        return redirect()->back()->with('success', 'Product has been added to cart!');
    }

    public function updateCartItem(Request $request, $rowId)
    {
        $validatedData = $request->validate([
            'qty' => 'required|numeric',
            'product_id' => 'numeric'
        ]);

        if ($validatedData['qty'] > $this->getProductQuantity($validatedData['product_id'])) {
            return redirect()->back()->with('error', 'The requested quantity is not available in stock.');
        }

        Cart::update($rowId, $validatedData['qty']);

        return redirect()->back()->with('success', 'Product has been updated in cart!');
    }

    public function deleteCartItem(String $rowId)
    {
        Cart::remove($rowId);

        return redirect()->back()->with('success', 'Product has been removed from cart!');
    }

    protected function getCartItems()
    {
        $cartItems = [];

        foreach (Cart::content() as $item) {
            $cartItems[] = [
                'id' => $item->id,
                'name' => $item->name,
                'quantity' => $item->qty,
                'price' => $item->price,
            ];
        }

        return $cartItems;
    }

    protected function getProductQuantity($productId)
    {
        return Product::where('id', $productId)->value('quantity');
    }
}
