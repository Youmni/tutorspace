# TutorSpace

## Overview
TutorSpace is a community-driven learning platform that connects students and tutors to enhance the learning experience.

---

## Functions

### Admin

#### Institutions
- **Add an Institution:**  
  Admins can add new institutions to the TutorSpace platform, broadening the available learning network.  
- **Update or Delete an Institution:**  
  Admins can update the details of existing institutions or remove them as needed.

#### Courses
- **Add a Course:**  
  Admins can create new courses under specific institutions, expanding the range of learning opportunities.  
- **Update or Delete a Course:**  
  Admins can update course details or remove courses that are no longer relevant.

#### Users
- **View User Information:**  
  Admins can access detailed user profiles, including the courses they are tutoring.  
- **Manually Create Users:**  
  Admins can manually create user accounts for better control over platform access.

#### Announcements
- **Create Announcements:**  
  Admins can create announcements to share important updates or information with users.  
- **Update Announcements:**  
  Admins can update existing announcements to ensure users are informed of any changes.  
- **Delete Announcements:**  
  Admins can delete outdated or irrelevant announcements from the platform.

#### FAQ Management
- **Add FAQ Categories and Questions:**  
  Admins can create new FAQ categories and add questions to assist users with common queries.  
- **Update or Remove FAQ Categories and Questions:**  
  Admins can modify or delete outdated FAQ categories and questions to maintain the accuracy of information.

---

### User

#### Courses
- **View Courses:**  
  Users can browse and view available courses to find relevant learning opportunities. They can also contact tutors for more information.
- **Become a Tutor:**  
  Users can apply to become a tutor for specific courses offered by certain institutions.

#### Announcements
- **View Announcements:**  
  Users can view the latest announcements from the platform to stay informed about updates and changes.

#### FAQ
- **View FAQ:**  
  Users can access the FAQ section for helpful information and answers to common questions.

#### Contact
- **Email Support:**  
  Users can contact the TutorSpace administrators via email to report issues or provide feedback and suggestions.

---

## Installation

### Requirements
- **PHP** (version 8 or higher)
- **Node.js** (version 20 or higher)
- **Windows Subsystem for Linux (WSL)** (if on Windows)
- **MySQL** (or another database of your choice)
- **Composer** (for managing PHP dependencies)
- **Webserver** (e.g., Apache, Nginx, or PHP's built-in server)

### Setup Instructions

1. **Clone the project from GitHub**:
   - Clone the repository to your local machine using:
     ```bash
     git clone <repository-url>
     ```

2. **Navigate to the project directory**:
   - Go to the `/tutorspace` directory:
     ```bash
     cd tutorspace
     ```

3. **Install PHP dependencies**:
   - Run Composer to install the necessary PHP dependencies:
     ```bash
     composer install
     ```

4. **Create the `.env` file**:
   - Copy the example environment file and update it with your database credentials and email information (including `MAIL_ADMIN_ADDRESS`):
     ```bash
     cp .env.example .env
     ```
   - Edit the `.env` file and configure the following:
     - **Database connection**: Set your `DB_*` variables (e.g., `DB_CONNECTION`, `DB_HOST`, `DB_DATABASE`, etc.).
     - **Mail configuration**: Set the `MAIL_*` variables, including `MAIL_ADMIN_ADDRESS`.

5. **Generate the application key**:
   - Laravel requires an application key for secure encryption. Generate it using:
     ```bash
     php artisan key:generate
     ```

6. **Install Node.js dependencies**:
   - Run the following command to install frontend dependencies:
     ```bash
     npm install
     ```

7. **Build the frontend assets**:
   - Build the assets for production using:
     ```bash
     npm run build
     ```

8. **Run database migrations (with optional seeders)**:
   - Set up the database by running migrations, and optionally, seed the database with:
     ```bash
     php artisan migrate:fresh --seed
     ```

9. **Start the development servers**:
   - Run the PHP and Node.js development servers to start the application locally:
     ```bash
     php artisan serve && npm run dev
     ```

After completing these steps, your application should be set up and running locally. You can now access it via the provided local server URL (typically `http://localhost:8000`).

---

## Technologies
1. **Laravel**: Used for building the backend and frontend of the application.
2. **MySQL**: Used for managing the database.
3. **Tailwind CSS**: Used for styling.

---

## Sources
- [Chart.js - YouTube Tutorial](https://youtu.be/Bb2n7RlgGVM?si=VQAMiiGg_ZPaXt-M)
- [Chart.js Documentation - W3Schools](https://www.w3schools.com/ai/ai_chartjs.asp)

## Extra information
Some of the CSS was done directly with Copilot.  

## Author
- [@Youmni Malha](https://github.com/Youmni)

---
