<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $user = User::where('username', 'Instagram')->first();
        // if(!$user){
        //     $user=User::create([
        //         'email' => 'instagram@gmail.com',
        //         'password' => Hash::make("123456789"),
        //         'full_name' => "Instagram Official",
        //         'username' => "Instagram",
        //         'gender' => "Male",
        //         'website' => "http://instagram.com",
        //         'bio' => "this is instagram official",
        //         'image' => json_encode("ProfileImgs/deqhdvkqgzrzs7xpntdm"),
        //     ]);
            
        //     $posts = [
        //         [
        //             'content' => 'Hacker 😎 #nature',
        //             'user_id' => $user->id,
        //             'images' => json_encode(["Posts/xv3yhe7xfzacof9g2yer", "Posts/nvndiozvfcgrx6kmmxt1"]),
        //             'published_at' => now(),
        //         ],
        //         [
        //             'content' => 'Boring  #nature',
        //             'user_id' => $user->id,
        //             'images' => json_encode(["Posts/j3x7b2qp7pgzvjt10bwp"]),
        //             'published_at' => now(),
        //         ],
        //         [
        //             'content' => 'flower',
        //             'user_id' => $user->id,
        //             'images' => json_encode(["Posts/syve8kqyw63yamyemdaw"]),
        //             'published_at' => now(),
        //         ],
        //         [
        //             'content' => 'Duis auteirure dolor in reprehenderit',
        //             'user_id' => $user->id,
        //             'images' => json_encode(["Posts/j3x7b2qp7pgzvjt10bwp"]),
        //             'published_at' => now(),
        //         ],
        //         [
        //             'content' => 'Excepteur sint  #nature occaecat cupidatat non proident',
        //             'user_id' => $user->id,
        //             'images' => json_encode(["Posts/iwkyyv7myyxqjgkdxom4"]),
        //             'published_at' => now(),
        //         ],
        //         [
        //             'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
        //             'user_id' => $user->id,
        //             'images' => json_encode(["Posts/iwkyyv7myyxqjgkdxom4"]),
        //             'published_at' => now(),
        //         ],
        //         [
        //             'content' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
        //             'user_id' => $user->id,
        //             'images' => json_encode(["Posts/syve8kqyw63yamyemdaw"]),
        //             'published_at' => now(),
        //         ],
        //         [
        //             'content' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat',
        //             'user_id' => $user->id,
        //             'images' => json_encode(["Posts/j3x7b2qp7pgzvjt10bwp"]),
        //             'published_at' => now(),
        //         ],
        //     ];
            

        //     foreach ($posts as $post) {
        //         DB::table('posts')->insert($post);
        //     }

        // }
        // $user = User::where('username', 'Admin')->first();
        // if (!$user) {
        //     User::create([
        //         'email' => 'admin@gmail.com',
        //         'password' => Hash::make("123456789"),
        //         'full_name' => "Admin",
        //         'username' => "Admin",
        //         'gender' => "Male",
        //         'website' => "http://Admin.com",
        //         'bio' => "this is Admin",
        //         'image' => json_encode("ProfileImgs/deqhdvkqgzrzs7xpntdm"),
        //         'email_verified_at' => now()
        //     ]);
        // }
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if($request->email == 'admin@gmail.com'){
            return redirect('/admin');
        }

        return redirect('/instagram');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
