<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    
                    <!-- Student Management -->
                    <li class="nav-item">
                        <a class="nav-link" href="edit-students.php">
                            <i class="fas fa-users"></i> View Students
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="insert-students.php">
                            <i class="fas fa-user-plus"></i> Add Student
                        </a>
                    </li>
                    
                    <!-- Professor Management -->
                    <li class="nav-item">
                        <a class="nav-link" href="edit-professors.php">
                            <i class="fas fa-chalkboard-teacher"></i> View Professors
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="insert-professors.php">
                            <i class="fas fa-user-tie"></i> Add Professor
                        </a>
                    </li>
                    
                    <!-- Class Management -->
                    <li class="nav-item">
                        <a class="nav-link" href="edit-class.php">
                            <i class="fas fa-book"></i> View Classes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="insert-class.php">
                            <i class="fas fa-plus-circle"></i> Add Class
                        </a>
                    </li>
                    
                    <!-- Enrollment Management -->
                    <li class="nav-item">
                        <a class="nav-link" href="insert-enrollment.php">
                            <i class="fas fa-clipboard-list"></i> Manage Enrollment
                        </a>
                    </li>
                    
                    <!-- Attendance & Discipline -->
                    <li class="nav-item">
                        <a class="nav-link" href="edit-absences.php">
                            <i class="fas fa-calendar-check"></i> Absence Records
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="edit-discipline.php">
                            <i class="fas fa-exclamation-triangle"></i> Discipline Log
                        </a>
                    </li>
                </ul>
                
                <!-- User Info Section -->
                <div class="mt-5 p-3 small" style="color: #8b4513; background: linear-gradient(135deg, #fffaf0 0%, #ffe4e6 100%); border-radius: 10px; border: 1px solid #ffb7c5;">
                    <?php if (isset($_SESSION['username'])): ?>
                    <h6 style="color: #8b4513; font-weight: bold;">
                        <i class="fas fa-user-circle"></i> Logged in as:
                    </h6>
                    <p class="mb-1" style="color: #8b4513; font-weight: 500;">
                        <?php echo $_SESSION['username']; ?>
                    </p>
                    <p class="mb-0" style="color: #8b4513; font-weight: 500;">
                        Role: <?php echo $_SESSION['role']; ?>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
        </nav>