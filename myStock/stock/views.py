from django.shortcuts import render,redirect
from django.http import HttpResponse
from stock.models import *

# Create your views here.
def index(request):
    return render(request,'index.html')
def dashboard(request):
    return render(request,'dashboard.html')
def product(request):
    return render(request,'product.html')
def users(request):
    return render(request,'users.html')
def customer(request):
    return render(request,'customer.html')
def sales(request):
    return render(request,'sales.html')
def salesummary(request):
    return render(request,'salesummary.html')

# Insert user
def insert_user(request):
    if request.method == 'POST':
        fname = request.POST['fname']
        lname = request.POST['fname']
        phone = request.POST['phone']
        email = request.POST['email']
        username = request.POST['username']
        password = request.POST['password']
        data = User(fname=fname,lname=lname,phone=phone,email=email,username=username,password=password)
        data.save()
        return redirect('/')
    else:
        return render(request,'users.html')
    
# View user   
def view_user(request):
    user = User.objects.all()
    return render(request,'user.html',{'user':User} )
    
# Insert Customer
def insert_customer(request):
    if request.method == 'POST':
        fname = request.POST['fname']
        lname = request.POST['fname']
        gender = request.POST['gender']
        address = request.POST['address']
        phone = request.POST['phone']
        data = Customer(fname=fname,lname=lname,gender=gender,address=address,phone=phone)
        data.save()
        return redirect('/')
        
    else:
        return render(request,'customer.html')
    
# Insert Product
def insert_product(request):
    if request.method == 'POST':
        productName = request.POST['Pname']
        buyPrice = request.POST['Buyprice']
        salePrice = request.POST['Saleprice']
        saleQuantity = request.POST['quantity']
        data = Product(productName=productName,buyPrice=buyPrice,salePrice=salePrice,saleQuantity=saleQuantity)
        data.save()
        return redirect('/')
        
    else:
        return render(request,'pruduct.html')