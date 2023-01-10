<?php

namespace App\Traits;

use App\Models\Product;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

trait Store
{
    public function makeUniqueSlug($name, $status='store')
    {
        $slug = Str::slug($name);
        return $slug;
    }
    public function store()
    {
        $attributes = request()->validate([
            "name" => ['required', 'max:255', 'unique:'.Product::class],
            'description'=>['required', 'max:500'],
            'price'=>['required', 'max:255'],
            'quantity'=>['required', 'max:255'],
        ]);

        if(! request()->has('status')) $attributes['status'] = 'published';

        try {
            $title = $attributes['title'];

            $attributes['slug'] = $this->makeUniqueSlug($title);
        } catch (\Throwable $th) {
            throw ValidationException::withMessages(['slug' => 'Please Change title, There was a problem publishing this title']);
        }


        //Handling Image upload
        if (request()->hasFile('thumbnail')) {
            $filename = $attributes['slug'] . '-thumbnail';
            $path = $this->UploadFile(request()->file('thumbnail'), 'Thumbnail', 'public', $filename);
            $attributes['thumbnail'] = $path;
        }


        //storing Product
        auth()->user()->posts()->create($attributes);

        return redirect(route('Product', ['Product' => $attributes['slug']]))->with('success', 'You have successfully published your Product');
    }

    public function update(Product $Product)
    {
        $attributes = request()->validate([
            "title" => ['required', 'max:255'],
            "excerpt" => ['required'],
            'thumbnail' => ['image'],
            "body" => ['required'],
            "campus_id" => ['required', Rule::exists('campuses', 'id')],
            "category_id" => ['required', Rule::exists('categories', 'id')],
        ]);



        try {
            $title = $attributes['title'];
            $attributes['slug'] = $this->makeUniqueSlug($title, 'update');
        } catch (\Throwable $th) {
            throw ValidationException::withMessages(['slug' => 'Please Change title, There was a problem publishing this title']);
        }

        //updated_at column
        $attributes['updated_at'] = now();


        $Product->update($attributes);

        return redirect(route('Product', ['Product'=>$Product->slug]))->with('success', 'Product Updated!');

    }


    public function destroy(Product $Product){
        $Product->delete();

        return back()->with('success', 'Product was deleted successfully');
    }

    public function edit(Product $Product)
    {
        return view('admin.posts.edit', ['Product' => $Product]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }
}
