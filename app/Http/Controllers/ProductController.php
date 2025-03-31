<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produse = product::all();
        return view('welcome',['produse' => $produse]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        // Stocăm imaginea în directorul public/storage/images
        $imagePath = $request->file('image')->store('images', 'public');
        
        // Salvăm calea către imagine în baza de date
        $validatedData['image'] = $imagePath;
        
        Product::create($validatedData);
        
        return redirect('/')->with('success', 'Produsul a fost adăugat cu succes!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produs = Product::findOrFail($id);
        return view('edit', ['produs' => $produs]);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $produs = Product::findOrFail($id);
        
        // Verificăm dacă a fost încărcată o imagine nouă
        if ($request->hasFile('image')) {
            // Ștergem imaginea veche dacă există
            if ($produs->image && Storage::disk('public')->exists($produs->image)) {
                Storage::disk('public')->delete($produs->image);
            }
            
            // Stocăm imaginea nouă
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        } else {
            // Păstrăm imaginea existentă
            unset($validatedData['image']);
        }
        
        $produs->update($validatedData);
        
        return redirect('/')->with('success', 'Produsul a fost actualizat cu succes!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produs = Product::findOrFail($id);
        $produs->delete();

        return redirect('/')->with('success', 'Produsul a fost șters cu succes!');
    }
}
