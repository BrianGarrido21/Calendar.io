<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Importa Rule para validaciones únicas

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::paginate(10); 
        return view('tags.index', compact('tags'));
    }


    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name', 
            'color' => 'required|string|max:7', 
        ]);

        Tag::create($request->all());
        return redirect()->route('tags.index')->with('success', '¡Tag creado exitosamente!');
    }


    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tags')->ignore($tag->id),
            ],
            'color' => 'required|string|max:7',
        ]);

        $tag->update($request->all());

        return redirect()->route('tags.index')->with('success', '¡Tag actualizado exitosamente!');
    }

}
