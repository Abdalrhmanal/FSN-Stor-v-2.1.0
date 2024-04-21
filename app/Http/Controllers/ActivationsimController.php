<?php

namespace App\Http\Controllers;

use App\Notifications\ActivationSimeAdd;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Activationsim;
use Illuminate\Http\Request;

class ActivationsimController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 1) {
            $activationSims = Activationsim::all();

            return view('activate_sims.index', compact('activationSims'));
        } elseif (Auth::user()->role_id == 2) {


            // استرجاع المستخدم الحالي
            $user = auth()->user();

            // استرجاع تفعيلات السيم المتعلقة بالمستخدم الحالي
            $activationSims = $user->activationSims;

            return view('activate_sims.index', compact('activationSims'));
        } else {
            return redirect()->route('login');
        }
    }



    public function create()
    {
        // عرض نموذج إضافة تفعيل سيم
        return view('activate_sims.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $activationSim = $user->activationSims()->create($request->all());

        $adminUser = \App\Models\User::where('role_id', 1)->first();
        if ($adminUser) {
            $adminUser->notify(new ActivationSimeAdd([
                'serial_number' => $activationSim->serial_number,
                'user_id' => $user->id,
                'activation_id' => $activationSim->id
            ]));
        }

        return redirect()->route('activate_sims.index')->with('success', 'تمت إضافة تفعيل سيم بنجاح');
    }

    public function destroy(Activationsim $activationSims)
    {
        if (Gate::allows('is-admin')) {
            // حذف سجل تفعيل سيم
            $activationSims->delete();

            return redirect()->route('activate_sims.index')
                ->with('success', 'تم حذف تفعيل سيم بنجاح');
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
