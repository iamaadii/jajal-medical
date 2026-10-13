# AWS Deployment Guide

This document explains how to host the Medical Case Management app on Amazon Web Services (AWS) using industry best practices in a simple and concise setup.

---

## 1. Cloud Architecture Overview

* **EC2 (Application Server)**: Runs Ubuntu Linux with Nginx and PHP 8.4-FPM to serve the Laravel web app and REST API.
* **Amazon RDS (Managed MySQL)**: Hosts the MySQL 8.4 database. AWS handles automated daily backups, patches, and automatic failover (Multi-AZ).
* **Amazon S3 (File Storage)**: Secure cloud storage for medical scans and implant documentation. All files are encrypted at rest using AWS KMS.

---

## 2. Security & Network Configuration

### Security Groups (Firewalls)
* **Load Balancer (ALB)**: Accepts public traffic on port `80` (HTTP) and port `443` (HTTPS) from anywhere (`0.0.0.0/0`).
* **EC2 Instance**: Accepts web traffic on port `80`/`443` **only** from the Application Load Balancer. Direct public access is blocked.
* **RDS Database**: Accepts port `3306` **only** from the EC2 instance's security group. It has no public IP address and cannot be accessed from the internet.

### Environment Secrets
* Never store sensitive passwords or the `APP_KEY` in plaintext `.env` files on Git or on the server.
* Instead, store `DB_PASSWORD`, `APP_KEY`, and API secrets in **AWS Systems Manager Parameter Store** (or AWS Secrets Manager).
* During server launch, an EC2 IAM role securely injects these values into the running application.

### HTTPS (SSL/TLS Encryption)
* **AWS Certificate Manager (ACM)** issues a free, auto-renewing SSL certificate.
* The certificate is attached to the Application Load Balancer.
* HTTP port `80` requests are automatically redirected to secure HTTPS port `443`.

---

## 3. Step-by-Step Deployment Workflow

1. **Database Setup**: Launch an Amazon RDS MySQL instance in a private subnet. Note its private endpoint URL.
2. **Server Setup**: Launch an EC2 instance (`t3.medium`) and install Nginx, PHP 8.4, and Composer.
3. **Deploy Application**:
   ```bash
   git clone https://github.com/iamaadii/php-project.git /var/www/medical-cases
   cd /var/www/medical-cases
   composer install --no-dev --optimize-autoloader
   php artisan migrate --force
   php artisan config:cache
   php artisan route:cache
   ```
4. **Connect Load Balancer & Domain**: Point Route 53 DNS records to the Load Balancer with HTTPS enabled.
