
# LAMP Stack on AWS

This repository contains the application code for a PHP-based LAMP (Linux, Apache, MySQL, PHP) stack running on AWS infrastructure.

## Infrastructure Provisioning

**For complete infrastructure setup including Terraform modules, networking, and deployment automation, see:**  
[AWS LAMP Stack Infrastructure Repository](https://github.com/guderian120/lamp_stack_infranstructure)

## Application Components

| Component       | Description                                                                 |
|-----------------|-----------------------------------------------------------------------------|
| Web Servers     | Auto-scaled Apache/PHP instances running in private subnets                 |
| Database        | Managed MySQL RDS instance                                                  |
| Load Balancer   | Application Load Balancer distributing traffic across web servers           |
| Deployment      | Docker containers pulled from private registry                              |

## Key Features
- Containerized PHP application
- High availability across multiple AZs
- Automated scaling based on demand
- Secure architecture with public/private subnet separation

Note: All infrastructure is managed through Terraform in the linked repository above.


