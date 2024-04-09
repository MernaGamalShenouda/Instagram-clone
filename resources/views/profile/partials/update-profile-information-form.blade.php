<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        @php
        if($user->image){

            $image = "https://res.cloudinary.com/dp3xwqpsq/image/upload/".json_decode($user->image);
     
        }


        @endphp

        <x-input-label for="image" :value="('Image')" />
        <div class="mt-1 flex items-center">
            <div class="w-12 h-12 overflow-hidden rounded-full">
                <img id="image-preview" class="w-full h-full object-cover rounded-full"
                    src="{{ $user->image ? $image : $user->avatar }}" alt="Image Preview">
            </div>
            <input id="image" name="image" type="file" accept="image/*" class="sr-only"
                onchange="previewAvatar(event)">
            <label for="image"
                class="cursor-pointer ml-2 text-sm text-indigo-600 hover:text-indigo-700">{{ __('Select Image') }}</label>
        </div>

        <div>
            <x-input-label for="full_name" :value="('Name')" />
            <x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full" :value="old('name', $user->full_name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
        </div>

        <div>
            <x-input-label for="bio" :value="('Bio')" />
            <x-text-input id="bio" name="bio" type="text" class="mt-1 block w-full" :value="old('bio', $user->bio)"
                autofocus autocomplete="bio" />
        </div>

        <div>
            <x-input-label for="gender" :value="('Gender')" />
            <x-text-input id="gender" name="gender" type="text" class="mt-1 block w-full" :value="old('gender', $user->gender)"
                required autofocus autocomplete="gender" />
        </div>

        <div>
            <x-input-label for="website" :value="('Website')" />
            <x-text-input id="website" name="website" type="text" class="mt-1 block w-full" :value="old('website', $user->website)"
                autofocus autocomplete="website" />
        </div>

        <div>
            <x-input-label for="email" :value="('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    function previewAvatar(event) {
        const input = event.target;
        const reader = new FileReader();

        reader.onload = function() {
            const preview = document.getElementById('image-preview');
            preview.src = reader.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
</script>

<style>
    #avatar-preview {
        object-fit: cover;
    }
</style>