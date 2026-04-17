# Office Management System

## 📌 Overview

The **Office Management System** is a web-based application built with Laravel that helps organizations manage employees, attendance, and tasks efficiently. It provides a centralized platform for administrators and employees to streamline daily operations and improve productivity.

---

## 🚀 Features

### 🔐 Authentication

* Secure login and registration system
* Role-based access (Admin / Employee)
* Middleware protection for routes

### 👥 Employee Management

* Add, update, delete employees
* View employee details
* Assign roles and permissions

### ⏱️ Attendance System

* Check-in / Check-out functionality
* Track working hours
* Prevent duplicate check-ins

### 📋 Task Management

* Admin can create and assign tasks to employees
* Set deadlines for tasks
* Employees receive notifications for new tasks
* Track task status (pending, in progress, completed)

### 🔔 Notifications

* Real-time notifications for task assignments
* Alerts for deadlines

### 📊 Dashboard

* Overview of employees, tasks, and attendance
* Statistics and summaries

---

## 🛠️ Tech Stack

* **Backend:** Laravel (PHP)
* **Frontend:** Blade / AdminLTE
* **Database:** MySQL
* **Authentication:** Laravel Sanctum / Passport

---

## ⚙️ Installation

1. Clone the repository:

```bash
git clone https://github.com/your-username/office-management-system.git
```

2. Navigate to the project directory:

```bash
cd office-management-system
```

3. Install dependencies:

```bash
composer install
npm install
```

4. Copy `.env` file:

```bash
cp .env.example .env
```

5. Generate application key:

```bash
php artisan key:generate
```

6. Configure database in `.env`

7. Run migrations:

```bash
php artisan migrate
```

8. Seed database (optional):

```bash
php artisan db:seed
```

9. Run the server:

```bash
php artisan serve
```

---

## 🔑 Default Credentials (if seeded)

* **Admin:** [admin@example.com](mailto:admin@example.com) / password
* **Employee:** [employee@example.com](mailto:employee@example.com) / password

---

## 📂 Project Structure

```
app/
 ├── Models
 ├── Http/
 │   ├── Controllers
 │   ├── Middleware
 ├── Services
resources/
 ├── views/
routes/
 ├── web.php
 ├── api.php
```

---

## 🧪 Testing

Run tests using:

```bash
php artisan test
```

---

## 📌 Future Improvements

* Mobile application integration
* Advanced reporting system
* Role & permission management enhancements
* Email/SMS notifications

---

## 🤝 Contributing

Contributions are welcome! Please fork the repository and submit a pull request.

---

## 📄 License

This project is open-source and available under the MIT License.

---

## 💡 Notes

* Make sure your PHP version is compatible with Laravel version used.
* Configure queue and notifications for real-time features.

---

## 👩‍💻 Author

Developed by **Basma Elmorsy**
