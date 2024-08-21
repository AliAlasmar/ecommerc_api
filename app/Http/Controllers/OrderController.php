<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Traits\ApiResponseTrait;

class OrderController extends Controller
{
    use ApiResponseTrait;

    /**
     * @OA\Post(
     *     path="/api/orders",
     *     summary="Create a new order",
     *     description="Create a new order by providing product IDs and their quantities.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="products",
     *                 type="array",
     *                 description="List of products to order",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1, description="ID of the product"),
     *                     @OA\Property(property="quantity", type="integer", example=2, description="Quantity of the product")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Order placed successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Order placed successfully"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1, description="Order ID"),
     *                 @OA\Property(property="user_id", type="integer", example=1, description="ID of the user who placed the order"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-08-21 12:34:56"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2023-08-21 12:34:56"),
     *                 @OA\Property(
     *                     property="products",
     *                     type="array",
     *                     @OA\Items(
     *                         @OA\Property(property="id", type="integer", example=1, description="ID of the product"),
     *                         @OA\Property(property="name", type="string", example="Product Name", description="Name of the product"),
     *                         @OA\Property(property="pivot", type="object",
     *                             @OA\Property(property="quantity", type="integer", example=2, description="Quantity ordered"),
     *                             @OA\Property(property="user_id", type="integer", example=1, description="ID of the user who placed the order"),
     *                             @OA\Property(property="created_at", type="string", format="date-time", example="2023-08-21 12:34:56"),
     *                             @OA\Property(property="updated_at", type="string", format="date-time", example="2023-08-21 12:34:56")
     *                         )
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Not enough quantity for product",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Not enough quantity for product: Product Name"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Unauthorized"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Validation errors occurred"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */

    public function store(Request $request)
    {
        $loginResponse = $this->is_login($request);
        if ($loginResponse->getStatusCode() != 200) {
            return $loginResponse; // إذا كانت التوكن غير صحيحة، أرجع رسالة الخطأ
        }

        // تحقق من صحة البيانات
        $validatedData = $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // إنشاء طلب جديد في جدول orders
        $order = Order::create(['user_id' => auth()->id()]);

        // إعداد البيانات لإدراجها في جدول order_products
        $orderProducts = [];
        foreach ($request->products as $productRequest) {
            $product = Product::find($productRequest['id']);
            if ($product->quantity < $productRequest['quantity']) {
                return $this->error("Not enough quantity for product: " . $product->name, 400);
            }

            // استخدام العلاقة attach() لإضافة البيانات إلى جدول order_products
            $order->products()->attach($product->id, [
                'quantity' => $productRequest['quantity'],
                'user_id' => auth()->id(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // تقليل كمية المنتج
            $product->decrement('quantity', $productRequest['quantity']);
        }

        // تحميل المنتجات المرتبطة بالطلب وإرجاع استجابة ناجحة
        return $this->success($order->load('products'), 'Order placed successfully');
    }

}
