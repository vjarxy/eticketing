<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cartItems = $user->carts()->with('ticket')->get();
        $total = $cartItems->sum('total');

        return view('pengunjung.cart.index', compact('cartItems', 'total'));
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Check if cart belongs to current user
        if ($cart->user_id !== Auth::id()) {
            return redirect()->route('cart.index')->with('error', 'Item tidak ditemukan di keranjang Anda');
        }

        $cart->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui');
    }

    public function destroy(Cart $cart)
    {
        // Check if cart belongs to current user
        if ($cart->user_id !== Auth::id()) {
            return redirect()->route('cart.index')->with('error', 'Item tidak ditemukan di keranjang Anda');
        }

        $cart->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang');
    }

    public function clear()
    {
        $user = Auth::user();
        Cart::where('user_id', $user->id)->delete();

        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan');
    }
}
