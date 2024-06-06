<link rel="icon" href="../../images/logo_blue.png" type="image/x-icon">
<title>Asset Vertex</title>
<x-guest-layout>
    <div class="bg">  
        <div class="bg2" >
            <div class="left">
                <div class="logo">
                    <img src="./images/logo_white.png"  alt="">
                </div>
                <div class="title1">
                <img src="./images/icons/vector1.png" style="height: 25px; width: 25px;" alt="">
                </div>
                <div class="title2">
                    <p>The passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software.</p>
                </div>
                <div class="title3">
                    <p>Vincent Obi</p>
                </div>
                <div class="title4">
                <img src="./images/icons/vector2.png" style="height: 25px; width: 25px;" alt="">
                </div>
            </div>
            <div class="right">
                <div class="header-top">
                    <a href="javascript:window.history.back();" class="back-link"> <  Back</a>
                    <h1 class="welcome-text">Welcome</h1>
                </div>
                <div class="header"> 
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <h2>Register Individual Account!</h2>
                    <p>For the purpose of industry regulation, your details are required.</p>
                </div> 
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Name -->
                    <div class="form-group">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter your Name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Position -->
                    <div class="form-group">
                        <x-input-label for="position" :value="__('position')" />
                        <x-text-input id="position" class="block mt-1 w-full" type="text" name="position" :value="old('position')" required autofocus autocomplete="position" placeholder="Enter your Position"/>
                        <x-input-error :messages="$errors->get('position')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Enter your Email"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <x-input-label for="password" :value="__('Password')" />
                        <div class="password-toggle">
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Enter your Password"/>
                            <span class="toggle-password" onclick="togglePassword(this)">Show</span>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <div class="password-toggle">
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your Password"/>
                            <span class="toggle-password" onclick="togglePassword(this)">Show</span>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="checkbox-group">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <label for="remember_me">I agree to terms & conditions</label>
                    </div>

                    <div class="form-group">
                        <div class="forgot-password">
                            <x-primary-button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                {{ __('Register') }}
                            </x-primary-button>
                            <a class="text-blue-500 hover:text-blue-700" href="{{ route('login') }}">
                                {{ __('Already Have Acoount?') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>

<script>
    function togglePassword(element) {
        var passwordField = element.previousElementSibling;
        if (passwordField.type === "password") {
            passwordField.type = "text";
           
        } else {
            passwordField.type = "password";
          
        }
    }
</script>

<style>
    .password-toggle {
        position: relative;
    }
    .toggle-password {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #000;
    }
</style>
