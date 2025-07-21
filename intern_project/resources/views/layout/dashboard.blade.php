<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Cancer Institute Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        #sidebar {
            width: 250px;
            height: 100vh;
            background-color: #f8f9fa;
            border-right: 1px solid #ddd;
        }
        .sidebar-link {
            cursor: pointer;
        }
        .sidebar-link.active {
            background-color: #0d6efd;
            color: white;
        }
        #main-content {
            padding: 20px;
            flex-grow: 1;
            background-color: #fff;
            height: 100vh;
            overflow-y: auto;
        }
        .dashboard-section {
            display: none;
        }
        .dashboard-section.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <nav id="sidebar" class="d-flex flex-column p-3">
            <h4 class="mb-4">Cancer Institute</h4>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item sidebar-link active" data-section="access-section">
                    <a href="access">ACCESS PAGE FOR STAKER HOLDERS</a>
                </li>
                
            </ul>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger mt-auto">Logout</button>
            </form>
        </nav>

        
    </div>

    @yield('content')

    <script>
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.addEventListener('click', () => {
               
                document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
                
                document.querySelectorAll('.dashboard-section').forEach(sec => sec.classList.remove('active'));

                
                link.classList.add('active');

                
                const sectionId = link.getAttribute('data-section');
                document.getElementById(sectionId).classList.add('active');
            });
        });
    </script>
</body>
</html>
