<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hogwarts School Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color:rgb(9, 9, 9); /* Soft peach background */
        }
        .navbar-brand { 
            font-weight: bold; 
            color: #8b4513 !important; /* Rich brown */
            text-shadow: 1px 1px 2px rgba(255,255,255,0.5);
        }
        .hogwarts-header { 
            background: linear-gradient(135deg, #ffb7c5 0%, #ff69b4 50%, #dda0dd 100%); /* Blossom pink to lavender */
            border-bottom: 3px solid #8b4513; /* Brown accent */
            box-shadow: 0 4px 15px rgba(255, 182, 193, 0.3);
        }
        .sidebar { 
            background: linear-gradient(180deg, #fffaf0 0%, #ffe4e6 100%); /* Soft peach to light pink */
            min-height: 100vh;
            border-right: 2px solid #ffb7c5;
        }
        .sidebar .nav-link { 
            color: #8b4513 !important; /* Brown text */
            font-weight: 500;
            border-radius: 8px;
            margin: 2px 5px;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover { 
            background-color: #ffb7c5 !important; /* Blossom pink */
            color:rgb(164, 28, 139) !important;
            transform: translateX(5px);
        }
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #ff69b4 0%, #dda0dd 100%) !important;
            color:rgb(26, 25, 25) !important;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(255, 105, 180, 0.3);
        }
        .navbar-text {
            color: #8b4513 !important; /* Brown text */
            font-weight: 500;
        }
        .nav-link {
            color: #8b4513 !important; /* Brown text */
            font-weight: 500;
        }
        .nav-link:hover {
            color: #ff69b4 !important; /* Pink on hover */
            transform: scale(1.05);
        }

        /* Custom Card Colors - Japanese Blossom Theme */
        .card.bg-primary { 
            background: linear-gradient(135deg, #ffb7c5 0%, #ff69b4 100%) !important; /* Soft pink to blossom pink */
            border: none;
            box-shadow: 0 4px 15px rgba(255, 182, 193, 0.3);
        }
        .card.bg-success { 
            background: linear-gradient(135deg, #dda0dd 0%, #ba55d3 100%) !important; /* Lavender to orchid */
            border: none;
            box-shadow: 0 4px 15px rgba(221, 160, 221, 0.3);
        }
        .card.bg-warning { 
            background: linear-gradient(135deg, #fffaf0 0%, #ffe4e1 100%) !important; /* Peach to light pink */
            color: #8b4513 !important; /* Brown text */
            border: 2px solid #ffb7c5;
            box-shadow: 0 4px 15px rgba(255, 182, 193, 0.2);
        }
        .card.bg-danger { 
            background: linear-gradient(135deg, #ffd700 0%, #ffec8b 100%) !important; /* Gold to light gold */
            color: #8b4513 !important; /* Brown text */
            border: none;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
        }

        /* Blossom decoration */
        .hogwarts-header::before {
            content: "🌸";
            margin-right: 10px;
            font-size: 1.2em;
        }

        /* Main content area styling */
        main {
            background-color: #fffaf0; /* Soft peach background */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark hogwarts-header">
        <div class="container">
            <a class="navbar-brand" href="index.php">  
                <i class="fas fa-hat-wizard"></i> Hogwarts School Management
            </a>
            <?php if (isset($_SESSION['username'])): ?>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">
                    <i class="fas fa-user"></i> Welcome, <?php echo $_SESSION['username']; ?>!
                </span>
                <a class="nav-link" href="auth-logout.php">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
            <?php endif; ?>
        </div>
    </nav>