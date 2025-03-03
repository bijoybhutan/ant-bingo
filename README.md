# 🎉 Bingo Game  

This is a simple **Bingo Game** built with **HTML, JavaScript (Vanilla JS), and PHP (with MySQL)**. The game allows players to register, generate a Bingo card, call numbers, mark them, save their score dynamically, and view the leaderboard.

---

## 🚀 Features  
✅ **User Registration** – Players enter their name and register before playing.  
✅ **Bingo Card Generation** – A randomized 5x5 Bingo card is generated with a free space in the center.  
✅ **Number Calling** – Random numbers are called, and players can mark them if available on their card.  
✅ **Score Calculation** – Score is calculated as:
```math
score = abs(100 - <number of call button presses>)
```
✅ **Persistence** – Game state (player, card, called numbers) is stored in `localStorage` to allow refreshing the page without losing progress.  
✅ **Leaderboard** – Player scores are stored in a MySQL database.  

---

## 🛠️ Installation & Setup  

### **1️⃣ Prerequisites**  
- ✅ **XAMPP or WAMP Installed**  
- ✅ **PHP & MySQL Enabled**  
- ✅ **A Web Browser (Chrome, Firefox, Edge, etc.)**  

### **2️⃣ Start Apache & MySQL**  
1. Open **XAMPP Control Panel** (or **WAMP**).  
2. Start the `Apache` and `MySQL` services.  

### **3️⃣ Database Setup**  
1. Open **phpMyAdmin** in your browser:  
   ```
   http://localhost/phpmyadmin
   ```
2. Create a new database called **bingo**.  
3. Run the following SQL script to create the necessary tables:  

```sql
CREATE DATABASE bingo;

USE bingo;

CREATE TABLE `called_numbers` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `number` INT(11) NOT NULL,
    `called_at` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`),
    UNIQUE INDEX `number` (`number`)
) ENGINE=InnoDB;

CREATE TABLE `players` (
    `id` INT(5) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `current_score` INT(10) DEFAULT NULL,
    `created_on` DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `player_history` (
    `id` INT(5) NOT NULL AUTO_INCREMENT,
    `player_id` INT(5) NOT NULL,
    `score` INT(5) NOT NULL,
    `date` DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `player_id` (`player_id`),
    FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB;
```

### **4️⃣ Configure the Backend (PHP & MySQL)**  

1. Open the **XAMPP/WAMP `htdocs` folder** (usually found at `C:\xampp\htdocs\` or `C:\wamp\www\`).  
2. Create a new folder called **bingo** and place all project files inside it.  
3. Open the **`connection.php`** file and ensure the credentials match your MySQL setup:  

```php
<?php
// db.php
$host = 'localhost';
$db   = 'bingo';
$user = 'root';
$pass = ''; // Default XAMPP/WAMP password is empty

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
```

⚠ **Note:** If your MySQL has a password (`root` or something else), update the `$pass` variable accordingly.

### **5️⃣ Run the Application**  

1. Open your browser and go to:  
   ```
   http://localhost/bingo/bingo.html
   ```
2. Register a player, generate a Bingo card, and start playing! 🎉  

---

## 📜 API Endpoints  

### 🔹 **Register a Player**  
- **Endpoint:** `POST /api/register-player.php`  
- **Payload:**  
  ```json
  { "name": "John Doe" }
  ```
- **Response:**  
  ```json
  { "player_id": 1 }
  ```

### 🔹 **Call a Number**  
- **Endpoint:** `GET /api/call-number.php`  
- **Response:**  
  ```json
  { "number": 45 }
  ```

### 🔹 **Save Score**  
- **Endpoint:** `POST /api/save-score.php`  
- **Payload:**  
  ```json
  { "player_id": 1, "score": 90 }
  ```
- **Response:**  
  ```json
  { "success": "Score saved" }
  ```

### 🔹 **Leaderboard**  
- **Endpoint:** `GET /api/leaderboard.php`  
- **Response:** Returns the top players and their scores.  

### 🔹 **Reset Game**  
- **Endpoint:** `POST /api/reset-game.php`  
- **Response:** Clears the game state and resets all called numbers.  

---

## 🛠 Troubleshooting  

| Issue | Solution |
|--------|---------|
| Database connection error | Ensure MySQL is running and database credentials are correct in `database/connection.php`. |
| 404 Not Found | Ensure files are inside `htdocs/bingo` (XAMPP) or `www/bingo` (WAMP). |
| Numbers not being called | Check API endpoints (`call-number.php`, `save-score.php`) in the console log. |

---

## 📜 License  
This project is for test purpose.

---

That's it! 🎯 Your **Bingo Game** should now be running smoothly in XAMPP/WAMP. 🚀 Let me know if you need any help!

