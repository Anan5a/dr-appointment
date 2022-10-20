<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyUserRequest;
use App\Http\Requests\ShowUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\ViewUsersRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected const SORT = 'ASC';
    protected const PER_PAGE = 50;

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(ViewUsersRequest $request)
    {
        $users = User::with('roles');
        if ($request->query('result_type') && !in_array('all', $request->query('result_type', []))) {
            $users = User::role(Role::find($request->query('result_type')));
        }
        if ($request->query('query')) {
            $users->where('first_name', 'like', "%{$request->query('query')}%")
                ->orWhere('last_name', 'like', "%{$request->query('query')}%")
                ->orWhere('mobile', 'like', "%{$request->query('query')}%");
        }
        $users = $users->orderBy('id', $request->query('sort_order', self::SORT))
            ->paginate($request->query('per_page', self::PER_PAGE));
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {

        $data = $request->only(['first_name','last_name','email','date_of_birth','mobile']);
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        $user->syncRoles(Role::find($request->role));
        return redirect()->back()->with('message','User created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $user
     * @return Response
     */
    public function show(ShowUserRequest $request, User $user)
    {
        dd($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $user
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->only('first_name','last_name','date_of_birth','mobile'));
        $user->syncRoles(Role::find($request->role));
        return redirect()->route('admin.home.index')->with('message','User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(DestroyUserRequest $request,User $user): RedirectResponse
    {
        if(auth()->user()->id == $user->id){
            return redirect()->back()->withErrors(['message'=>'You cannot delete yourself!']);
        }
        $user->delete();
        return redirect()->back()->with('message','User deleted successfully!');
    }

    public function profile(Request $request): Response
    {
        return $this->show($request, auth()->user()->id());
    }
}
