<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Traits\ApiResponseTrait;

/**
 * @OA\Info(
 *     title="My API",
 *     version="1.0.0"
 * )
 */


class ProductController extends Controller
{
    use ApiResponseTrait;

    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Get list of products",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function index()
    {
        $products = Product::all();
        return $this->success($products);
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     summary="Create a new product",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="price", type="number", format="float")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Product created successfully"
     *     )
     * )
     */

    public function store(Request $request)
    {
        $loginResponse = $this->is_login($request);
        if ($loginResponse->getStatusCode() != 200) {
            return $loginResponse; // إذا كانت التوكن غير صحيحة، أرجع رسالة الخطأ
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $product = Product::create($request->all());
        return $this->success($product, 'Product created successfully');
    }


    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     summary="Get product details by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the product",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Product retrieved successfully"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Product Name"),
     *                 @OA\Property(property="description", type="string", example="Product Description"),
     *                 @OA\Property(property="price", type="number", format="float", example=99.99),
     *                 @OA\Property(property="quantity", type="integer", example=100)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Product not found"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     )
     * )
     */

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->error('Product not found', 404);
        }
        return $this->success($product);
    }


    /**
     * @OA\Put(
     *     path="/api/products/{id}",
     *     summary="Update product by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the product to update",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Updated Product Name"),
     *             @OA\Property(property="description", type="string", example="Updated Product Description"),
     *             @OA\Property(property="price", type="number", format="float", example=99.99),
     *             @OA\Property(property="quantity", type="integer", example=50)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Product updated successfully"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Updated Product Name"),
     *                 @OA\Property(property="description", type="string", example="Updated Product Description"),
     *                 @OA\Property(property="price", type="number", format="float", example=99.99),
     *                 @OA\Property(property="quantity", type="integer", example=50)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Product not found"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     )
     * )
     */


    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->error('Product not found', 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $product->update($request->all());
        return $this->success($product, 'Product updated successfully');
    }

    /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     summary="Delete product by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the product to delete",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Product deleted successfully"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Product not found"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     )
     * )
     */

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->error('Product not found', 404);
        }

        $product->delete();
        return $this->success(null, 'Product deleted successfully');
    }

}
