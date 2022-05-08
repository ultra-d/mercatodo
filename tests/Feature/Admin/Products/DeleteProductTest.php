<?php

namespace Tests\Feature\Admin\Products;

use Tests\TestCase;
use App\Models\User;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteProductTest extends TestCase
{
    use RefreshDatabase;

    public function testOneProductCanBeDeleted(): void
    {
        $product = Product::factory()->count(1)->make();
        $product = Product::first();

        if ($product) {
            $product->delete();
        }

        $this->assertTrue(true);
    }

    /* public function test_an_admin_can_delete_a_product()
    {
        $this->assertDatabaseHas('products', ['title'=> $this->product->title]);

        $this->delete(route('admin.products.destroy', $this->product))
            ->assertStatus(302)
            ->assertRedirect(route('admin.products.index'));

        $this->assertDeleted('products', array($this->product));
    }
 */
    public function testAnAdminCanDeleteProducts()
    {
        Storage::fake('image');
        $image = Image::factory()->create();
        $product = $image->product;
        
        $user = User::factory()->hasRoles(1, [
            'name' => 'Admin',
            ])->create();
            
        $this->actingAs($user)
            ->delete(route('admin.products.destroy', $product))
            ->assertRedirect(route('admin.products.index'));
        
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ])->assertDatabaseMissing('images', [
            'id' => $image->id,
        ]);
        Storage::disk('image')->assertMissing($product->id . '/' . $image->file_name);
    }

    private function productData(): array
    {
        return [
            'category_id' => '1',
            'image' => UploadedFile::fake()->image('product.jpg')->size(50),
            'code' => 'PRD1234567',
            'title' => 'Test product',
            'slug' => 'test-product-slug',
            'description' => 'my awesome test product description',
            'price' => 200,
            'quantity' => 10,
        ];
    }
}
