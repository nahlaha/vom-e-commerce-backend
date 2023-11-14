# Ecommerce APIs

## **Table of contents**

- [**Overview**](#overview)
- [**Installation**](#installation)
- [**Api Requests with example**](#api-requests-with-example)

## **Overview**

A backend of APIs e commerce system

### **Frameworks**

- **Laravel 9** 
- **PHP 8** 

## **Installation**
- Install php8.*
- Install mysql server v8
  - sudo apt update
  - sudo apt install mysql-server
  - mysql_secure_installation  
    [documentation for mysql installation](https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-20-04)
- Clone the project's repo
- Create .env file same as .example.env
- Run: `composer install` (to install vendor)
- Run: `php artisan migrate` (to migrate the database)
- Run: `php artisan db:seed`
- Run: `php artisan serve` (to serve the project)


## **Api Requests with example**

_all requests in the project start with url_ **api/v1**


### **Store Requests**

 #### **Create store**
 Only user with marchent role can create store
 - **Route:** /stores 
 - **Method:** post
 - **Header:** authorization key : Bearer {token}
 - **body:** {
     "name": string, 
     "shipping_cost": decimal, 
     "vat_type": int in enum (INCLUDED = 1, PERCENTAGE = 2, FIXED = 3), 
     "vat_value": decimal
 }
 - **Response:** object of store
 - **example:** 
    create store
    - **request:** {
        name:store1
        vat_value:15
        vat_type:2
        shipping_cost:10
}


### **Product Requests**

 #### **Create Product**
 Only merchant user can create products to the store
 - **Route:** /products. 
 - **Method:** post. 
 - **Header:** authorization key : Bearer {token}
 - **body:** {
     "store_id":int
     "price": decimal
     "product_names":[{
        "language_id":int in enum (EN=1,AR=2),
        "name": "string",
        "description": "string"
    }]}
 - **Response:** object of product
 - **example:**
    create product 2 products in the same store
    - **request:**
        - product1: {
        {
            "store_id": 1,
            "price": 30,
            "product_names": [
                {
                "language_id": 1,
                "name": "product1",
                "description": "product description"
                }
            ]}
        }    
        - product2{
        {
            "store_id": 1,
            "price": 10,
            "product_names": [
                {
                "language_id": 1,
                "name": "product2",
                "description": "product description"
                }
        ]}
    }


### **Cart Requests**

 #### **Create Cart**
  Any authenticated user can create cart 
 - **Route:** /carts 
 - **Method:** post
 - **Header:** authorization key : Bearer {token}
 - **body:** {
    "products": [
        {
            "product_id": int,
            "quantity": int
        }
    ]
 }
 - **Response:** object of cart
 - **Example**:
    - **Request:**{
        {
    "products": [
        {
            "product_id": 1,
            "quantity": 1
        },
        {
            "product_id": 2,
            "quantity": 1
        }
    ]}
    }
    - **Response:**{
        object of cart with total value: ` 56`
    }

### **Users Requests**

 #### **Get All Users**
 - **Route:** /users
 - **Method:** post
 - **Response:** this request returns all users in database paginated

 #### **Create User**
 - **Route:** /users. 
 - **Method:** post. 
 - **body:** {
     "first_name":string
     "last_name": string
     "email":string
     "password":string
     "role_id":int
     "phone_number":string
     "description":string
     "image":uploaded file
 }
 - **Response:** object of user model

 #### **Update User**
 - **Route:** /users/{userId}. 
 - **Method:** put. 
 - **body:** {
     "first_name":string
     "last_name": string
     "email":string
     "password":string
     "role_id":int
     "phone_number":string
     "description":string
     "image":uploaded file
 }
 - **Response:** object of user model

 #### **Delete User**
 - **Route:** /users/{userId}. 
 - **Method:** delete
 - **Response:** bool

 #### **Authenticate user**
 this request authenticate the user and return jwt token
 - **Route:** /users/actions/auth. 
 - **Method:** post. 
 - **body:** {
     "email":string
     "password": string
 }
 - **Response:** string (token)

 #### **Me Request**
 this request return logged in user, using bearer token 
 - **Route:** /users/actions/me 
 - **Method:** get
 - **Header:** authorization key : Bearer {token}
 - **Response:** logged in user


