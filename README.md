<p align="center"> 
  <h1 align="center"> Deploying via AWS </h1> 
  <h5 align="center">October 2024 - Bernice Kagemulo</h5> 
  
  <p align="center"> 
    Using AWS for the deployment of software applications 
  </p> 
</p>

---

# Overview

I have developed an e-commerce platform to offer customers a simple and convenient way to buy electronic devices. The system includes essential features such as customer account management, user authentication, and product browsing, resulting in a robust and user-friendly application.

Behind the scenes, the system is distributed across 2 (VMs) to enhance performance and scalability. This was achieved using the EC2 AWS service, allowing for easy scaling for the web application. This ensures that the platform remains responsive under varying loads. I have implemented Amazon RDS with MySQL for data storage, providing a reliable and scalable database solution. Additionally, I have integrated Amazon CloudWatch to perform real-time monitoring and insights into system performance.


## File Tree

-  `www` - Contains the PHP webpages  
-  `database` - Contains the sql files needed to set up the Bernice Electronics database (electronicsdb)

---
## Accessing the Application in the Cloud 

- Users can access the application from any device with an internet connection and a web browser. 
- To do so, simply enter the URL provided above into your web browser's address bar. This URL will take you directly to the homepage of the application, where you can browse products, sign in, and create a new account by clicking on various buttons and links within the application.

## Running the Instances 
Running the application requires both the EC2 instances to be running on the cloud.

1. Start the EC2 instances.

2. Connect to the EC2 instances :
```sh
ssh -i location_of_pem_file ec2-user@ec2-instance-public-dns-name
```

3. Get latest bug fixes and secuirty updates:
```sh
sudo dnf update -y
```

4. Start  the web server 
```sh
sudo systemctl start httpd

```
5. Enter this URL provided above into your web browser's address bar to access the application.
```sh
http://cosc349-loadbalancer-2094742701.us-east-1.elb.amazonaws.com/index.php

```

6. Interact with the application using the following URLs:
- Homepage : [`http://cosc349-loadbalancer-2094742701.us-east-1.elb.amazonaws.com/index.php`](http://cosc349-loadbalancer-2094742701.us-east-1.elb.amazonaws.com/index.php)
- Create an Account: [`http://cosc349-loadbalancer-2094742701.us-east-1.elb.amazonaws.com/add-customer.php`](http://cosc349-loadbalancer-2094742701.us-east-1.elb.amazonaws.com/add-customer.php)
- Browse Products [`http://cosc349-loadbalancer-2094742701.us-east-1.elb.amazonaws.com/view-products.php`](http://cosc349-loadbalancer-2094742701.us-east-1.elb.amazonaws.com/view-products.php)
- Sign in: [`http://cosc349-loadbalancer-2094742701.us-east-1.elb.amazonaws.com/customer-sign-in.php`](http://cosc349-loadbalancer-2094742701.us-east-1.elb.amazonaws.com/customer-sign-in.php)


7. Shut down the application by exiting browser.


* * * * *

## Application Design
The e-commerce application's design is based on a multi-tier architecture that improves performance, scalability, and maintainability. It consists of three main layers: the web server layer, the database layer, and the load balancing layer.

- **Primary EC2 Instance:** This instance serves as the main web server, handling incoming HTTP requests from users and running the application code.

- **Backup EC2 Instance:**  A second EC2 instance was created as a backup, mirroring the prior instance's configuration. This instance serves as a failover option, ensuring high availability. In case the primary instance fails, the backup instance can take over without interrupting service.

- **Database Layer (Amazon RDS):**  The application uses Amazon RDS (Relational Database Service) to manage the MySQL database, which stores important data such as user accounts, product information, and other details. Both EC2 instances are connected to the RDS database, allowing them to perform database operations without any issues.

- **Load Balancer:** This is configured to distribute incoming traffic evenly across both EC2 instances. his helps prevent any single instance from being overloaded with traffic, which in turn improves performance and reliability. The load balancer constantly checks the health of the EC2 instances. If an instance becomes unhealthy or unresponsive, the load balancer automatically redirects traffic to the healthy instance.

When users access the application, their requests are directed to one of the two EC2 instances through the load balancer using load-balancing algorithms. The selected EC2 instance processes the requests, interacting with the RDS database to retrieve or store information as needed. The database processes the request and returns the required data to the requesting EC2 instance, which then formats it for the user interface. Finally, the EC2 instance sends the response back to the user through the Load Balancer, completing the interaction.

![Alt text](VirtualMachinesInteraction.jpg)

---

## Example Data 
The application comes preloaded with example data that includes 5 customers and a few products to demonstrate its functionality. The customers are used to test the user authentication properties of the platform.

The customers are as follows:


| First Name | Surname| Username | Shipping Address| Email Address | Password |
|---------|---------------|----------|----------|----------|----------|
| John | Doe | john_doe | 123 Elm Street, Springfield, IL, 62704 | john.doe@example.com | password123 |
| Jane | Smith | jane_smith | 456 Oak Avenue, Rivertown, TX, 75001| jane.smith@example.com | securepass456 |
| Alice | Jones | alice_jones | 789 Maple Road, Willow Creek, CA, 94001 | alice.jones@example.com | alicepass789 |
| Bob | Brown | bob_brown | 101 Pine Lane, Lakeside, FL, 33101| bob.brown@example.com | bobpass101 |
| Carol | White | carol_white | 202 Cedar Street, Mountain View, CO, 80301 | carol.white@example.com| carolpass202 |

---

     
## Note 

To make any changes to the application an AWS account will be needed.
