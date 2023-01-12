from django.db import models

# Create your models here.
class User(models.Model):
    user_id = models.IntegerField()
    fname = models.CharField(max_length=30)
    lname = models.CharField(max_length=30)
    email = models.EmailField()
    phone = models.CharField(max_length=20)
    username = models.CharField(max_length=30)
    password = models.CharField(max_length=100)
    class Meta:
        db_table="User"
        
class Product(models.Model):
    productID = models.IntegerField()
    productName = models.CharField(max_length=50)
    buyPrice = models.IntegerField()
    salePrice = models.IntegerField()
    quantity = models.IntegerField()
    class Meta:
        db_table="Product"

class Customer(models.Model):
    customer_id = models.IntegerField()
    fname = models.CharField(max_length=30)
    lname = models.CharField(max_length=30)
    gender = models.CharField(max_length=6)
    address = models.CharField(max_length=30)
    phone = models.CharField(max_length=20)
    class Meta:
        db_table="Customer"
        
class Sale(models.Model):
    productID = models.ForeignKey(Product, on_delete=models.CASCADE)
    customerID = models.ForeignKey(Customer,on_delete=models.CASCADE)
    saleQuantity = models.IntegerField()
    discount = models.IntegerField()
    saleDate = models.DateField()
    class Meta:
        db_table="Sale"
