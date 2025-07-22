# 📦 POS Management System

A Laravel‑based Point of Sales (POS) system with role-based access control designed for retail environments.

---

## 📚 Table of Contents

1. [Overview](#overview)  
2. [Features](#features)  
3. [User Roles & Permissions](#user-roles--permissions)  
4. [Tech Stack](#️-tech-stack)  
5. [Installation](#installation)  

---

## 📖 Overview

The POS Management System facilitates inventory management, sales tracking, and secure access across different staff levels. It's built with Laravel (PHP), Tailwind CSS, and Vanilla JavaScript.

---

## ✨ Features

- Product & Category Management  
- Order creation & tracking  
- Role-based access with RBAC  
- Comprehensive logs of actions & events  
- User authentication & authorization  
- Clean UI using Tailwind CSS  

---

## 🔐 Authentication & Authorization

This project uses **Laravel's built-in authentication** with custom **Authorization Policies** to control access at a granular level.

- **Authentication**: Uses Laravel session-based login system (custom login/register or Laravel Breeze, depending on your setup).
- **Authorization**: Implemented through Laravel **Policies** to ensure role-based actions such as:
  - Only **Super Administrators** can delete products/categories and view logs.
  - Only **Admins** and **Super Admins** can edit products and categories.
  - Only **Users (Staff)** can add orders.
  - All sensitive actions are protected using `Gate` or `Policy` checks (e.g., `$this->authorize('delete', $product)`).

➡️ Policy classes are located in `app/Policies/`, and linked via `AuthServiceProvider`.

- All permission checks are enforced via **Laravel Policies**, ensuring secure and scalable access control.
- Example: A `ProductPolicy.php` file contains logic like:
  ```php
  public function delete(User $user, Product $product)
  {
      return $user->role === 'super_admin';
  }

---

## 🛠️ Tech Stack

| Layer              | Technologies |
|--------------------|--------------|
| **Backend**        | ![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white) ![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white) |
| **Frontend**       | ![HTML](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white) ![CSS](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white) ![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white) ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black) |
| **Database**       | ![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white) |
| **Authorization** | ![Laravel Policies](https://img.shields.io/badge/Laravel_Policies-6D28D9?style=for-the-badge&logo=laravel&logoColor=white) ![Gates](https://img.shields.io/badge/Gates-FF9F00?style=for-the-badge&logo=laravel&logoColor=white) |
| **Version Control**| ![Git](https://img.shields.io/badge/Git-F05032?style=for-the-badge&logo=git&logoColor=white) ![GitHub](https://img.shields.io/badge/GitHub-121013?style=for-the-badge&logo=github&logoColor=white) |
| **Package Managers** | ![Composer](https://img.shields.io/badge/Composer-885630?style=for-the-badge&logo=composer&logoColor=white) ![NPM](https://img.shields.io/badge/NPM-CB3837?style=for-the-badge&logo=npm&logoColor=white) |

---

## 🧰 Installation

1. **Clone the repo**  
   ```bash
   git clone https://github.com/jcsoliman07/POSManagementSystem.git
   cd POSManagementSystem
