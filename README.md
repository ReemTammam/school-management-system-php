Hogwarts Middle School Management System 
📌 Overview

The Hogwarts Middle School Performance and Records System is a full-stack web application built using PHP and MySQL to manage students, teachers, classes, and academic records. The system enables school administrators and teachers to efficiently track performance, attendance, discipline, and enrollment through a centralized platform.

This project was developed as part of CMPS 460: Database Management Systems.

🎯 Features

📊 Dashboard with key statistics (students, professors, classes, GPA)

👨‍🎓 Student management (GPA, preferences, discipline tracking)

👩‍🏫 Teacher/professor management

📚 Class management system

📝 Enrollment tracking (student ↔ class relationships)

⚠️ Discipline logging system

📅 Absence tracking system

🔐 Secure login system with role-based access

✏️ Full CRUD operations (Insert, Update, Delete)

🧠 Database Design

The system is designed using a relational database in Third Normal Form (3NF) to eliminate redundancy and ensure data integrity .

Core Tables:

Students – stores student information (GPA, grade, preferences, discipline count)

Professors – stores teacher data (subjects, experience, salary)

Class – defines courses and links to professors

Enrollment – many-to-many relationship between students and classes

Discipline_Log – tracks behavioral incidents

Absences – records student absences efficiently

Users – handles authentication and system access

⚙️ Technologies Used

Frontend: HTML, CSS (Bootstrap), JavaScript

Backend: PHP

Database: MySQL (PDO)

Other Tools: Font Awesome, Chart.js

🔐 Security Features

Session-based authentication

Input sanitization to prevent injection attacks

Role-based access control:

Admin: full system access

Teacher: restricted access to assigned data

📂 Project Structure
.
├── index.php
├── auth-login.php
├── auth-logout.php
├── config-database.php
├── includes/
│   ├── header.php
│   ├── navigation.php
│   └── footer.php
├── insert-*.php
├── edit-*.php
└── database/
▶️ How to Run

Clone the repository:

git clone https://github.com/YOUR_USERNAME/school-management-system-php.git

Import the database:

Open MySQL / phpMyAdmin

Import the provided .sql file

Configure database connection:

Update credentials in config-database.php

Run the project:

Use XAMPP / WAMP / MAMP

Place project in htdocs

Visit:

http://localhost/school-management-system-php
