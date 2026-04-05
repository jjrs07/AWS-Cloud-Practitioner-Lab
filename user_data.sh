#!/bin/bash
# 1. Update system packages
dnf update -y

# 2. Install Apache (httpd), PHP, and MySQL drivers (PDO/MySQLi)
dnf install -y httpd php php-mysqli php-pdo

# 3. Start Apache and ensure it starts automatically on reboot
systemctl start httpd
systemctl enable httpd

# 4. Install Git to fetch files from GitHub
dnf install -y git

# 5. Navigate to the web root directory
cd /var/www/html

# 6. Clean up any default Apache files before cloning
rm -rf *

# 7. Clone your repository directly into the current directory (.)
# This ensures index.html, menu.php, and other files are in the root folder.
git clone https://github.com/jjrs07/AWS-Cloud-Practitioner-Lab.git .
