<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Get all menu items
    public function index()
    {
        $menus = Menu::all();
        return response()->json($menus);
    }

    // Create a new menu item
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'item_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required',  // Image validation
        ]);

       // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $Path = $image->store('images','public');
        } else {
            $Path = null;
        }

        // Create a new menu item with the uploaded image
        $menuItem = Menu::create([
            'item_name'=> $validatedData['item_name'],
            'price'=> $validatedData['price'],
            'description'=> $validatedData['description'],
            'image'=> $Path
        ]);
               // Store the relative path of the image);

        return response()->json([
            'message' => 'Menu created successfully',
            'booking' => $menuItem,
        ], 201);
    }


    // Show a specific menu item
    public function show(Menu $menu)
    {
        return response()->json([
            'message' => 'Menus',
            'booking' => $menu,
        ]);
    }

    // Update a specific menu item
    public function update(Request $request, Menu $menu)
    {
        // Validate input
        $data =$request->validate([
            'item_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
             'image' => 'nullable|image|max:2048',
        ]);

        //Handle image upload if present
        $data = $request->only(['item_name', 'price', 'description']);
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        // Update the menu item
        $menu->update($data);

        return response()->json([
            'message' => 'Menu updated successfully',
            'booking' => $menu,
        ]);
    }

    // Delete a menu item
    public function destroy(Menu $menu)
    {
        // Delete the image if it exists
        // if ($menu->image) {
        //     Storage::disk('public')->delete($menu->image);
        // }

        $menu->delete();
        return response()->json(null, 204); // Return a 204 status for successful deletion
    }
}

