<?php

namespace App\Http\Controllers;

use App\Interfaces\CourseCategoryInterface;
use App\Interfaces\CourseInterface;
use App\Interfaces\TransactionInterface;
use App\Interfaces\UserInterface;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $course;
    private $courseCategory;
    private $transaction;
    private $user;

    public function __construct(CourseInterface $course, CourseCategoryInterface $courseCategory, TransactionInterface $transaction, UserInterface $user)
    {
        $this->course         = $course;
        $this->courseCategory = $courseCategory;
        $this->transaction    = $transaction;
        $this->user           = $user;
    }

    public function index()
    {
        return view('product', [
            'products'   => $this->course->getAll(),
            'categories' => $this->courseCategory->getAll()
        ]);
    }

    public function show($id)
    {
        $course           = $this->course->getById($id);
        $techSpecs        = $course->courseTechSpec;
        $benefits         = $course->courseBenefit;
        $courseObjectives = $course->courseObjective;
        $authors          = $course->author;
        $isBought         = $course->isBought;
        $carts            = session()->get('cart');
        $discount         = $this->course->discount($id);
        // get discount that is not expired yet
        $discount = $discount->filter(function ($discount) {
            return $discount->end_date > now() && $discount->start_date < now() && $discount->role == auth()->user()->role;
        })->first();

        if ($carts != null) {
            $carts = array_filter($carts, function ($cart) {
                return $cart['user_id'] == auth()->user()->id;
            });

            // change to array
            $carts = array_values($carts);

            // check if course is in cart
            $course->isInCart = false;
            foreach ($carts as $cart) {
                if ($cart['id'] == $id) {
                    $course->isInCart = true;
                    break;
                }
            }
        }

        return view('detail-product', compact('course', 'techSpecs', 'benefits', 'courseObjectives', 'authors', 'isBought', 'carts', 'discount'));
    }

    public function addToCart(Request $request)
    {
        $product  = $this->course->getById($request->id);
        $discount = $this->course->discount($request->id);
        $discount = $discount->filter(function ($discount) {
            return $discount->end_date > now() && $discount->start_date < now() && $discount->role == auth()->user()->role;
        })->first();

        if ($discount) {
            $product->price = $discount->discount_price;
        }

        // add cart session
        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [
                $request->id => [
                    "id"          => $request->id,
                    "name"        => $product->title,
                    "price"       => $product->price,
                    "rent_month"  => auth()->user()->role == 2 ? 6 : 1,
                    "main_image"  => $product->main_image,
                    "total_price" => $product->price * (auth()->user()->role == 2 ? 6 : 1),
                    "user_id"     => auth()->user()->id,
                ],
            ];
            session()->put('cart', $cart);
        } else {
            if (isset($cart[$request->id])) {
                $cart[$request->id]['rent_month']  = auth()->user()->role == 2 ? 6 : 1;
                $cart[$request->id]['total_price'] = $product->price * (auth()->user()->role == 2 ? 6 : 1);
                session()->put('cart', $cart);
            } else {
                $cart[$request->id] = [
                    "id"          => $request->id,
                    "name"        => $product->title,
                    "price"       => $product->price,
                    "rent_month"  => auth()->user()->role == 2 ? 6 : 1,
                    "main_image"  => $product->main_image,
                    "total_price" => $product->price * (auth()->user()->role == 2 ? 6 : 1),
                    "user_id"     => auth()->user()->id,
                ];
                session()->put('cart', $cart);
            }
        }

        return response()->json([
            'status'  => true,
            'message' => 'Modul berhasil ditambahkan ke keranjang!'
        ]);
    }

    public function deleteCart(Request $request)
    {
        // delete cart by id
        $cart = session()->get('cart');
        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Product berhasil dihapus dari keranjang!'
        ]);
    }

    public function getAllCart()
    {
        $carts = session()->get('cart');
        if ($carts != null) {
            $carts = array_filter($carts, function ($cart) {
                return $cart['user_id'] == auth()->user()->id;
            });

            // change to array
            $carts = array_values($carts);
        }

        return view('cart', [
            'minRentMonth' => auth()->user()->role == 2 ? 6 : 1,
            'carts' => session()->get('cart'),
            'role'  => $this->user->getRole()
        ]);
    }

    public function updateCart(Request $request)
    {
        $rent_month = $request->rent_month;
        $id         = $request->id;

        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['rent_month']  = $rent_month;
            $cart[$id]['total_price'] = $cart[$id]['price'] * $rent_month;
            session()->put('cart', $cart);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Keranjang berhasil diupdate!'
        ]);
    }

    public function checkout()
    {
        $carts = session()->get('cart');
        if ($carts != null) {
            $carts = array_filter($carts, function ($cart) {
                return $cart['user_id'] == auth()->user()->id;
            });

            // change to array
            $carts = array_values($carts);
        }


        $totalPrice = 0;
        foreach ($carts as $cart) {
            $totalPrice += $cart['total_price'];
        }

        return view('checkout', [
            'carts' => $carts,
            'totalPrice' => $totalPrice,
            'user'  => auth()->user(),
        ]);
    }

    public function checkoutPayment(Request $request)
    {
        $carts = session()->get('cart');
        if ($carts != null) {
            $carts = array_filter($carts, function ($cart) {
                return $cart['user_id'] == auth()->user()->id;
            });

            $carts = array_values($carts);
        }

        $totalPrice = 0;
        foreach ($carts as $cart) {
            $totalPrice += $cart['total_price'];
        }

        $request['total_price'] = $totalPrice;
        $request['carts']       = $carts;

        try {
            $this->transaction->checkoutPayment($request->all());
            session()->forget('cart');
            return redirect()->back()->with('success', 'Pesanan berhasil dilakukan!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
