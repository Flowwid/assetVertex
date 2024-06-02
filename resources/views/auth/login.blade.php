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
                    <h2>Login To Your Account!</h2>
                    <p>Fill the information below to get back into your asset management.</p>
                </div> 
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <x-input-label for="email" value="Email" />
                        <div class="password-toggle">
                            <x-text-input id="email" class="email" type="text" name="fullname" :value="old('fullname')" required autofocus placeholder="Enter your Email" />
                          
                        </div>
                        <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <x-input-label for="password" value="Password" />
                        <div class="password-toggle">
                            <x-text-input id="password" class="password" type="password" name="password" required autocomplete="current-password" placeholder="Enter your Password"/>
                            <span class="toggle-password" onclick="togglePassword(this)">
                                Show
                            </span>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="checkbox-group">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <label for="remember_me">I agree to terms & conditions</label>
                    </div>

                    <div class="form-group">
                        <div class="forgot-password">
                            <x-primary-button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Login Account
                            </x-primary-button>
                            <a class="text-blue-500 hover:text-blue-700" href="{{ route('password.request') }}">
                                Forgot Your Password?
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
  
</style>
