<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Code;
use App\Models\Coderecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class CategoryController extends Controller
{
    public function index()
{
    $categories = Category::where('archived', false)->get(); // استرجاع الفئات غير المؤرشفة فقط
    return view('categories.index', compact('categories'));
}

    public function show($id)
    {
        // عرض فئة محددة
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }
    
    // دالة لأرشفة الفئة
    public function archive(Category $category)
{
    $category->archive(); // استدعاء دالة الأرشفة في النموذج
    return redirect()->route('categories.index')->with('success', 'تمت عملية الأرشفة بنجاح.');
}
    // دالة لأرشفة فك الفئة
    public function archivecate(Category $category)
{
    $category->archivecat(); // استدعاء دالة الأرشفة في النموذج
    return redirect()->route('categories.index')->with('success', 'تمت عملية الأرشفة بنجاح.');
}
    
    public function archivedCategories()
{
    $archivedCategories = Category::where('archived', true)->get();
    return view('categories.archivedCategories', compact('archivedCategories'));
}
    public function create()
    {
        if (Gate::allows('is-admin')) {
            // عرض نموذج إضافة فئة
            return view('categories.create');
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }

    public function store(Request $request)
    {
        // حفظ الفئة المضافة
        $request->validate([
            'type' => 'required|unique:categories',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required',
        ]);

        // تحديد اسم الملف
        $imageName = time() . '.' . $request->image->getClientOriginalExtension();

        // تحديد المسار للحفظ
        $imagePath = public_path('images');
        $imagePath = str_replace('public', 'public_html', $imagePath);


        // حفظ الصورة
        $request->image->move($imagePath, $imageName);

        // إضافة الفئة إلى قاعدة البيانات
        Category::create([
            'type' => $request->input('type'),
            'image' => $imageName,
            'price' => $request->input('price'),
        ]);

        return redirect()->route('categories.index')->with('success', 'تمت إضافة الفئة بنجاح');
    }


    public function edit($id)
    {
        if (Gate::allows('is-admin')) {
            // عرض نموذج تعديل فئة
            $category = Category::findOrFail($id);
            return view('categories.edit', compact('category'));
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }

    public function update(Request $request, $id)
    {
        // Find the category by its ID
        $category = Category::findOrFail($id);

        // Validate the input
        $request->validate([
            'type' => 'required|unique:categories,type,' . $id,
            'price' => 'required|numeric',
        ]);

        // Update the category details
        $category->type = $request->input('type');
        $category->price = $request->input('price');

        // Check if a new image is provided
        if ($request->hasFile('image')) {
            // Validate and upload the new image
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $imagePath = public_path('images');
            $imagePath = str_replace('public', 'public_html', $imagePath);
            $request->image->move($imagePath, $imageName);

            // Update the image field in the database
            $category->image = $imageName;
        }

        // Save the updates
        $category->save();

        // Redirect the user to another page after saving
        return redirect()->route('categories.index')->with('success', 'تم تحديث الفئة بنجاح.');
    }



    public function destroy($id)
    {
        if (Gate::allows('is-admin')) {
            // Find the category by ID
            $category = Category::findOrFail($id);

            // Find codes associated with the category
            $codes = Code::where('category_id', $category->id)->get();

            // Delete associated code records
            foreach ($codes as $code) {
                Coderecord::where('code_id', $code->id)->delete();
            }

            // Delete associated codes
            Code::where('category_id', $category->id)->delete();

            // Delete the category
            $category->delete();

            return redirect()->route('categories.index')
                ->with('success', 'Category and associated codes deleted successfully.');
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
