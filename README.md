# RTC Case Management Tracking System

## Table of Contents
1. [Introduction](#introduction)
2. [System Requirements](#system-requirements)
3. [Installation](#installation)
4. [Modules Overview](#modules-overview)
5. [Messages](#messages)
6. [Conclusion](#conclusion)

---

## Introduction
The **Regional Trial Court Case Management Tracking System** is designed to improve case management processes at the Hall of Justice in Iloilo City. This system digitizes data and centralizes management for accused individuals, cases, hearings, violations, documents, and system users.

---

## System Requirements

### Hardware Requirements:
- Processor: Intel i3 or higher
- RAM: 4GB minimum
- Hard Drive: 2GB free space minimum
- Monitor: 1024x768 resolution or higher

### Software Requirements:
- Operating System: Windows 10 or Linux-based OS
- Web Browser: Google Chrome or Mozilla Firefox (latest version)
- Server: Apache, MySQL, PHP (latest versions)
- PHP Version: 7.4 or higher
- Database: MySQL

---

## Installation
To install the system, follow these steps:

1. **Download and Install XAMPP:**
   - Download the latest version of XAMPP from [https://www.apachefriends.org/](https://www.apachefriends.org/).
   - Install XAMPP on your local machine and ensure Apache and MySQL services are running.

2. **Clone the Git Repository:**
   - Clone the project repository using:
     ```bash
     git clone https://github.com/PhageHagane/rtc-cms.git
     ```
   - Place the cloned repository in the `htdocs` directory of your XAMPP installation.

3. **Create and Import the Database:**
   - Open phpMyAdmin by navigating to `http://localhost/phpmyadmin`.
   - Create a new database named `rtccmsdb`.
   - Import the database file (`rtccmsdb.sql`) provided in the repository.

4. **Configure the Connection File:**
   - Navigate to the `includes` directory of the project folder.
   - Duplicate the `conn.php.example` file and rename it to `conn.php`.
   - Open `conn.php` and set the following values:
     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $database = "rtccmsdb";
     ```

5. **Start the Server:**
   - Open the XAMPP Control Panel and start the Apache and MySQL services.

6. **Access the System:**
   - Open a browser and navigate to `http://localhost/rtc-cms`.

### Demo Credentials

**Admin:** admin  
**Password:** secret

**Operator:** operator  
**Password:** secret

---

## Modules Overview

### **Accused Management**
- Add, update, or delete accused records.

### **Case Management**
- Manage cases, including adding, updating, and deleting cases.

### **Document Management**
- Upload, view, and delete documents associated with cases.

### **Hearing Management**
- Schedule and update hearings.

### **User Management** (Admin Only)
- Manage system users, including adding, updating, and deleting users.

### **Violation List**
- Manage violations, including adding, updating, and deleting violation records.

---

## Messages

### **Error Messages**
- **"Error: Unable to add accused. Please check the required fields."**
  - Ensure all mandatory fields are filled before submitting.

- **"Error: Duplicate National ID detected."**
  - Enter a unique National ID and retry.

### **Status Messages**
- **"Record saved successfully."**
  - Confirms that data has been saved correctly.

- **"Accused added successfully."**
  - Indicates the successful creation of a new accused record.

### **Information Messages**
- **"No records found for your search."**
  - Adjust search criteria and try again.

### **Instruction Messages**
- **"Please ensure all required fields are filled before submitting."**
  - Complete missing fields and resubmit.

---

## Conclusion
The **RTC Case Management Tracking System** enhances case management efficiency at the Hall of Justice. For questions or technical assistance, refer to the user manual or contact the system administrator.
