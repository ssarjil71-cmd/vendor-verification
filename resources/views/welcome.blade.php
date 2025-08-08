<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Vendor Secure</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --accent-color: #2e59d9;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--secondary-color);
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-image: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        }
        
        .welcome-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 3rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }
        
        h1 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 2rem;
            font-size: 2.5rem;
            position: relative;
            display: inline-block;
        }
        
        h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--accent-color);
            border-radius: 2px;
        }
        
        .login-options {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 3rem;
            flex-wrap: wrap;
        }
        
        .login-card {
            width: 280px;
            padding: 2rem;
            border-radius: 8px;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-color);
        }
        
        .login-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }
        
        .login-btn {
            display: inline-block;
            padding: 0.8rem 2rem;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 1.5rem;
            border: 2px solid var(--primary-color);
        }
        
        .login-btn:hover {
            background-color: white;
            color: var(--primary-color);
            transform: translateY(-2px);
        }
        
        .description {
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        footer {
            margin-top: 3rem;
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>Welcome To Vendor Secure</h1>
        <p class="description">A secure platform for managing and verifying vendor credentials. </p>
        
        <div class="login-options">
            <div class="login-card">
                <div class="login-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h3>Admin Portal</h3>
                <p>Access the administrative dashboard to manage system settings and verify vendors.</p>
                <a href="{{ route('admin.login') }}" class="login-btn">Admin Login</a>
            </div>
            
            <div class="login-card">
                <div class="login-icon">
                    <i class="fas fa-building"></i>
                </div>
                <h3>Company Portal</h3>
                <p>For registered companies to submit documents and track verification status.</p>
                <a href="{{ route('company.login') }}" class="login-btn">Company Login</a>
            </div>
        </div>
        
        <footer>
            &copy; {{ date('Y') }} Vendor Secure by Sarjil Shaikh. All rights reserved.
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>