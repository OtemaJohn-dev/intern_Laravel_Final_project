
<div style="display: flex; justify-content: center; align-items: center; height: 90vh; background: linear-gradient(135deg, #1abc9c, #3498db);">
    <div style="background: #fff; padding: 40px; border-radius: 15px; box-shadow: 0px 10px 25px rgba(0,0,0,0.2); width: 100%; max-width: 500px; animation: fadeIn 1s ease-in-out;">
        <h1 style="text-align: center; color: #2c3e50; font-size: 2.5rem;">Cancer Institute Uganda</h1>
        <h2 style="text-align: center; color: #16a085; margin-bottom: 30px; font-size: 1.5rem;">Administrator Access Page</h2>

        @if(session('error'))
            <div style="color: #e74c3c; text-align: center; margin-bottom: 15px; font-weight: bold;">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.verify') }}" style="animation: slideIn 1s ease;">
            @csrf
            <div style="margin-bottom: 20px;">
                <label for="email" style="display: block; margin-bottom: 5px; color: #34495e;">Email Address</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required
                    style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc; transition: border 0.3s;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="password" style="display: block; margin-bottom: 5px; color: #34495e;">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required
                    style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc; transition: border 0.3s;">
            </div>

            <div style="text-align: center;">
                <button type="submit" id="loginBtn"
                    style="background: #3498db; color: #fff; padding: 12px 30px; border: none; border-radius: 8px; cursor: pointer; font-size: 1rem; transition: all 0.3s ease;">
                    Proceed to Admin Control Page
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.style.border = "2px solid #16a085";
        });
        input.addEventListener('blur', () => {
            input.style.border = "1px solid #ccc";
        });
    });

    const loginBtn = document.getElementById('loginBtn');
    loginBtn.addEventListener('click', function () {
        loginBtn.style.transform = "scale(0.95)";
        setTimeout(() => {
            loginBtn.style.transform = "scale(1)";
        }, 150);
    });
</script>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @media (max-width: 100px) {
        h1 {
            font-size: 2rem;
        }
        h2 {
            font-size: 1.2rem;
        }
        div[style*="padding: 40px"] {
            padding: 30px 20px !important;
        }
    }
</style>

