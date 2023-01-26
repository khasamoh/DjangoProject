from django import forms
from .models import *

class UserForm(forms.ModelForm):
    Fname = forms.CharField(required=True,widget=forms.TextInput(attrs={
        "class": "form-control",
        "placeholder": "FirstName"
    }))
    Lname = forms.CharField(required=True,widget=forms.TextInput(attrs={
        "class": "form-control",
        "placeholder": "lastName"
    }))
    email = forms.CharField(required=True,widget=forms.TextInput(attrs={
        'type': "email",
        "class": "form-control",
        "placeholder": "email"
    }))
    phone = forms.CharField(required=True,widget=forms.TextInput(attrs={
        "class": "form-control",
        "placeholder": "phone"
    }))
    username= forms.CharField(required=True,widget=forms.TextInput(attrs={
        "class": "form-control",
        "placeholder": "username"
    }))
    password = forms.CharField(required=True,widget=forms.TextInput(attrs={
        'type': "password",
        "class": "form-control",
        "placeholder": "password"
    }))
    class Meta:
        model = User
        fields =('Fname', 'Lname','email','phone','username','password')

class ProductForm(forms.ModelForm):
    productName = forms.CharField(required=True,widget=forms.TextInput(attrs={
        "class": "form-control",
        "placeholder": "productName"
    }))
    buyPrice= forms.CharField(required=True,widget=forms.TextInput(attrs={
        'type': "number",
        "class": "form-control",
        "placeholder": "buyPricee"
    }))

    salePrice = forms.CharField(required=True,widget=forms.TextInput(attrs={
        'type': "number",
        "class": "form-control",
        "placeholder": "salePrice"
    }))
    quantity = forms.CharField(required=True,widget=forms.TextInput(attrs={
        'type': "number",
        "class": "form-control",
        "placeholder": "quantity"
    }))
    class Meta:
        model = Product
        fields =('productName', 'buyPrice','salePrice','quantity')
        
class CustomerForm(forms.ModelForm):
    Fname = forms.CharField(required=True,widget=forms.TextInput(attrs={
        "class": "form-control",
        "placeholder": "FirstName"
    }))
    Lname = forms.CharField(required=True,widget=forms.TextInput(attrs={
        "class": "form-control",
        "placeholder": "lastName"
    }))
    gender = forms.CharField(required=True,widget=forms.TextInput(attrs={
       "class": "form-control",
        "placeholder": "M/F"
    }))
    address = forms.CharField(required=True,widget=forms.TextInput(attrs={
       "class": "form-control",
        "placeholder": "address"
    }))
    phone = forms.CharField(required=True,widget=forms.TextInput(attrs={
        "class": "form-control",
        "placeholder": "phone"
    }))
    class Meta:
        model = Customer
        fields =('Fname', 'Lname','gender','address','phone')
