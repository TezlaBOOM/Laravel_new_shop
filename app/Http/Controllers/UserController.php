<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Address;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\JsonResponse;
use function PHPUnit\Framework\throwException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('users.index',[
            'users'=> User::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $addressValidated = $request->validated()['address'];
        if ($user->hasAddress()) {
            $address = $user->address;
            $address->fill($addressValidated);
        } else {
            $address = new Address($addressValidated);
        }
        $user->address()->save($address);
        return redirect(route('users.index'))->with('status', __('shop.product.status.update.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
       try{
        $user->delete();
        Session::flash('status',__('sklep.users.status.delete.success'));
        return response()->json([
            'status' => 'success'
        ]);
       }catch (Exception $e) {
        return response()->json([
            'status' => 'success',
            'message' =>'wystąpił błąd'
        ])->setStatusCode(500);
        }
    }
}
