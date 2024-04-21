<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;


class OfferController extends Controller
{
    /**
     * Indexdash method to retrieve all offers and display them on the welcome page.
     *
     * @return View
     */
    public function indexdash()
    {
        $offers = Offer::all()->toArray();
        return view('welcome', compact('offers'));
    }


    public function index()
    {
        $offers = Offer::all();
        return view('offers.index', compact('offers'));
    }

    public function create()
    {
        if (Gate::allows('is-admin')) {

            return view('offers.create');
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }

   

public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'description' => 'required',
        'expiry_date' => 'required|date',
    ]);

    // التحقق مما إذا كان التاريخ المدخل يساوي أو يسبق التاريخ الحالي
    if (Carbon::now()->gte(Carbon::parse($request->expiry_date))) {
        return redirect()->back()->withInput()->with('error', 'يجب أن يكون تاريخ انتهاء العرض أكبر من التاريخ الحالي.');
    }

    if ($request->hasFile('image')) {
        $imageName = Str::random(20) . '.' . $request->image->getClientOriginalExtension();
        $imagePath = public_path('images');
        $imagePath = str_replace('public', 'public_html', $imagePath);
        $request->image->move($imagePath, $imageName);
    }

    Offer::create([
        'title' => $request->input('title'),
        'image' => $imageName ?? null,
        'description' => $request->input('description'),
        'expiry_date' => $request->input('expiry_date'),
    ]);

    return redirect()->route('offers.index')->with('success', 'تمت إضافة العرض بنجاح.');
}

    public function show($id)
    {
        $offer = Offer::findOrFail($id);
        return view('offers.show', compact('offer'));
    }

    public function edit($id)
    {
        if (Gate::allows('is-admin')) {

            $offer = Offer::findOrFail($id);
            return view('offers.edit', compact('offer'));
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }

    public function update(Request $request, $id)
    {
        $offer = Offer::findOrFail($id);

        // Update offer data excluding the image
        $offer->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'expiry_date' => $request->input('expiry_date'),
        ]);

        // Upload a new image if provided
        $imageName = $this->uploadImage($request);

        if ($imageName) {
            // If a new image is provided, update the image field
            $offer->update([
                'image' => $imageName,
            ]);
        }


        return redirect()->route('offers.index', compact('offer'))->with('success', 'تم تحديث العرض بنجاح.');
    }


    private function uploadImage(Request $request)
{
    if ($request->hasFile('image')) {
        $imageName = Str::random(20) . '.' . $request->image->getClientOriginalExtension();
        $imagePath = public_path('images');
        $request->image->move($imagePath, $imageName);

        return $imageName;
    }

    return null;
}




    public function destroy($id)
    {
        if (Gate::allows('is-admin')) {
            $offer = Offer::findOrFail($id);
            $offer->delete();

            return redirect()->route('offers.index')->with('success', 'تم حذف العرض بنجاح.');
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
