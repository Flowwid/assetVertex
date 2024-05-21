<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="./css/registerStyle.css">
</head>
<body>
    <div class="container">
        <div class="left-section">
            <div class="quote">
                <blockquote>
                    The passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software.
                </blockquote>
                <p>Vincent Obi</p>
            </div>
        </div>
        <div class="right-section">
            <a href="#" class="back-link">← Back</a>
            <h1>Register Individual Account!</h1>
            <p>For the purpose of industry regulation, your details are required.</p>
            <form action="#" method="POST" class="registration-form">
                <label for="fullname">Your fullname*</label>
                <input type="text" id="fullname" name="fullname" required>

                <label for="email">Email address*</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Create password*</label>
                <input type="password" id="password" name="password" required>
                <span class="show-password">Show</span>

                <div class="terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I agree to terms & conditions</label>
                </div>

                <button type="submit" class="register-button">Register Account</button>
            </form>
            <div class="already-have-account">
                <span>Already Have Account?</span>
            </div>
        </div>
    </div>
</body>
</html>
