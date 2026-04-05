# Cafe Cloud9-PH: AWS Multi-Tier Lab Project

Welcome to the **Cafe Cloud9-PH** project! This repository contains a professional, interactive coffee shop website designed as a practical lab for learning AWS multi-tier architecture.

## 🏗️ Architecture Overview

This project demonstrates a classic 3-tier web application within a secure and scalable VPC:

1.  **Presentation Layer (Static)**: Hosted on **Amazon S3** as a Static Website.
2.  **Network Layer**: **Amazon VPC** with Multi-AZ Public and Private Subnets.
3.  **Application Layer (Scalable)**: **Auto Scaling Group** of EC2 instances behind an **Application Load Balancer**.
4.  **Data Layer (Database)**: Hosted on **Amazon RDS (MySQL)** in a Private Subnet.

---

## 📂 Project Structure

- `index.html`: The main static landing page (to be uploaded to S3).
- `menu.php`: The dynamic menu page (to be uploaded to EC2).
- `db_setup.sql`: The database schema and sample data (to be run on RDS).

---

## 🚀 Lab Setup Instructions

### Phase 1: Static Frontend (S3)
1.  **Create an S3 Bucket**: Use a unique name.
2.  **Enable Static Website Hosting**: Set `index.html` as the index document.
3.  **Upload Files**: Upload `index.html` to the bucket.
4.  **Permissions**: Ensure the bucket is public (or use CloudFront).

### Phase 2: Network Infrastructure (VPC)
1.  **Create a VPC**: Name it `CafeVPC` (CIDR: `10.0.0.0/16`).
2.  **Create Subnets (Multi-AZ)**:
    - **Public Subnet 1**: (e.g., `10.0.1.0/24`) in AZ `a`.
    - **Public Subnet 2**: (e.g., `10.0.2.0/24`) in AZ `b`.
    - **Private Subnet 1**: (e.g., `10.0.3.0/24`) in AZ `a` (for RDS).
3.  **Internet Gateway (IGW)**: Attach to `CafeVPC`.
4.  **Public Route Table**: Route `0.0.0.0/0` to IGW; associate with both Public Subnets.

### Phase 3: Database Layer (RDS)
1.  **Subnet Group**: Create a DB Subnet Group including private subnets.
2.  **Create an RDS Instance**: Choose **MySQL** (Free Tier).
3.  **Security Group**: Allow **Port 3306** from the EC2/ALB Security Group.

### Phase 4: Application Layer (EC2)
1.  **Launch EC2**: Launch in **Public Subnet 1**.
2.  **Install & Configure**:
    - Install Apache and PHP.
    - Upload and test `menu.php` with your RDS endpoint.
3.  **Create AMI**: Once the site is working, create an **Image (AMI)** from this instance.

### Phase 5: High Availability & Scaling (Advanced)
1.  **Target Group**: Create a Target Group (Type: Instance, Protocol: HTTP, Port: 80).
2.  **Load Balancer**: Create an **Application Load Balancer (ALB)**.
    - Select **Public Subnet 1** and **Public Subnet 2**.
    - Forward traffic to your Target Group.
3.  **Launch Template**: Create a Launch Template using the **AMI** created in Phase 4.
4.  **Auto Scaling Group (ASG)**:
    - Create an ASG using your Launch Template.
    - Attach to the existing Load Balancer / Target Group.
    - Set Desired Capacity to 2.
5.  **Final Update**: Update your **S3 `index.html`** to point to the **ALB DNS name** instead of a single EC2 IP.

---

## 👨‍💻 Author
**Built for AWS Labs by James.**

---
*Proudly Filipino. Crafted for learning.*
