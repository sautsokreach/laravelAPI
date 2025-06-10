<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication System</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            overflow: hidden;
            position: relative;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .header h1 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .header p {
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .form-container {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
        }

        .btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .btn.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .form-links {
            text-align: center;
            margin-top: 1.5rem;
        }

        .form-links a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .form-links a:hover {
            color: #764ba2;
        }

        .form-section {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .form-section.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .nav-tabs {
            display: flex;
            background: #f8f9fa;
            border-radius: 10px;
            padding: 0.5rem;
            margin-bottom: 2rem;
        }

        .nav-tab {
            flex: 1;
            padding: 0.75rem;
            text-align: center;
            background: transparent;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-tab.active {
            background: white;
            color: #667eea;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-section {
            text-align: center;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 1rem;
            border: 4px solid #667eea;
            object-fit: cover;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .profile-image:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .profile-email {
            color: #666;
            margin-bottom: 2rem;
        }

        .profile-actions {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .btn-secondary {
            background: #6c757d;
            flex: 1;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .file-input {
            display: none;
        }

        .file-input-label {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: #667eea;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-input-label:hover {
            background: #764ba2;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .logout-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 0.5rem;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        @media (max-width: 480px) {
            .container {
                margin: 1rem;
                max-width: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 id="headerTitle">Welcome</h1>
            <p id="headerSubtitle">Please sign in to continue</p>
            <button class="logout-btn" id="logoutBtn" style="display: none;">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </div>

        <div class="form-container">
            <!-- Login Form -->
            <div class="form-section active" id="loginSection">
                <form id="loginForm">
                    <div class="form-group">
                        <label for="loginEmail">Email Address</label>
                        <input type="email" id="loginEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Password</label>
                        <input type="password" id="loginPassword" required>
                    </div>
                    <button type="submit" class="btn">Sign In</button>
                </form>
                <div class="form-links">
                    <a href="#" id="showRegister">Don't have an account? Sign up</a><br>
                    <a href="#" id="showForgotPassword">Forgot your password?</a>
                </div>
            </div>

            <!-- Register Form -->
            <div class="form-section" id="registerSection">
                <form id="registerForm">
                    <div class="form-group">
                        <label for="registerName">Full Name</label>
                        <input type="text" id="registerName" required>
                    </div>
                    <div class="form-group">
                        <label for="registerEmail">Email Address</label>
                        <input type="email" id="registerEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="registerPassword">Password</label>
                        <input type="password" id="registerPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" id="confirmPassword" required>
                    </div>
                    <button type="submit" class="btn">Create Account</button>
                </form>
                <div class="form-links">
                    <a href="#" id="showLogin">Already have an account? Sign in</a>
                </div>
            </div>

            <!-- Forgot Password Form -->
            <div class="form-section" id="forgotPasswordSection">
                <form id="forgotPasswordForm">
                    <div class="form-group">
                        <label for="forgotEmail">Email Address</label>
                        <input type="email" id="forgotEmail" required>
                    </div>
                    <button type="submit" class="btn">Send Reset Link</button>
                </form>
                <div class="form-links">
                    <a href="#" id="backToLogin">Back to Sign In</a>
                </div>
            </div>

            <!-- Reset Password Form -->
            <div class="form-section" id="resetPasswordSection">
                <form id="resetPasswordForm">
                    <div class="form-group">
                        <label for="resetToken">Reset Token</label>
                        <input type="text" id="resetToken" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" id="newPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmNewPassword">Confirm New Password</label>
                        <input type="password" id="confirmNewPassword" required>
                    </div>
                    <button type="submit" class="btn">Reset Password</button>
                </form>
                <div class="form-links">
                    <a href="#" id="backToLoginFromReset">Back to Sign In</a>
                </div>
            </div>

            <!-- Profile Dashboard -->
            <div class="form-section" id="profileSection">
                <div class="profile-section">
                    <img src="https://via.placeholder.com/120x120/667eea/ffffff?text=User" alt="Profile" class="profile-image" id="profileImage">
                    <div class="profile-name" id="profileName">John Doe</div>
                    <div class="profile-email" id="profileEmail">john@example.com</div>
                    
                    <div class="nav-tabs">
                        <button class="nav-tab active" id="profileTab">Profile</button>
                        <button class="nav-tab" id="updateTab">Update</button>
                    </div>

                    <!-- Profile View -->
                    <div id="profileView">
                        <div class="profile-actions">
                            <button class="btn btn-secondary" id="editProfileBtn">Edit Profile</button>
                            <button class="btn btn-secondary" id="changeImageBtn">Change Photo</button>
                        </div>
                    </div>

                    <!-- Update Profile Form -->
                    <div id="updateView" style="display: none;">
                        <form id="updateProfileForm">
                            <div class="form-group">
                                <label for="updateName">Full Name</label>
                                <input type="text" id="updateName" required>
                            </div>
                            <div class="form-group">
                                <label for="updateEmail">Email Address</label>
                                <input type="email" id="updateEmail" required>
                            </div>
                            <div class="form-group">
                                <label for="updatePhone">Phone Number</label>
                                <input type="tel" id="updatePhone">
                            </div>
                            <div class="file-input-wrapper">
                                <input type="file" id="profileImageInput" class="file-input" accept="image/*">
                                <label for="profileImageInput" class="file-input-label">
                                    <i class="fas fa-camera"></i> Update Photo
                                </label>
                            </div>
                            <button type="submit" class="btn">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // User session simulation
            let currentUser = null;
            let isLoggedIn = false;

            // Show different sections
            function showSection(sectionId) {
                $('.form-section').removeClass('active');
                $('#' + sectionId).addClass('active');
                
                // Update header based on section
                switch(sectionId) {
                    case 'loginSection':
                        $('#headerTitle').text('Welcome Back');
                        $('#headerSubtitle').text('Please sign in to continue');
                        break;
                    case 'registerSection':
                        $('#headerTitle').text('Create Account');
                        $('#headerSubtitle').text('Join us today');
                        break;
                    case 'forgotPasswordSection':
                        $('#headerTitle').text('Forgot Password');
                        $('#headerSubtitle').text('We\'ll send you a reset link');
                        break;
                    case 'resetPasswordSection':
                        $('#headerTitle').text('Reset Password');
                        $('#headerSubtitle').text('Enter your new password');
                        break;
                    case 'profileSection':
                        $('#headerTitle').text('Dashboard');
                        $('#headerSubtitle').text('Manage your account');
                        $('#logoutBtn').show();
                        break;
                    default:
                        $('#logoutBtn').hide();
                }
            }

            // Navigation event handlers
            $('#showRegister').click(function(e) {
                e.preventDefault();
                showSection('registerSection');
            });

            $('#showLogin, #backToLogin, #backToLoginFromReset').click(function(e) {
                e.preventDefault();
                showSection('loginSection');
            });

            $('#showForgotPassword').click(function(e) {
                e.preventDefault();
                showSection('forgotPasswordSection');
            });

            // Profile tabs
            $('#profileTab').click(function() {
                $('.nav-tab').removeClass('active');
                $(this).addClass('active');
                $('#profileView').show();
                $('#updateView').hide();
            });

            $('#updateTab, #editProfileBtn').click(function() {
                $('.nav-tab').removeClass('active');
                $('#updateTab').addClass('active');
                $('#profileView').hide();
                $('#updateView').show();
                
                // Pre-fill form with current data
                if (currentUser) {
                    $('#updateName').val(currentUser.name);
                    $('#updateEmail').val(currentUser.email);
                    $('#updatePhone').val(currentUser.phone || '');
                }
            });

            // Show alert messages
            function showAlert(message, type) {
                const alertClass = type === 'success' ? 'alert-success' : 'alert-error';
                const alertHtml = `<div class="alert ${alertClass}">${message}</div>`;
                $('.form-container').prepend(alertHtml);
                
                setTimeout(() => {
                    $('.alert').fadeOut(function() {
                        $(this).remove();
                    });
                }, 5000);
            }

            // Simulate API call with loading state
            function simulateApiCall(button, callback) {
                button.addClass('loading').text('');
                
                setTimeout(() => {
                    button.removeClass('loading');
                    callback();
                }, 2000);
            }

            // Login form submission
            $('#loginForm').submit(function(e) {
                e.preventDefault();
                const email = $('#loginEmail').val();
                const password = $('#loginPassword').val();
                const button = $(this).find('.btn');
                
                simulateApiCall(button, function() {
                    // Simulate AJAX login
                    $.ajax({
                        url: '/login', // This would be your actual API endpoint
                        method: 'POST',
                        data: {
                            email: email,
                            password: password
                        },
                        xhrFields: {
                            withCredentials: true
                        },
                        success: function(response) {
                            // Simulate successful login
                            currentUser = {
                                name: 'John Doe',
                                email: email,
                                phone: '+1234567890'
                            };
                            isLoggedIn = true;
                            
                            $('#profileName').text(currentUser.name);
                            $('#profileEmail').text(currentUser.email);
                            
                            showAlert('Login successful! Welcome back.', 'success');
                            setTimeout(() => showSection('profileSection'), 1000);
                        },
                        error: function(xhr, status, error) {
                            showAlert('Login failed. Please check your credentials.', 'error');
                        }
                    });
                    
                    // For demo purposes, always succeed
                    currentUser = {
                        name: 'John Doe',
                        email: email,
                        phone: '+1234567890'
                    };
                    isLoggedIn = true;
                    
                    $('#profileName').text(currentUser.name);
                    $('#profileEmail').text(currentUser.email);
                    
                    showAlert('Login successful! Welcome back.', 'success');
                    setTimeout(() => showSection('profileSection'), 1000);
                    
                    button.text('Sign In');
                });
            });

            // Register form submission
            $('#registerForm').submit(function(e) {
                e.preventDefault();
                const name = $('#registerName').val();
                const email = $('#registerEmail').val();
                const password = $('#registerPassword').val();
                const confirmPassword = $('#confirmPassword').val();
                const button = $(this).find('.btn');
                
                if (password !== confirmPassword) {
                    showAlert('Passwords do not match!', 'error');
                    return;
                }
                
                simulateApiCall(button, function() {
                    // Simulate AJAX registration
                    $.ajax({
                        url: '/register',
                        method: 'POST',
                        data: {
                            name: name,
                            email: email,
                            password: password
                        },
                        success: function(response) {
                            showAlert('Account created successfully! Please sign in.', 'success');
                            setTimeout(() => showSection('loginSection'), 2000);
                        },
                        error: function(xhr, status, error) {
                            showAlert('Registration failed. Please try again.', 'error');
                        }
                    });
                    
                    // For demo purposes, always succeed
                    showAlert('Account created successfully! Please sign in.', 'success');
                    setTimeout(() => showSection('loginSection'), 2000);
                    
                    button.text('Create Account');
                });
            });

            // Forgot password form submission
            $('#forgotPasswordForm').submit(function(e) {
                e.preventDefault();
                const email = $('#forgotEmail').val();
                const button = $(this).find('.btn');
                
                simulateApiCall(button, function() {
                    // Simulate AJAX forgot password
                    $.ajax({
                        url: '/api/forgot-password',
                        method: 'POST',
                        data: { email: email },
                        success: function(response) {
                            showAlert('Reset link sent to your email!', 'success');
                            setTimeout(() => showSection('resetPasswordSection'), 2000);
                        },
                        error: function(xhr, status, error) {
                            showAlert('Failed to send reset link. Please try again.', 'error');
                        }
                    });
                    
                    // For demo purposes, always succeed
                    showAlert('Reset link sent to your email!', 'success');
                    setTimeout(() => showSection('resetPasswordSection'), 2000);
                    
                    button.text('Send Reset Link');
                });
            });

            // Reset password form submission
            $('#resetPasswordForm').submit(function(e) {
                e.preventDefault();
                const token = $('#resetToken').val();
                const newPassword = $('#newPassword').val();
                const confirmNewPassword = $('#confirmNewPassword').val();
                const button = $(this).find('.btn');
                
                if (newPassword !== confirmNewPassword) {
                    showAlert('Passwords do not match!', 'error');
                    return;
                }
                
                simulateApiCall(button, function() {
                    // Simulate AJAX reset password
                    $.ajax({
                        url: '/api/reset-password',
                        method: 'POST',
                        data: {
                            token: token,
                            password: newPassword
                        },
                        success: function(response) {
                            showAlert('Password reset successfully! Please sign in.', 'success');
                            setTimeout(() => showSection('loginSection'), 2000);
                        },
                        error: function(xhr, status, error) {
                            showAlert('Password reset failed. Please check your token.', 'error');
                        }
                    });
                    
                    // For demo purposes, always succeed
                    showAlert('Password reset successfully! Please sign in.', 'success');
                    setTimeout(() => showSection('loginSection'), 2000);
                    
                    button.text('Reset Password');
                });
            });

            // Update profile form submission
            $('#updateProfileForm').submit(function(e) {
                e.preventDefault();
                const name = $('#updateName').val();
                const email = $('#updateEmail').val();
                const phonenumber = $('#updatePhone').val();
                const button = $(this).find('.btn');
                
                simulateApiCall(button, function() {
                    // Simulate AJAX update profile
                    $.ajax({
                        url: '/user/profile',
                        method: 'PUT',
                        data: {
                            name: name,
                            email: email,
                            phonenumber: phonenumber
                        },
                        headers: { 'Accept': 'application/json'},
                        xhrFields: {withCredentials: true},
                        success: function(response) {
                            currentUser.name = name;
                            currentUser.email = email;
                            currentUser.phonenumber = phonenumber;
                            
                            $('#profileName').text(name);
                            $('#profileEmail').text(email);
                            
                            showAlert('Profile updated successfully!', 'success');
                        },
                        error: function(xhr, status, error) {
                            showAlert('Failed to update profile. Please try again.', 'error');
                        }
                    });
                    
                    // For demo purposes, always succeed
                    currentUser.name = name;
                    currentUser.email = email;
                    currentUser.phonenumber = phonenumber;
                    
                    $('#profileName').text(name);
                    $('#profileEmail').text(email);
                    
                    showAlert('Profile updated successfully!', 'success');
                    
                    button.text('Update Profile');
                });
            });

            // Profile image upload
            $('#profileImageInput').change(function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#profileImage').attr('src', e.target.result);
                        
                        // Simulate AJAX image upload
                        const formData = new FormData();
                        formData.append('profile_image', file);
                        
                        $.ajax({
                            url: '/api/upload-profile-image',
                            method: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                showAlert('Profile image updated successfully!', 'success');
                            },
                            error: function(xhr, status, error) {
                                showAlert('Failed to upload image. Please try again.', 'error');
                            }
                        });
                        
                        // For demo purposes, always show success
                        showAlert('Profile image updated successfully!', 'success');
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Change image button
            $('#changeImageBtn').click(function() {
                $('#profileImageInput').click();
            });

            // Logout functionality
            $('#logoutBtn').click(function() {
                // Simulate AJAX logout
                $.ajax({
                    url: '/logout',
                    method: 'POST',
                    success: function(response) {
                        currentUser = null;
                        isLoggedIn = false;
                        showAlert('Logged out successfully!', 'success');
                        setTimeout(() => showSection('loginSection'), 1000);
                    },
                    error: function(xhr, status, error) {
                        showAlert('Logout failed. Please try again.', 'error');
                    }
                });
                
                // For demo purposes, always succeed
                currentUser = null;
                isLoggedIn = false;
                showAlert('Logged out successfully!', 'success');
                setTimeout(() => showSection('loginSection'), 1000);
            });

            // Initialize the app
            showSection('loginSection');
        });
    </script>
</body>
</html>