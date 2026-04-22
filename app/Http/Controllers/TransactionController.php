<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->latest()->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::with('category')->where('stock', '>', 0)->get();
        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'products'           => 'required|array|min:1',
            'products.*.id'      => 'required|exists:products,id',
            'products.*.qty'     => 'required|integer|min:1',
            'paid_amount'        => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $totalAmount = 0;
            $items = [];

            foreach ($request->products as $item) {
                $product = Product::findOrFail($item['id']);

                if ($product->stock < $item['qty']) {
                    abort(422, "Stok {$product->name} tidak cukup.");
                }

                $subtotal = $product->price * $item['qty'];
                $totalAmount += $subtotal;

                $items[] = [
                    'product_id' => $product->id,
                    'quantity'   => $item['qty'],
                    'price'      => $product->price,
                    'subtotal'   => $subtotal,
                ];

                $product->decrement('stock', $item['qty']);
            }

            $transaction = Transaction::create([
                'user_id'        => auth()->id(),
                'invoice_number' => 'INV-' . strtoupper(uniqid()),
                'total_amount'   => $totalAmount,
                'paid_amount'    => $request->paid_amount,
                'change_amount'  => $request->paid_amount - $totalAmount,
            ]);

            foreach ($items as $item) {
                $transaction->details()->create($item);
            }

            session(['last_transaction_id' => $transaction->id]);
        });

        return redirect()->route('transactions.receipt', session('last_transaction_id'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('details.product', 'user');
        return view('transactions.show', compact('transaction'));
    }

    public function receipt(Transaction $transaction)
    {
        $transaction->load('details.product', 'user');
        return view('transactions.receipt', compact('transaction'));
    }
}
