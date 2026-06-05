# ♻️ WasteWise - Cloud Native Waste Management Platform

![AWS](https://img.shields.io/badge/AWS-EC2-orange)
![Terraform](https://img.shields.io/badge/Terraform-IaC-blue)
![Docker](https://img.shields.io/badge/Docker-Containerization-blue)
![Kubernetes](https://img.shields.io/badge/K3s-Kubernetes-green)
![Grafana](https://img.shields.io/badge/Grafana-Monitoring-orange)
![PHP](https://img.shields.io/badge/PHP-Backend-purple)

## 📊 Project Presentation

[Download Project Presentation (PPT)](INT377_PPT.pptx)

This presentation provides an overview of the WasteWise project, including its objectives, architecture, implementation, deployment process, and key features.

---

## 🌐 Live Deployment

### Application URL

http://44.212.91.222:30080

### Grafana Dashboard

http://44.212.91.222:30905

---

# 📖 Project Overview

WasteWise is a cloud-native waste management platform designed to promote sustainable waste disposal practices. The platform enables users to schedule waste pickups, track requests, calculate waste generation, and participate in awareness activities through quizzes and educational content.

The project demonstrates modern DevOps practices including:

* Infrastructure as Code (Terraform)
* Cloud Deployment (AWS EC2)
* Containerization (Docker)
* Container Orchestration (K3s Kubernetes)
* Monitoring (Grafana)
* Version Control (GitHub)

---

# 🎯 Objectives

* Automate infrastructure provisioning
* Deploy a scalable containerized application
* Demonstrate Kubernetes orchestration
* Enable monitoring and observability
* Showcase end-to-end DevOps workflow

---

# 🏗️ Architecture

GitHub Repository
↓
Terraform (IaC)
↓
AWS EC2 (t3.small)
↓
Docker Image
↓
K3s Kubernetes Cluster
↓
WasteWise Pod
↓
NodePort Service
↓
Grafana Monitoring
↓
InfinityFree MySQL Database

---

# 🛠️ Tech Stack

## Frontend

* HTML
* CSS
* JavaScript

## Backend

* PHP

## Database

* MySQL (InfinityFree)

## Cloud Platform

* AWS EC2

## DevOps Tools

* Terraform
* Docker
* K3s Kubernetes
* Grafana
* GitHub

---

# 🚀 Deployment Workflow

### Step 1

Source code stored in GitHub repository.

### Step 2

Terraform provisions AWS infrastructure automatically.

### Step 3

EC2 instance is launched with security group configuration.

### Step 4

Docker image is built from application source code.

### Step 5

Docker image is deployed into K3s Kubernetes cluster.

### Step 6

Kubernetes Deployment creates WasteWise Pod.

### Step 7

NodePort Service exposes the application publicly.

### Step 8

Grafana provides monitoring and visualization capabilities.

---

# 📦 Kubernetes Components

## Node

Single Node K3s Cluster

## Deployment

WasteWise Deployment

## Pod

WasteWise Application Pod

## Service

NodePort Service

## Monitoring

Grafana Dashboard

---

# ✨ Key Features

* User Registration
* Secure Login System
* Waste Pickup Scheduling
* Waste Calculator
* Pickup Tracking
* Admin Dashboard
* Educational Quiz Module
* Sustainable Waste Awareness
* Kubernetes Deployment
* Monitoring Dashboard

---

# 📋 Terraform Resources

Provisioned Resources:

* AWS EC2 Instance
* AWS Security Group
* Public Networking
* SSH Access Configuration

Common Commands:

```bash
terraform init
terraform validate
terraform plan
terraform apply
```

---

# 🐳 Docker Commands

```bash
docker build -t wastewise .
docker run -d -p 80:80 wastewise
```

---

# ☸️ Kubernetes Commands

```bash
sudo kubectl get nodes
sudo kubectl get pods
sudo kubectl get svc
sudo kubectl describe pod <pod-name>
```

---

# 📊 Monitoring

Grafana has been integrated as the visualization layer for monitoring.

Dashboard Access:

http://44.212.91.222:30905

Default Login:

Username: admin

Password: admin

---

# 📷 Project Screenshots

Add screenshots for:

* AWS EC2 Instance
* Terraform Apply Output
* Docker Image
* Kubernetes Nodes
* Kubernetes Pods
* Kubernetes Services
* WasteWise Homepage
* Grafana Dashboard

---

# 🎓 Viva Questions

## Why Terraform?

Terraform enables Infrastructure as Code and automates cloud provisioning.

## Why Docker?

Docker packages the application and dependencies into a portable container.

## Why Kubernetes?

Kubernetes manages deployment, scaling, and orchestration of containers.

## Why K3s?

K3s is a lightweight Kubernetes distribution optimized for resource-constrained environments.

## Why Grafana?

Grafana provides monitoring, dashboard visualization, and observability.

---

# 🔮 Future Enhancements

* Prometheus Integration
* CI/CD Pipeline with Jenkins/GitHub Actions
* Auto Scaling
* Load Balancer Integration
* Real-Time Analytics
* Multi-Node Kubernetes Cluster

---

# 👨‍💻 Author

Anchal Malik

---

# 🔗 Repository

https://github.com/Anchalmalik9/Wastewise_project
