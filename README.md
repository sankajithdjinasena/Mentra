# 🌿 Mentra – AI-Powered Study Companion

**Mentra** is an intelligent EdTech platform designed to help students learn smarter, stay focused, and achieve their academic goals. By combining productivity tools, AI-driven assistance, and gamification, Mentra creates a personalized and engaging learning experience.

---

## 📌 Problem Statement

Students often struggle with:

* Poor time management and lack of structured study plans
* Low motivation and procrastination
* Limited access to personalized academic support
* Difficulty tracking progress and maintaining consistency
* Lack of interactive and engaging learning environments

Traditional learning tools fail to provide real-time assistance, personalization, and motivation needed for modern students.

---

## 💡 Proposed Solution

**Mentra** addresses these challenges by offering:

* 🧠 **AI-Powered Learning Assistant** – Provides personalized study guidance and motivation
* ⏱️ **Smart Study Tracking** – Logs study time and generates progress reports
* 📋 **Task & Goal Management** – Helps organize and prioritize study tasks
* 🔔 **Automated Reminders** – Keeps students on track with email notifications
* 💬 **Community Q&A Platform** – Enables peer-to-peer learning and discussion
* 🎯 **Gamification System** – Rewards consistency with points, badges, and leaderboards
* 🎶 **Focus-Based Recommendations** – Suggests music/content to improve concentration
* 😴 **Wellness Insights** – Sleep and study habit suggestions for better productivity

---

## 👥 Team Details

**Project Name:** Mentra
**Domain:** Education Technology (EdTech) & Generative AI
**Team Name:** Predictra
**Team Members:**

* Sankajith D. Jinasena
* P.M.Sanodya V. Jinadasa
* S. Nasmath Leen
* T. Kugashanth

**University:**

* Sabaragamuwa University of Sri Lanka

---

## 🛠️ Technology Stack

### 🔹 Backend

* Laravel (PHP)

### 🔹 Frontend

* HTML, CSS, JavaScript
* Blade Template Engine
* Bootstrap

### 🔹 AI Integration

* Python (Flask)
* OpenAI API

### 🔹 Database

* MySQL

### 🔹 Additional Tools

* Chart.js (data visualization)
* Font Awesome (UI icons)
* Mail Notifications (email reminders)

---

## 🏗️ Architecture Overview

```
User Interface (Blade + Bootstrap)
           ↓
Laravel Backend (API + Logic)
           ↓
MySQL Database
           ↓
Flask AI Service (OpenAI Integration)
```

* **Laravel** handles authentication, task management, and system logic
* **Flask AI service** processes intelligent responses and recommendations
* **MySQL** stores user data, progress, and activities
* Communication between Laravel and Flask is done via API calls

---

## ✨ Key Features

* ✅ To-Do Task Manager
* ⏰ Study Time Logging & Analytics
* 🔔 Email Reminders
* 🤖 AI Motivation System
* 💬 Community Q&A
* 🧠 Chatbot Assistant
* 🥇 Leaderboard & Rewards
* 🎶 Smart Focus Media
* 📚 Study Resources
* 😴 Sleep Insights
* 📩 Feedback System

---

## 🚀 Getting Started

### 📦 Clone the Repository

```bash
git clone https://github.com/sankajithdjinasena/Mentra.git
cd mentra
```

---

### ⚙️ Laravel Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

---

### 🔐 Environment Configuration

Update the `.env` file with:

* Database credentials
* Mail configuration

---

## 📩 Feedback

We welcome your suggestions to improve Mentra!
Feel free to submit feedback through the platform.
