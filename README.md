 🛒 Superstore Inventory Management System

A simple PHP + MySQL project to manage product inventory with user login.

 ✨ Features

- Admin and User login
- Add, edit, delete products (admin only)
- View inventory list
- Search and filter products
- Low stock alerts (quantity < 5)
- Responsive and modern UI

 👥 User Roles

- Admin: Can add, edit, delete products and register users
- User: Can only view products

 🔧 Setup

1. Import the `superstoredb.sql` to your MySQL server
2. Place the project folder inside `htdocs` (for XAMPP)
3. Update your `db.php` file if needed
4. Start Apache and MySQL
5. Visit: http://localhost/superstore-min/login.php

 🔐 Login Credentials

- Admin  
  Username: admin  
  Password: admin

- User  
  Username: staff  
  Password: staff

 📁 Folder Structure

- index.php – Dashboard  
- login.php – Login form  
- add_product.php, edit_product.php, delete_product.php  
- register_user.php – Add new users  
- assets/ – Contains style.css, background images, etc.

