from django.shortcuts import render,redirect,get_object_or_404
from .models import Product,Customer
from .forms import ProductForm
from django.http import HttpResponse
from stock.models import *

# Create your views here.
def index(request):
    return render(request,'index.html')
def dashboard(request):
    Products = Product.objects.all
    context = {
         "Products" : Products
    }
    return render(request,'dashboard.html',context)
def product(request):
    return render(request,'product.html')
def users(request):
    return render(request,'users.html')
def customer(request):
    return render(request,'customer.html')
def sales(request):
    Products = Product.objects.all
    context = {
         "Products" : Products
    }
    return render(request,'sales.html',context)
def salesummary(request):
    Products = Product.objects.all
    context = {
         "Products" : Products
    }
    return render(request,'salesummary.html',context)

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
        success = 'User Created'+fname
        return HttpResponse(success)
        #return redirect('/')
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
    
# Insert Product
def create(request):
    Products = Product.objects.all
    form = ProductForm(request.POST)
    if request.method == "POST":
        if form.is_valid():
            form.save()
            return redirect ('product')
        form = ProductForm()
    context = {
        "form":form,
         "Products" : Products
    }
    return render(request, 'product.html', context)
