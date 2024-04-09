<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Notifications\VerifyEmail;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'full_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'gender' => ['required', 'string', 'in:male,female'],
            'website' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'image' => ['nullable'],
            'avatar' => ['nullable'],

        ]);

        $user = User::where('username', 'Instagram')->first();
        $follower = "";
        $followee = User::where('username', 'Instagram')->first();

        if (!$user) {
            $user = User::create([
                'email' => 'instagram@gmail.com',
                'password' => Hash::make("123456789"),
                'full_name' => "Instagram Official",
                'username' => "Instagram",
                'gender' => "Male",
                'website' => "http://instagram.com",
                'bio' => "this is instagram official",
                'image' =>  json_encode("ProfileImgs/deqhdvkqgzrzs7xpntdm"),
            ]);

            $posts = [
                [
                    'content' => 'Hacker 😎 #nature',
                    'user_id' => $user->id,
                    'images' => json_encode(["Posts/xv3yhe7xfzacof9g2yer", "Posts/nvndiozvfcgrx6kmmxt1"]),
                    'published_at' => now(),
                    'created_at' => now(),
                ],
                [
                    'content' => 'Boring  #nature',
                    'user_id' => $user->id,
                    'images' => json_encode(["Posts/j3x7b2qp7pgzvjt10bwp"]),
                    'published_at' => now(),
                    'created_at' => now(),
                ],
                [
                    'content' => 'flower',
                    'user_id' => $user->id,
                    'images' => json_encode(["Posts/syve8kqyw63yamyemdaw"]),
                    'published_at' => now(),
                    'created_at' => now(),
                ],
                [
                    'content' => 'Duis auteirure dolor in reprehenderit',
                    'user_id' => $user->id,
                    'images' => json_encode(["Posts/j3x7b2qp7pgzvjt10bwp"]),
                    'published_at' => now(),
                    'created_at' => now(),
                ],
                [
                    'content' => 'Excepteur sint  #nature occaecat cupidatat non proident',
                    'user_id' => $user->id,
                    'images' => json_encode(["Posts/iwkyyv7myyxqjgkdxom4"]),
                    'published_at' => now(),
                    'created_at' => now(),
                ],
                [
                    'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                    'user_id' => $user->id,
                    'images' => json_encode(["Posts/iwkyyv7myyxqjgkdxom4"]),
                    'published_at' => now(),
                    'created_at' => now(),
                ],
                [
                    'content' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
                    'user_id' => $user->id,
                    'images' => json_encode(["Posts/syve8kqyw63yamyemdaw"]),
                    'published_at' => now(),
                    'created_at' => now(),
                ],
                [
                    'content' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat',
                    'user_id' => $user->id,
                    'images' => json_encode(["Posts/j3x7b2qp7pgzvjt10bwp"]),
                    'published_at' => now(),
                    'created_at' => now(),
                ],
            ];


            foreach ($posts as $post) {
                DB::table('posts')->insert($post);
            }
            $followee = $user;
        }


        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'full_name' => $request->full_name,
            'username' => $request->username,
            'gender' => $request->gender,
            'website' => $request->website,
            'bio' => $request->bio,
            'image' => $request->image,
            'avatar' => $request->avatar,

        ]);
        $follower = $user;

        DB::table('followers')->insert([
            'follower_id' => $follower->id,
            'followee_id' => $followee->id,
        ]);

        $postsWithNature = Post::where('content', 'like', '%#nature%')->pluck('id');


        $tag = Tag::firstOrCreate(['name' => 'nature']);

        foreach ($postsWithNature as $postId) {
            $tag->posts()->attach($postId);
        }



        $user->updateAvatar($user->id);
        $user->notify(new VerifyEmail($user));

        event(new Registered($user));


        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
