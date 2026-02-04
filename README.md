# ☕ Cafe POS System (Laravel 11)

A specialized Point of Sale (POS) application tailored for coffee shops, featuring multi-pricing support (Hot/Cold/Blended) and a seamless AJAX-driven user experience.

## 🔑 Key Features
* **Dynamic Pricing Models:** Database schema designed to support variant pricing for different drink types (Hot, Cold, Blended).
* **AJAX Status Management:** Real-time "Active/Inactive" product toggling using **jQuery & AJAX**, providing instant feedback without page reloads.
* **Efficient Order Processing:** The `SaleController` handles bulk orders via JSON payloads, ensuring fast transaction recording.
* **Hybrid Interface:**
  * **Storefront:** Modern landing page styled with **Tailwind CSS**.
  * **Admin Panel:** Robust dashboard built with **Bootstrap 4**.
* **Data Integrity:** Used **Eloquent Relationships** to maintain consistency between Categories and Products.
* **Secure Access:** Built-in authentication system for staff members.

## 🛠️ Tech Stack
* **Backend:** PHP 8.2, Laravel 11
* **Database:** SQLite
* **Frontend:** Blade Templates, Bootstrap 4, Tailwind CSS, jQuery
