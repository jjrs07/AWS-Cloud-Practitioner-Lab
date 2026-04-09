#!/bin/bash
# 1. Update system packages
dnf update -y

# 2. Install Apache (httpd), PHP, and MySQL drivers (PDO/MySQLi)
dnf install -y httpd php php-mysqli php-pdo
dnf install -y mariadb105

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

# 8. Fetch Availability Zone from Instance Metadata (IMDSv2)
TOKEN=$(curl -X PUT "http://169.254.169.254/latest/api/token" -H "X-aws-ec2-metadata-token-ttl-seconds: 21600")
AZ=$(curl -H "X-aws-ec2-metadata-token: $TOKEN" http://169.254.169.254/latest/meta-data/placement/availability-zone)

# 9. Replace placeholder with actual AZ in HTML files
sed -i "s/REPLACE_WITH_AZ/$AZ/g" index.html
sed -i "s/REPLACE_WITH_AZ/$AZ/g" index_ec2.html
