# Advanced TodoList (Laravel Blade + Bootstrap) ✅

An **advanced, production-ready TodoList** built with **Laravel Blade** and **Bootstrap CSS**.  
It supports full **CRUD**, task **priorities**, **due dates**, **statuses**, **categories**, **search & filters**, **pagination**, and **auth** for a smooth personal productivity workflow.

---

## Features ✨
- **Authentication** (login/register/logout) using Laravel Auth
- **Tasks CRUD** (create, read, update, delete)
- **Task fields:** title, description, category, priority, status, due date
- **Smart filters:** by status, priority, category, due date range
- **Search:** quick keyword search on title/description
- **Pagination** on listing pages
- **Sortable** columns (e.g., priority, due date, created at)
- **Soft deletes** with Trash/Restore
- **Notifications/flash messages** for actions
- **Responsive UI** with Bootstrap
- **Reusable Blade components** and layouts
- **Form validation** (server-side)

---

## Tech Stack
- **Framework:** Laravel (10.x or latest)
- **Views:** Laravel Blade
- **UI:** Bootstrap (via Vite)
- **DB:** SQLite
- **Build:** Vite
- **Auth:** Laravel Breeze/UI/Default Auth (choose one in your project)

---

## Installation

### Prerequisites
- PHP (>= 8.1)
- Composer
- Node.js & npm
- MySQL (or SQLite)
- Git




### Steps  

1. **Clone the Repository**  
   ```bash
   git clone <YOUR_REPOSITORY_URL>
2. **Navigate the project directory**     
     ```bash
    cd Inventory-Management-System
3. **Install Dependencies**
   ```bash
    composer install
4. **Create and Configure Environment File**    
   ```bash
    cp .env.example .env
5. **Generate Application Key**
   ```bash
   php artisan key:generate
6. **Run Migrations**
   ```bash
   php artisan migrate
7. **Run Server**
   ```bash
   php artisan serve

The app will be available at: http://localhost:8000

8. **API Authentication**
Use Laravel Sanctum / Passport / JWT tokens to authenticate API requests.

**Contact**

LinkedIn: Abenezer Sileshi

Gmail: abinesilew@gmail.com

Telegram: @Aben14i
