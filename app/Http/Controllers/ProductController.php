<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Intervention\Image\Laravel\Facades\Image;
use Binafy\LaravelCart\LaravelCart;
use Illuminate\Support\Facades\Auth;
use \Binafy\LaravelCart\Models\Cart;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function show()
    {
        $products = Product::all();
        return view('products.show', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'image' => 'mimes:jpg,png|max:2048',
        ]);

        // Store the file in \public\uploads folder
        $fileName = time().'.'.$request->file('image')->extension();  
        $request->file('image')->move(public_path('uploads'), $fileName);
        $product = new Product();
        $product->name = $request->name;
        $product->slug = \Str::slug($request->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->image = $fileName;
        $product->save();

        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $fileName = "";
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);
        
        if($request->image) {
            $validatedData = $request->validate([
                'image' => 'mimes:jpg,png|max:2048'
            ]);
            // Store the file in \public\uploads folder
            $fileName = time().'.'.$request->file('image')->extension();  
            $request->file('image')->move(public_path('uploads'), $fileName);
        }
        
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->slug = \Str::slug($request->name);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        if($fileName) {
            $product->image = $fileName;
        }
        $product->save();

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index');
    }

    public function addToCart(Request $request, $slug)
    {
        $user = Auth::user();

        // Find the product by slug
        $product = Product::where('slug', $slug)->first();
   
        // Check if the product exists
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }

        // Fetch the user's cart
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $productId = $product->id;
        
        // Find the CartItem where the product's id matches the $productId
        $cartItem = $cart->items()->whereHas('itemable', function ($query) use ($productId) {
            $query->where('id', $productId);
        })->first();
        
        if ($cartItem) { // if product is already added then increment the quatity
            LaravelCart::driver('database')->increaseQuantity($product, 1);
        } else { // Store the item in the cart
            LaravelCart::driver('database')->storeItem($product, $user->id);
        }
    
        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    public function cart()
    {
        // Fetch or create the user's cart
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
    
        // Fetch all items in the cart along with their related products
        $items = $cart->items()->with('itemable')->get();
        // Map over the items and extract product details, ensuring the itemable is a Product
        $products = $items->filter(fn($item) => $item->itemable_type === Product::class)
                          ->map(fn($item) => [
                            'id' => $item->itemable_id, //product id
                              'name' => $item->itemable->name,
                              'price' => $item->itemable->getPriceByQuantityperItem($item->quantity),
                              'slug' => $item->itemable->slug,
                              'quantity' => $item->quantity,
                              'image' => $item->itemable->image,
                              'itemable_id' => $item->itemable_id, //product id
                          ])
                          ->all();
        $ordertotal = $cart->calculatedPriceByQuantity();
                          //dd($products);
        // Return the view with the product data
        return view('products.cart', compact('products', 'ordertotal'));
    }

    public function removeFromCart(Request $request, $productId)
    {
        // Fetch the user's cart
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
    
        // Find the CartItem where the product's id matches the $productId
        $cartItem = $cart->items()->whereHas('itemable', function ($query) use ($productId) {
            $query->where('id', $productId);
        })->first();
    
        // If the cart item exists, delete it
        if ($cartItem) {
            $cartItem->delete();
            return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
        } else {
            return redirect()->route('cart.index')->with('error', 'Product not found in the cart!');
        }
    
        return redirect()->route('cart.index');
    }

    public function increaseQuantity(Request $request, $productId)
    {
        $cart = Cart::query()->firstOrCreate(['user_id' => Auth::id()]);
        $item = $cart->items()->whereHas('itemable', function ($query) use ($productId) {
            $query->where('id', $productId);})->first();
        $cart->increaseQuantity(item: $item['itemable'], quantity: 1);

        return redirect()->route('cart.index');
    }

    public function decreaseQuantity(Request $request, $productId)
    {
        $cart = Cart::query()->firstOrCreate(['user_id' => Auth::id()]);
        $item = $cart->items()->whereHas('itemable', function ($query) use ($productId) {
            $query->where('id', $productId);})->first();
        $cart->decreaseQuantity(item: $item, quantity: 1);
        
        return redirect()->route('cart.index');
    }
}
