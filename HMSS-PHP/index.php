<?php
require_once 'config-database.php';
require_once 'includes-security.php';

// Redirect to login if not logged in
if (!isLoggedIn()) {
    header("Location: auth-login.php");
    exit();
}
?>

<?php include 'includes-header.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php include 'includes-navigation.php'; ?>
        
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Hogwarts School Dashboard</h1>
            </div>

            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="card-title">
                                        <?php
                                        $database = new Database();
                                        $db = $database->getConnection();
                                        $result = $db->query("SELECT COUNT(*) FROM students")->fetchColumn();
                                        echo $result;
                                        ?>
                                    </h4>
                                    <p class="card-text">Total Students</p>
                                </div>
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="card-title">
                                        <?php
                                        $result = $db->query("SELECT COUNT(*) FROM professors")->fetchColumn();
                                        echo $result;
                                        ?>
                                    </h4>
                                    <p class="card-text">Professors</p>
                                </div>
                                <i class="fas fa-chalkboard-teacher fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="card-title">
                                        <?php
                                        $result = $db->query("SELECT COUNT(*) FROM class")->fetchColumn();
                                        echo $result;
                                        ?>
                                    </h4>
                                    <p class="card-text">Classes</p>
                                </div>
                                <i class="fas fa-book fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-4">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="card-title">
                                        <?php
                                        $result = $db->query("SELECT AVG(GPA) FROM students")->fetchColumn();
                                        echo number_format($result, 2);
                                        ?>
                                    </h4>
                                    <p class="card-text">Average GPA</p>
                                </div>
                                <i class="fas fa-chart-line fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
                        <!-- Quick Actions -->
                        <div class="row mt-4">
                <div class="col-12">
                    <h4 class="mb-4" style="color: #8b4513; border-bottom: 2px solid #ffb7c5; padding-bottom: 10px;">
                        <i class="fas fa-seedling"></i> Quick Actions
                    </h4>
                    <div class="d-grid gap-2 d-md-flex">
                        <a href="insert-students.php" class="btn me-md-2" style="
                            background: linear-gradient(135deg, #ffb7c5 0%, #ff69b4 100%);
                            color: white;
                            border: none;
                            padding: 12px 25px;
                            border-radius: 25px;
                            font-weight: 600;
                            box-shadow: 0 4px 15px rgba(255, 182, 193, 0.4);
                            transition: all 0.3s ease;
                        ">
                            <i class="fas fa-user-plus"></i> Add New Student
                        </a>
                        <a href="insert-class.php" class="btn me-md-2" style="
                            background: linear-gradient(135deg, #dda0dd 0%, #ba55d3 100%);
                            color: white;
                            border: none;
                            padding: 12px 25px;
                            border-radius: 25px;
                            font-weight: 600;
                            box-shadow: 0 4px 15px rgba(221, 160, 221, 0.4);
                            transition: all 0.3s ease;
                        ">
                            <i class="fas fa-plus-circle"></i> Add New Class
                        </a>
                        <a href="insert-enrollment.php" class="btn" style="
                            background: linear-gradient(135deg, #ffd700 0%, #ffec8b 100%);
                            color: #8b4513;
                            border: none;
                            padding: 12px 25px;
                            border-radius: 25px;
                            font-weight: 600;
                            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
                            transition: all 0.3s ease;
                        ">
                            <i class="fas fa-clipboard-list"></i> Manage Enrollment
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="row mt-5">
                <div class="col-12">
                    <h4>Recent Students</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Grade</th>
                                    <th>GPA</th>
                                    <th>Favorite Subject</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $db->query("SELECT StudID, FName, LName, Grade, GPA, FavSubject FROM students LIMIT 5");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['StudID'] . "</td>";
                                    echo "<td>" . $row['FName'] . " " . $row['LName'] . "</td>";
                                    echo "<td>Grade " . $row['Grade'] . "</td>";
                                    echo "<td>" . $row['GPA'] . "</td>";
                                    echo "<td>" . $row['FavSubject'] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include 'includes-footer.php'; ?>