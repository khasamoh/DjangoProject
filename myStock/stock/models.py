from django.db import models

# Create your models here.
class User(models.Model):
    fname = models.CharField(max_length=30)
    lname = models.CharField(max_length=30)
    email = models.EmailField()
    phone = models.CharField(max_length=20)
    username = models.CharField(max_length=30)
    password = models.CharField(max_length=100)
    
    def __str__(self):
        return self.fname
    
class Product(models.Model):
    productName = models.CharField(max_length=50)
    buyPrice = models.IntegerField()
    salePrice = models.IntegerField()
    quantity = models.IntegerField()
    
    def __str__(self):
        return self.productName

class Customer(models.Model):
    fname = models.CharField(max_length=30)
    lname = models.CharField(max_length=30)
    gender = models.CharField(max_length=6)
    address = models.CharField(max_length=30)
    phone = models.CharField(max_length=20)
    
    def __str__(self):
        return self.fname
        