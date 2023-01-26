from django.shortcuts import render,redirect,get_object_or_404
from .models import *
from .forms import *
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
    Users = User.objects.all
    form = UserForm(request.POST)
    if request.method == "POST":
        if form.is_valid():
            form.save()
            return redirect ('user')
        form = UserForm()
    context = {
        "form":form,
         "Users" : Users
    }
    return render(request, 'users.html', context)
    
# Insert Customer
def insert_customer(request):
    Customers = Customer.objects.all
    formC = CustomerForm(request.POST)
    if request.method == "POST":
        if formC.is_valid():
            formC.save()
            return redirect ('customer')
        formC = CustomerForm()
    context = {
        "formC":formC,
         "Customers" : Customers
    }
    return render(request, 'customer.html', context)
    
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
